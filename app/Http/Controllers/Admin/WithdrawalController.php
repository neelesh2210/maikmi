<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\WithdrawalRequest;
use App\Http\Controllers\Controller;

class WithdrawalController extends Controller
{

    public function index() {
        $withdrawals = WithdrawalRequest::with('salon')->latest()->paginate(10);

        return view('admin.withdrawal.index', compact('withdrawals'), ['page_title'=>'Withdrawal Requests']);
    }

}
