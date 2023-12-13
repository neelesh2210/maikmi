<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\WalletHistory;
use App\Models\PaymentHistory;
use App\Http\Controllers\Controller;

class InstamojoController extends Controller
{
    public function redirection(Request $request)
    {
        $user = User::find($request->user_id);

        $amount = $request->amount;
        $payment_id = $request->payment_id;
        $payment_status = $request->payment_status;
        $payment_request_id = $request->payment_request_id;

        $payment = PaymentHistory::where('payment_id', $payment_request_id)->first();
        $payment->order_id = $payment_id;
        $payment->status = $payment_status;
        $payment->save();

        if($payment_status == 'Credit'){

            $user->balance+=$amount;
            $user->save();

            $wallet_history = new WalletHistory;
            $wallet_history->user_id = $request->user_id;
            $wallet_history->transaction_id = "TXN".time().rand(100, 999);
            $wallet_history->balance = $amount;
            $wallet_history->status = "credit";
            $wallet_history->save();

        }
        return view('frontend.instamojo_redirection', compact('user', 'amount', 'payment_id', 'payment_status', 'payment_request_id'));
    }
}
