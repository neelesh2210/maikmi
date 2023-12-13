<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\WalletHistory;
use App\Http\Controllers\Controller;

class TransactionRecordController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:payment-history_list', ['only' => ['paymentHistory']]);
    }

    public function paymentHistory(Request $request)
    {
        $list = WalletHistory::with(['getUser']);
        $selectedDate = '';
        if($request->date){
            $selectedDate = $request->date;
            $explodeDate = explode(" to ",$selectedDate);
            if(count($explodeDate) == 1){
                return redirect()->back()->with('error', 'Invalid selected date.');
            }
            $from = $explodeDate[0];
            $to = $explodeDate[1];

            $list = $list->whereBetween('created_at', [$from, $to]);
        }
        $list = $list->orderBy('id', 'DESC')->paginate(20);
        return view('admin.transaction.payment_history', compact('list', 'selectedDate'), ['page_title' => 'Payment History']);
    }
}
