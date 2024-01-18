<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Models\Salon;
use App\Models\Product;
use App\Models\ProductCart;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductOrderController extends Controller
{

    public function index(){
        $orders = ProductOrder::latest()->get();

        return response()->json(['orders'=>$orders,'status'=>200],200);
    }

    public function store(Request $request){
        $cart_items = ProductCart::where('user_id',Auth::user()->id)->get();
        $products = [];
        $salon = null;
        $total_amount = 0;
        foreach($cart_items as $cart_item){
            $product = Product::where('is_ban','0')->where('available','1')->where('id',$cart_item->product_id)->first();
            if($product){
                $product->quantity = $cart_item->quantity;
                $products[] = $product;
                $total_amount = $total_amount + $product->discount_price;
            }
            $salon = Salon::where('id',$cart_item->salon_id)->first();
        }

        $product_order = new ProductOrder;
        $product_order->order_id = date('Ym').rand(1111, 9999);
        $product_order->user_id = $salon->user_id;
        $product_order->salon_id = $salon->id;
        $product_order->booked_id = Auth::user()->id;
        $product_order->salon = $salon;
        $product_order->products = json_encode($products);
        $product_order->total_amount = $total_amount;
        $product_order->address = '';
        $product_order->payment_type = 'cod';
        $product_order->save();

        ProductCart::where('user_id',Auth::user()->id)->delete();

        return response()->json(['message'=>'Order Successfully!','status'=>200],200);
    }

}
