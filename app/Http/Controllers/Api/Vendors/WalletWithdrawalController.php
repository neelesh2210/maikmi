<?php

namespace App\Http\Controllers\Api\Vendors;

use Auth;
use Illuminate\Http\Request;
use App\Models\WithdrawalRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Vendors\WithdrawalResource;

class WalletWithdrawalController extends Controller
{

    public function index() {
        $withdrawal_list = WithdrawalResource::collection(WithdrawalRequest::where('salon_id',Auth::user()->getSalon->id)->latest()->paginate(20));

        return response()->json([
            'withdrawal_list'=>$withdrawal_list,
            'links'                     =>[
                'first_page_url'        => $withdrawal_list->url($withdrawal_list->firstItem()),
                'last_page_url'         => $withdrawal_list->url($withdrawal_list->lastPage()),
                'next_page_url'         => $withdrawal_list->nextPageUrl(),
                'prev_page_url'         => $withdrawal_list->previousPageUrl(),
            ],
            'message'=>'List Retrived Successfully!',
            'status'=>200
        ],200);
    }

    public function store(Request $request) {
        $request->validate([
            'amount'    => 'required|integer|min:200',
        ]);

        $withdrawal_data = WithdrawalRequest::where('salon_id',Auth::user()->getSalon->id)->where('status','pending')->first();

        if($withdrawal_data){
            return response()->json([
                'status' => 'error',
                'message' => 'You have already a pending withdrawal request.'
            ],422);
        }
        if(Auth::user()->getSalon->total_wallet_balance >= $request->amount){
            $withdrawal = new WithdrawalRequest;
            $withdrawal->salon_id = Auth::user()->getSalon->id;
            $withdrawal->amount = $request->amount;
            $withdrawal->save();

            return response()->json(['message'=>'Withdrawal request has been submitted successfully.'],200);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Insufficient balance.'
            ],422);
        }
    }

}
