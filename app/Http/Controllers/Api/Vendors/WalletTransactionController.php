<?php

namespace App\Http\Controllers\Api\Vendors;

use Auth;
use App\Models\Salon;
use App\Models\SalonWallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WalletTransactionController extends Controller
{

    public function index() {
        $wallet_transactions = SalonWallet:: where('salon_id', Auth::user()->getSalon->id)->latest()->paginate(50,['amount', 'source', 'type', 'created_at']);
        $salon = Salon::where('id' , Auth::user()->getSalon->id)->first();
        return response()->json([
            'wallet_transactions'=>$wallet_transactions,
            // 'links'                     =>[
            //     'first_page_url'        => $wallet_transactions->url($wallet_transactions->firstItem()),
            //     'last_page_url'         => $wallet_transactions->url($wallet_transactions->lastPage()),
            //     'next_page_url'         => $wallet_transactions->nextPageUrl(),
            //     'prev_page_url'         => $wallet_transactions->previousPageUrl(),
            // ],
            'message'=>'Wallet Transaction Retrived Successfully!',
            'total_wallet_amount'=>$salon->total_wallet_balance,
            'status'=>200
        ],200);
    }

}
