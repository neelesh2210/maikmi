<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductOrderController extends Controller
{

    public function index(Request $request){
        $orders = ProductOrder::latest()->paginate(10);

        return view('admin.product_order.index',compact('orders'),['page_title'=>'Product Order List']);
    }

    public function show($order_id){
        $order = ProductOrder::where('order_id',$order_id)->first();

        return view('admin.product_order.show',compact('order'),['page_title'=>'Product Order Detail']);
    }

}
