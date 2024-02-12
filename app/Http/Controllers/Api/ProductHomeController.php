<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\AppSlider;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProductResource;
use App\Http\Resources\Api\AppSliderResource;
use App\Http\Resources\Api\ProductCategoryResource;

class ProductHomeController extends Controller
{

    public function home(){
        $product_categories = ProductCategoryResource::collection(ProductCategory::where('status','1')->where('featured','1')->get());

        $app_sliders = AppSliderResource::collection(AppSlider::where('status',1)->orderBy('id','desc')->get());
        $feature_products = ProductResource::collection(Product::where('is_ban',0)->where('available',1)->where('featured',1)->take('10')->orderBy('id','desc')->get());
        $new_products = ProductResource::collection(Product::where('is_ban',0)->where('available',1)->take('16')->orderBy('id','desc')->get());

        return response()->json([
                                    'product_categories'=>$product_categories,
                                    'app_sliders'=>$app_sliders,
                                    'feature_products'=>$feature_products,
                                    'new_products'=>$new_products,
                                    'message'=>'Data Retrived Successfully!',
                                    'status'=>200
                                ],200);
    }

}
