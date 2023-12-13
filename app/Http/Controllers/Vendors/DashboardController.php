<?php

namespace App\Http\Controllers\Vendors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('vendors.dashboard', ['page_title' => 'Salon Dashboard']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('vendors.login')->with('success', 'Signed Out successfully !!');
    }
}
