<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Salon;
use Razorpay\Api\Api;
use App\Models\Coupon;
use App\Models\SalonWallet;
use Illuminate\Http\Request;
use App\Models\ServiceBooking;
use App\Http\Controllers\Controller;
use App\Http\Resources\Users\ServiceBookingResource;

class ServiceBookingController extends Controller
{

    public function serviceBooking(Request $request){
        try{
            $coupon = Coupon::where('salon_id', $request->salon_id)->where('code', $request->coupon)->first();

            $data = new ServiceBooking;
            $data->booking_id = date('Ym').rand(1111, 9999);
            $data->user_id = Salon::find($request->salon_id)->user_id;
            $data->salon_id = $request->salon_id;
            $data->booked_by = auth()->id();
            $data->salon = $request->salon;
            $data->service = $request->service;
            $data->coupon = $coupon;
            $data->coupon_discount_amount = $request->coupon_discount_amount;
            $data->quantity = 1;
            $data->total_amount = $request->total_amount;
            $data->address = $request->address;
            $data->payment_type = $request->payment_type;
            $data->booking_date = $request->booking_date;
            $data->booking_time = $request->booking_time;
            $data->booking_at = Carbon::now();
            $data->start_at = Carbon::now();
            $data->end_at = Carbon::now();
            $data->at_salon = $request->at_salon;
            $data->home_service_charge = $request->home_service_charge;
            $data->payment_status = 'unpaid';
            $data->status = $request->status;
            $data->save();

            if($coupon){
                $coupon->total_used = $coupon->total_used + 1;
                $coupon->save();
            }

            // sendNotification('Service Booking', 'Service Booked Successfully with booking id '.$data->booking_id, auth()->user()->fcm_token);
            sendNotification('New Booking', 'New Booking Arrived with booking id '.$data->booking_id.'. Please confirm it.', $data->getSalon->getOwner->fcm_token, 'order');

            return response([
                'success'       => true,
                'booking_id'    => $data->booking_id,
                'message'       => 'Booking successfully',
            ], 200);

        }catch(\Exception $e){

            return response([
                'success'       => false,
                'message'       => 'Somthing went Wrong.'
            ], 400);

        }
    }

    public function serviceBookingList(){
        return response([
            'success'       => true,
            'data'          => ServiceBookingResource::collection(ServiceBooking::where('booked_by', auth()->user()->id)->orderBy('id', 'desc')->get()),
        ], 200);
    }

    public function serviceBookingCancel(Request $request){
        $booking = ServiceBooking::where('booked_by',auth()->user()->id)->where('booking_id',$request->booking_id)->first();
        if($booking){
            $booking->cancel_reason = $request->cancel_reason;
            $booking->status = 'cancelled';
            $booking->save();

            sendNotification('Service Booking Cancelled', 'Service Cancelled Successfully with booking id '.$booking->booking_id, auth()->user()->fcm_token);

            return response()->json(['message'=>'Booking Cancel Successfully!','status'=>200],200);
        }else{
            return response()->json(['message'=>'Booking Not Found!','status'=>422],422);
        }
    }

    public function serviceBookingWaiting(Request $request){
        $booking = ServiceBooking::where('booked_by',auth()->user()->id)->where('booking_id',$request->booking_id)->where('status','pending')->first();
        if($booking){
            $booking->status = 'waiting';
            $booking->save();

            sendNotification('Service Booking Waiting', 'Service Added in Queue Successfully with booking id '.$booking->booking_id, auth()->user()->fcm_token);

            return response()->json(['message'=>'Booking Added in Queue Successfully!','status'=>200],200);
        }else{
            return response()->json(['message'=>'Booking Not Found!','status'=>422],422);
        }
    }

    public function serviceBookingConfirm(Request $request){
        $booking = ServiceBooking::where('booked_by',auth()->user()->id)->where('booking_id',$request->booking_id)->where('status','time_update')->first();
        if($booking){
            $booking->status = 'confirmed';
            $booking->save();

            sendNotification('Service Booking Confirmed', 'Service Confirmed Successfully with booking id '.$booking->booking_id, auth()->user()->fcm_token);
            sendNotification('Service Booking Confirmed', 'Service Confirmed Successfully with booking id '.$booking->booking_id, $booking->getSalon->getOwner->fcm_token);

            return response()->json(['message'=>'Booking Added in Queue Successfully!','status'=>200],200);
        }else{
            return response()->json(['message'=>'Booking Not Found!','status'=>422],422);
        }
    }

