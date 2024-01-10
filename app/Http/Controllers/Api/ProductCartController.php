<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Models\Product;
use App\Models\ProductCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductCartController extends Controller
{

    public function store(Request $request){
        $this->validate($request,[
            'product_id'=>'required|integer',
            'quantity'=>'required|integer',
        ]);

        $product = Product::where('id',$request->product_id)->first();
        if($product){
            $product_cart = ProductCart::updateOrCreate([
                'salon_user_id'=>$product->user_id,
                'salon_id'=>$product->salon_id,
                'user_id'=>Auth::user()->id,
                'product_id'=>$product->id,
            ],[
                'quantity'=>$request->quantity
            ]);

            return response()->json(['message'=>'Product Added to Cart','status'=>200],200);
        }else{
            return response()->json(['message'=>'Product Not Found!','status'=>422],422);
        }
    }

    public function destroy(Request $request){
        $product = Product::where('id',$request->product_id)->first();
        if($product){
            $product_cart = ProductCart::where('salon_user_id',$product->user_id)->where('salon_id',$product->salon_id)->where('user_id',Auth::user()->id)->where('product_id',$product->id)->delete();

            return response()->json(['message'=>'Product Deleted from Cart','status'=>200],200);
        }else{
            return response()->json(['message'=>'Product Not Found!','status'=>422],422);
        }
    }

}
