<?php

namespace App\Http\Controllers\Api;

use PDF;
use Auth;
use App\Models\Salon;
use App\Models\Product;
use App\Models\ProductCart;
use App\Models\UserAddress;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProductOrderResource;

class ProductOrderController extends Controller
{

    public function index(){
        $orders = ProductOrderResource::collection(ProductOrder::where('booked_id',Auth::user()->id)->latest()->get());

        return response()->json(['orders'=>$orders,'status'=>200],200);
    }

    public function store(Request $request){
        $this->validate($request,[
            'address'=>'required',
            'payment_type'=>'required|in:cod,online',
        ]);
        $cart_items = ProductCart::where('user_id',Auth::user()->id)->get();
        if(count($cart_items) > 0){
            $products = [];
            $salon = null;
            $total_amount = 0;
            foreach($cart_items as $cart_item){
                $product = Product::where('is_ban','0')->where('available','1')->where('id',$cart_item->product_id)->first();
                if($product){
                    $product->quantity = $cart_item->quantity;
                    $product->product_order_status = 'pending';
                    $products[] = $product;
                    $total_amount = ($total_amount + $product->discount_price) * $cart_item->quantity;
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
            $product_order->address = json_encode($request->address);
            $product_order->payment_type = $request->payment_type;
            $product_order->save();

            ProductCart::where('user_id',Auth::user()->id)->delete();

            sendNotification('Product Order', 'Product Ordered Successfully with order id '.$product_order->order_id, auth()->user()->fcm_token);

            return response()->json(['order_id'=>$product_order->order_id,'message'=>'Order Successfully!','status'=>200],200);
        }else{
            return response()->json(['message'=>'No Item in Cart!','status'=>200],200);
        }
    }

    public function invoice($order_id,$user_id){
        $order = ProductOrder::where('booked_id',decrypt($user_id))->where('order_id',$order_id)->first();
        if($order){
            view()->share('order',$order);

            $pdf = PDF::loadView('product_invoice');
            return $pdf->download('invoice.pdf');
        }else{
            abort(404);
        }
    }

}
