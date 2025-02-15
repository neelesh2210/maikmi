<?php

namespace App\Http\Controllers\Api\Vendors;

use Carbon\Carbon;
use App\Models\Plan;
use Razorpay\Api\Api;
use Illuminate\Http\Request;
use App\Models\PlanPurchaseHistory;
use App\Http\Controllers\Controller;
use App\Http\Resources\Vendors\PlanPurchaseResource;

class PlanPurchaseController extends Controller
{

    public function paymentInitialization(Request $request){
        $plan = Plan::where('is_active','1')->where('id',$request->plan_id)->first();
        if($plan){
            $data=[
                'amount'=>$plan->discounted_price*100,
                'currency'=> "INR",
                'receipt'=> "order_rcptid_" . time(),
                'notes'=> [
                    'user_id'   => auth()->id(),
                    'plan_id'   => $plan->id,
                    'key'       => env('RAZOR_KEY')
                ]
            ];

            $encoded_data=json_encode($data);

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.razorpay.com/v1/orders',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>$encoded_data,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Basic '.base64_encode(env('RAZOR_KEY').':'.env('RAZOR_SECRET'))
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            $response = json_decode($response, true);

            $purchaseHistory = new PlanPurchaseHistory;
            $purchaseHistory->user_id = auth()->id();
            $purchaseHistory->plan_id = $request->plan_id;
            $purchaseHistory->order_id = $response['id'];
            $purchaseHistory->plan_detail = $plan;
            $purchaseHistory->duration = $plan->duration;
            $purchaseHistory->amount = $response['amount']/100;
            $purchaseHistory->save();

            return [
                'order_id'          => $response['id'],
                'amount'            => $response['amount']/100,
                'plan_history_id'   => $purchaseHistory->id,
                'key'               => $response['notes']['key'],
            ];

        }else{
            return response()->json(['message'=>'Plan Not Found!','status'=>422],422);
        }
    }

    public function verifySignature(Request $request){
        $this->validate($request, [
            'razorpay_order_id'         => 'required',
            'plan_history_id'           => 'required',
            'payment_status'            => 'required',
        ]);
        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));

        if($request->payment_status == 'captured'){
            $purchaseHistory = PlanPurchaseHistory::where('id',$request->plan_history_id)->where('order_id',$request->razorpay_order_id)->where('payment_status','created')->first();
            if($purchaseHistory){
                $response = $api->utility->verifyPaymentSignature([
                    'razorpay_order_id'     => $request->razorpay_order_id,
                    'razorpay_payment_id'   => $request->razorpay_payment_id,
                    'razorpay_signature'    => $request->razorpay_signature
                ]);

                $res=$api->payment->fetch($request->razorpay_payment_id);

                $active_purchase_history = PlanPurchaseHistory::where('user_id',auth()->id())->where('payment_status','captured')->where('plan_status','active')->first();

                $purchaseHistory->payment_id = $res->id;
                $purchaseHistory->payment_signature = $request->razorpay_signature;
                $purchaseHistory->payment_status = $request->payment_status;
                $purchaseHistory->plan_status = $active_purchase_history?'hold':'active';
                $purchaseHistory->plan_activated_time = $active_purchase_history?null:Carbon::now();
                $purchaseHistory->save();

                return [
                    'payment_id'    => $res->id,
                    'order_id'      => $res->order_id,
                    'plan_id'       => $res->notes->plan_id,
                    'amount'        => $res->amount/100,
                ];
            }else{
                return response()->json(['message'=>'Invalid Purchase History','status'=>422],422);
            }
        }else{
            return response()->json(['message'=>$request->message,'status'=>422],422);
        }

    }

    public function planPurchaseList(){
        $plan_purchase_histories = PlanPurchaseResource::collection(PlanPurchaseHistory::where('user_id',auth()->id())->where('payment_status','captured')->orderByRaw("FIELD(plan_status, 'active', 'hold', 'expired', 'cancelled')")->paginate(10));

        return response()->json([
            'plan_purchase_histories'=>$plan_purchase_histories,
            'links'                     =>[
                'first_page_url'        => $plan_purchase_histories->url($plan_purchase_histories->firstItem()),
                'last_page_url'         => $plan_purchase_histories->url($plan_purchase_histories->lastPage()),
                'next_page_url'         => $plan_purchase_histories->nextPageUrl(),
                'prev_page_url'         => $plan_purchase_histories->previousPageUrl(),
            ],
            'message'=>'Plan Purchase List Retrived Successfully!',
            'status'=>200
        ],200);
    }

}
