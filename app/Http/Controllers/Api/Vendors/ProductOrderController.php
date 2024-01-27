<?php

namespace App\Http\Controllers\Api\Vendors;

use Auth;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProductOrderResource;

class ProductOrderController extends Controller
{

    public function index(){
        $orders = ProductOrderResource::collection(ProductOrder::where('user_id',Auth::user()->id)->latest()->get());

        return response()->json(['orders'=>$orders,'status'=>200],200);
    }

    public function statusChange(Request $request){
        $this->validate($request,[
            'order_id'=>'required',
            'product_id'=>'required',
            'status'=>'required|in:confirm,cancel',
        ]);

        $order = ProductOrder::where('order_id',$request->order_id)->first();

        if($order){
            $products = json_decode($order->products);
            $have_product = 0;
            $product_array = [];
            foreach($products as $product){
                if($product->id == $request->product_id){
                    $have_product = 1;
                    $product->product_order_status = $request->status;
                    $product_array[] = $product;
                }else{
                    $product_array[] = $product;
                }
            }
            if($have_product == 0){
                return response()->json(['message'=>'Product Not Found!','status'=>422],422);
            }else{
                $order->products = $product_array;
                $order->save();

                return response()->json(['message'=>'Status Updated Successfully!','status'=>200],200);
            }
        }else{
            return response()->json(['message'=>'Order Not Found!','status'=>422],422);
        }
    }

}
