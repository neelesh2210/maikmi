<?php

namespace App\Http\Controllers\Api\Vendors;

use Auth;
use Illuminate\Http\Request;
use App\Models\ShopBankDetail;
use App\Http\Controllers\Controller;

class BankDetailController extends Controller
{

    public function index() {
        $bank_detail = ShopBankDetail::where('shop_id', Auth::user()->getSalon->id)->first();

        return response()->json(['bank_detail' => $bank_detail]);
    }

    public function store(Request $request) {
        $bank_detail = ShopBankDetail::where('shop_id', Auth::user()->getSalon->id)->first();
        if(!$bank_detail) {
            $bank_detail = new ShopBankDetail;
            $bank_detail->shop_id = Auth::user()->getSalon->id;
        } else {
            $bank_detail->bank_name = $request->bank_name;
            $bank_detail->branch_name = $request->branch_name;
            $bank_detail->account_number = $request->account_number;
            $bank_detail->account_holder_name = $request->account_holder_name;
            $bank_detail->ifsc_code = $request->ifsc_code;
            $bank_detail->upi_id = $request->upi_id;
        }
        $bank_detail->save();

        return response()->json(['message' => 'Bank details saved successfully']);
    }

}
