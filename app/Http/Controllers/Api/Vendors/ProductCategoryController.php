<?php

namespace App\Http\Controllers\Api\Vendors;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProductCategoryResource;

class ProductCategoryController extends Controller
{

    public function index(){
        $product_categories = ProductCategoryResource::collection(ProductCategory::where('status',1)->get());

        return response()->json(['product_categories'=>$product_categories,'message'=>'Product Category List Retrive Successfully!','status'=>200],200);
    }

}
