<?php

namespace App\Http\Controllers\Api;

use App\Models\Salon;
use App\Models\Product;
use App\Models\AppSlider;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\SalonResource;
use App\Http\Resources\Api\ProductResource;
use App\Http\Resources\Api\AppSliderResource;
use App\Http\Resources\Api\ProductCategoryResource;
use App\Http\Resources\Api\ServiceCategoryResource;

class HomeController extends Controller
{

    public function home(){
        $service_categories = ServiceCategoryResource::collection(ServiceCategory::where('status','1')->where('featured','1')->get());

        $featured_salons = SalonResource::collection(Salon::whereHas('getOwner',function($query){
            $query->where('is_active','active');
        })->where('available','1')->where('featured','1')->take(10)->get());

        $salons = SalonResource::collection(Salon::whereHas('getOwner',function($query){
            $query->where('is_active','active');
        })->where('available','1')->take(10)->get());

        return response()->json([
                                    'service_categories'=>$service_categories,
                                    'featured_salons'=>$featured_salons,
                                    'salons'=>$salons,
                                    'message'=>'Data Retrived Successfully!',
                                    'status'=>200
                                ],200);
    }

}
