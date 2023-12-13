<?php

namespace App\Http\Controllers\Vendors\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth', ['except' => ['logout']]);
    // }

    public function showLoginForm()
    {
        return view('vendors.auth.login',['page_title' => 'Salon Login']);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required|numeric',
            'password' => 'required|min:6'
        ]);

        $remember = $request->remember ? 1 : 0;

        if (Auth::attempt(['phone' => $request->phone, 'password' => $request->password], $remember)){

            return redirect()->route('vendors.dashboard')->with('success', 'Signed in successfully !!');
        }

        return redirect()->route('vendors.login')->withInput($request->only('phone', 'remember'))->withErrors(['password' => ['These credentials don\'t match our records.','Or Incorrect Password']]);
    }
}
