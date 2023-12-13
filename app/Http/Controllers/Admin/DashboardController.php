<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\CallHistory;
use Illuminate\Http\Request;
use App\Models\WalletHistory;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index()
    {
        return view('admin.dashboard', ['page_title' => 'Admin Dashboard']);
    }

    public function changeTheme(Request $request)
    {
        if(isset($request->theme_change)){
            session()->put('selected_theme', 'Dark');
            $message = 'Dark Mode Apply !!';
        }else{
            session()->put('selected_theme', 'Light');
            $message = 'Light Mode Apply !!';
        }
        return back()->with('success', $message);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
