<?php

namespace App\Http\Controllers\Admin;

use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use App\Models\Service;
use App\Models\CallHistory;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use App\Models\WalletHistory;
use App\Models\ServiceBooking;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index(Request $request){
        $total_users = User::where('type','user')->count();
        $total_shops = User::where('type','vendor')->count();
        $total_products = Product::count();
        $total_services = Service::count();
        $total_pending_orders = ProductOrder::where('status','pending')->count();
        $total_completed_orders = ProductOrder::where('status','completed')->count();
        $total_orders = ProductOrder::count();
        $total_order_amount = ProductOrder::sum('total_amount');
        $total_pending_bookings = ServiceBooking::where('status','pending')->count();
        $total_completed_bookings = ServiceBooking::where('status','completed')->count();
        $total_bookings = ServiceBooking::count();
        $total_booking_amount = ServiceBooking::sum('total_amount');

        $week_dates = [];
        foreach( range( -6, 0 ) AS $i ) {
            $date = Carbon::now()->addDays( $i )->format( 'Y-m-d' );
            array_push($week_dates,$date);
        }
        $orders=[];
        foreach($week_dates as $week_date)
        {
            $total_order = ProductOrder::whereDate('created_at',$week_date )->count();
            $orders[]=$total_order;
        }

        $bookings=[];
        foreach($week_dates as $week_date)
        {
            $total_booking = ServiceBooking::whereDate('created_at',$week_date )->count();
            $bookings[]=$total_booking;
        }

        return view('admin.dashboard',compact('total_users','total_shops','total_products','total_services','total_pending_orders','total_completed_orders','total_orders','total_order_amount','total_pending_bookings','total_completed_bookings','total_bookings','total_booking_amount','week_dates','orders','bookings'), ['page_title' => 'Admin Dashboard']);
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