    public function serviceBookingStatusCheck(Request $request){
        $booking = ServiceBooking::where('booked_by',auth()->user()->id)->where('booking_id',$request->booking_id)->with('getSalon')->first();
        if($booking){
            return response()->json(['time'=>$booking->booking_time,'booking_status'=>$booking->status, 'partial_payment_status'=>$booking->getSalon->is_partial_payment, 'partial_payment_percent'=>$booking->getSalon->partial_payment_percent ,'message'=>'Booking Added in Queue Successfully!','status'=>200],200);
        }else{
            return response()->json(['message'=>'Booking Not Found!','status'=>422],422);
        }
    }

    public function serviceBookingReschedule(Request $request){
        $booking = ServiceBooking::where('booked_by',auth()->user()->id)->where('booking_id',$request->booking_id)->first();
        if($booking){
            $booking->booking_date = $request->booking_date;
            $booking->booking_time = $request->booking_time;
            $booking->save();

            sendNotification('Service Booking Reschedule', 'Service Reschedule Successfully with booking id '.$booking->booking_id, auth()->user()->fcm_token);

            return response()->json(['message'=>'Booking Reschedule Successfully!','status'=>200],200);
        }else{
            return response()->json(['message'=>'Booking Not Found!','status'=>422],422);
        }
    }

    public function invoice($booking_id,$user_id){
        $booking = ServiceBooking::where('user_id',decrypt($user_id))->where('booking_id',$booking_id)->first();
        if($booking){
            view()->share('booking',$booking);

            $pdf = PDF::loadView('service_invoice');
            return $pdf->download('invoice.pdf');
        }else{
            abort(404);
        }
    }

    public function serviceBookingRetry(Request $request){
        $booking = ServiceBooking::where('booked_by',auth()->user()->id)->where('booking_id',$request->booking_id)->first();
        if($booking){
            sendNotification('New Booking', 'New Booking Arrived with booking id '.$booking->booking_id.'. Please confirm it.', $booking->getSalon->getOwner->fcm_token, 'order');

            return response([
                'success'       => true,
                'booking_id'    => $booking->booking_id,
                'message'       => 'Booking resend successfully',
            ], 200);
        }else{
            return response()->json(['message'=>'Booking Not Found!','status'=>422],422);
        }
    }

    public function paymentInitialization(Request $request){
        $booking = ServiceBooking::where('booked_by',auth()->user()->id)->where('booking_id',$request->booking_id)->with('getSalon')->first();
        if($booking){
            if($booking->getSalon->is_partial_payment === '1' && $request->payment === 'part'){
                $amount = (($booking->total_amount - $booking->paid_amount)*$booking->getSalon->partial_payment_percent)/100;
            }else{
                $amount = $booking->total_amount;
            }

            $data=[
                'amount'=>$amount*100,
                'currency'=> "INR",
                'receipt'=> "order_rcptid_" . time(),
                'notes'=> [
                    'user_id'   => auth()->id(),
                    'booking_id'   => $booking->id,
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

            return [
                'order_id'          => $response['id'],
                'amount'            => $response['amount']/100,
                'booking_id'        => $booking->booking_id,
                'key'               => $response['notes']['key'],
            ];

        }else{
            return response()->json(['message'=>'Booking Not Found!','status'=>422],422);
        }
    }

    public function verifySignature(Request $request){
        $this->validate($request, [
            'razorpay_order_id'         => 'required',
            'booking_id'                => 'required',
            'payment_status'            => 'required',
        ]);
        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));

        if($request->payment_status == 'captured'){
            $booking = ServiceBooking::where('booked_by',auth()->user()->id)->where('booking_id',$request->booking_id)->with('getSalon')->first();
            if($booking){
                $salon = Salon::where('id', $booking->getSalon->id)->first();

                $response = $api->utility->verifyPaymentSignature([
                    'razorpay_order_id'     => $request->razorpay_order_id,
                    'razorpay_payment_id'   => $request->razorpay_payment_id,
                    'razorpay_signature'    => $request->razorpay_signature
                ]);

                $res=$api->payment->fetch($request->razorpay_payment_id);

                $booking->paid_amount = $res->amount/100;
                $booking->payment_detail = [['payment_id'=>$res->id,'order_id'=>$res->order_id,'amount'=>$res->amount/100,'payment_status'=>$request->payment_status,'date'=>Carbon::now(),'payment_type'=>'online']];
                if($booking->total_amount == $res->amount/100){
                    $booking->payment_status = 'paid';
                }else{
                    $booking->payment_status = 'partially_paid';
                }
                $booking->save();

                $gst_amount = (($res->amount / 100) * 18) / 100;

                $salon_wallet = new SalonWallet;
                $salon_wallet->salon_id = $salon->id;
                $salon_wallet->amount = ($res->amount / 100) - $gst_amount;
                $salon_wallet->source_id = $booking->id;
                $salon_wallet->source = 'booking';
                $salon_wallet->type = 'credit';
                $salon_wallet->save();

                $salon->total_wallet_balance = $salon->total_wallet_balance + $salon_wallet->amount;
                $salon->save();

                return [
                    'payment_id'    => $res->id,
                    'order_id'      => $res->order_id,
                    'booking_id'    => $booking->id,
                    'amount'        => $res->amount/100,
                ];
            }else{
                return response()->json(['message'=>'Invalid Booking','status'=>422],422);
            }
        }else{
            return response()->json(['message'=>$request->message,'status'=>422],422);
        }

    }

