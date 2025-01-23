<?php

namespace App\Http\Controllers\Admin;

use App\Models\Salon;
use App\Models\SalonWallet;
use Illuminate\Http\Request;
use App\Models\WithdrawalRequest;
use App\Http\Controllers\Controller;

class WithdrawalController extends Controller
{

    public function index() {
        $withdrawals = WithdrawalRequest::with('salon')->latest()->paginate(10);

        return view('admin.withdrawal.index', compact('withdrawals'), ['page_title'=>'Withdrawal Requests']);
    }

    public function status(Request $request) {
        $withdrawal = WithdrawalRequest::where('id',$request->id)->where('status','pending')->first();
        if($withdrawal) {
            $withdrawal->status = $request->status;
            $withdrawal->save();

            if($request->status == 'success') {
                $salon_wallet = new SalonWallet;
                $salon_wallet->salon_id = $withdrawal->salon_id;
                $salon_wallet->amount = $withdrawal->amount;
                $salon_wallet->source_id = $withdrawal->id;
                $salon_wallet->source = 'withdrawal';
                $salon_wallet->type = 'debit';
                $salon_wallet->save();

                $salon = Salon::where('id',$withdrawal->salon_id)->first();
                $salon->total_wallet_balance = $salon->total_wallet_balance - $withdrawal->amount;
                $salon->save();
            }
            return response()->json(['status' => 'success', 'message' => 'Status updated successfully']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Invalid request'],422);
        }
    }

}
