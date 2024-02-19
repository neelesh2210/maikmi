<?php

namespace App\Http\Controllers\Api;

use Auth;
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

    public function home(Request $request){
        $service_categories = ServiceCategoryResource::collection(ServiceCategory::where('status','1')->where('featured','1')->get());
        $search_city = $request->search_city;

        if(Auth::user()->referrer_code){
            $referrer_salon = Salon::where('salon_unique_id',Auth::user()->referrer_code)->first();
            if($referrer_salon){
                $featured_salons = SalonResource::collection(Salon::whereHas('getOwner',function($query){
                    $query->where('is_active','active');
                })->where('available','1')->where('featured','1')->when($search_city, function ($q) use ($search_city) {
                    $q->where('city',$search_city);
                })->orderByRaw("FIELD(id,$referrer_salon->id) DESC")->orderBy("id","desc")->take(10)->get());
            }else{
                $featured_salons = SalonResource::collection(Salon::whereHas('getOwner',function($query){
                    $query->where('is_active','active');
                })->where('available','1')->where('featured','1')->when($search_city, function ($q) use ($search_city) {
                    $q->where('city',$search_city);
                })->orderBy("id","desc")->take(10)->get());
            }
        }else{
            $featured_salons = SalonResource::collection(Salon::whereHas('getOwner',function($query){
                $query->where('is_active','active');
            })->where('available','1')->where('featured','1')->when($search_city, function ($q) use ($search_city) {
                $q->where('city',$search_city);
            })->orderBy("id","desc")->take(10)->get());
        }

        $salons = SalonResource::collection(Salon::whereHas('getOwner',function($query){
            $query->where('is_active','active');
        })->where('available','1')->when($search_city, function ($q) use ($search_city) {
            $q->where('city',$search_city);
        })->take(20)->get());

        return response()->json([
                                    'service_categories'=>$service_categories,
                                    'featured_salons'=>$featured_salons,
                                    'salons'=>$salons,
                                    'message'=>'Data Retrived Successfully!',
                                    'status'=>200
                                ],200);
    }

}