    public function remainingPaymentInitialization(Request $request){
        $booking = ServiceBooking::where('booked_by',auth()->user()->id)->where('booking_id',$request->booking_id)->first();
        if($booking){
            $amount = ($booking->total_amount - $booking->paid_amount);

            $data=[
                'amount'=>$amount*100,
                'currency'=> "INR",
                'receipt'=> "order_rcptid_" . time(),
                'notes'=> [
                    'user_id'   => auth()->id(),
                    'booking_id'   => $booking->id,
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

            return [
                'order_id'          => $response['id'],
                'amount'            => $response['amount']/100,
                'booking_id'        => $booking->booking_id,
                'key'               => $response['notes']['key'],
            ];

        }else{
            return response()->json(['message'=>'Booking Not Found!','status'=>422],422);
        }
    }

    public function remainingVerifySignature(Request $request){
        $this->validate($request, [
            'razorpay_order_id'         => 'required',
            'booking_id'                => 'required',
            'payment_status'            => 'required',
        ]);
        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));

        if($request->payment_status == 'captured'){
            $booking = ServiceBooking::where('booked_by',auth()->user()->id)->where('booking_id',$request->booking_id)->first();
            if($booking){
                $salon = Salon::where('id', $booking->getSalon->id)->first();

                $response = $api->utility->verifyPaymentSignature([
                    'razorpay_order_id'     => $request->razorpay_order_id,
                    'razorpay_payment_id'   => $request->razorpay_payment_id,
                    'razorpay_signature'    => $request->razorpay_signature
                ]);

                $res=$api->payment->fetch($request->razorpay_payment_id);

                $booking->paid_amount = $booking->total_amount;
                if(!$booking->payment_detail){
                    $booking->payment_detail = [['payment_id'=>$res->id,'order_id'=>$res->order_id,'amount'=>$res->amount/100,'payment_status'=>$request->payment_status,'date'=>Carbon::now(),'payment_type'=>'online']];
                }else{
                    $payment_details = [];
                    array_push($payment_details,$booking->payment_detail[0],['payment_id'=>$res->id,'order_id'=>$res->order_id,'amount'=>$res->amount/100,'payment_status'=>$request->payment_status,'date'=>Carbon::now(),'payment_type'=>'online']);
                    $booking->payment_detail = $payment_details;
                }
                $booking->payment_status = 'paid';
                $booking->save();

                $gst_amount = (($res->amount / 100) * 18) / 100;

                $salon_wallet = new SalonWallet;
                $salon_wallet->salon_id = $salon->id;
                $salon_wallet->amount = ($res->amount / 100) - $gst_amount;
                $salon_wallet->source_id = $booking->id;
                $salon_wallet->source = 'booking';
                $salon_wallet->type = 'credit';
                $salon_wallet->save();

                $salon->total_wallet_balance = $salon->total_wallet_balance + $salon_wallet->amount;
                $salon->save();

                return [
                    'payment_id'    => $res->id,
                    'order_id'      => $res->order_id,
                    'booking_id'    => $booking->id,
                    'amount'        => $res->amount/100,
                ];
            }else{
                return response()->json(['message'=>'Invalid Booking','status'=>422],422);
            }
        }else{
            return response()->json(['message'=>$request->message,'status'=>422],422);
        }

    }

}
