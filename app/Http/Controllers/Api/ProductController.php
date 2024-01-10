<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProductResource;

class ProductController extends Controller
{

    public function detail($id){
        $product = Product::where('id',$id)->where('is_ban',0)->where('available',1)->first();
        if($product){
            return response()->json(['product'=>new ProductResource($product),'status'=>200],200);
        }

        return response()->json(['message'=>'Product Not Found!','status'=>422],422);
    }

}
