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
        $search_user_latitude = $request->search_user_latitude;
        $search_user_longitude = $request->search_user_longitude;

        if(Auth::user()->referrer_code){
            $referrer_salon = Salon::where('salon_unique_id',Auth::user()->referrer_code)->first();
            if($referrer_salon){
                $featured_salons = Salon::whereHas('getOwner',function($query){
                    $query->where('is_active','active');
                })->where('available','1')->where('featured','1')->when($search_city, function ($q) use ($search_city) {
                    $q->where('city',$search_city);
                })->orderByRaw("FIELD(id,$referrer_salon->id) DESC")->orderBy("id","desc")->take(10)->get();

                $at_home_salons = Salon::whereHas('getOwner',function($query){
                    $query->where('is_active','active');
                })->where('available','1')->where('home_service_status','1')->when($search_city, function ($q) use ($search_city) {
                    $q->where('city',$search_city);
                })->orderByRaw("FIELD(id,$referrer_salon->id) DESC")->orderBy("id","desc")->take(10)->get();
            }else{
                $featured_salons = Salon::whereHas('getOwner',function($query){
                    $query->where('is_active','active');
                })->where('available','1')->where('featured','1')->when($search_city, function ($q) use ($search_city) {
                    $q->where('city',$search_city);
                })->orderBy("id","desc")->take(10)->get();

                $at_home_salons = Salon::whereHas('getOwner',function($query){
                    $query->where('is_active','active');
                })->where('available','1')->where('home_service_status','1')->when($search_city, function ($q) use ($search_city) {
                    $q->where('city',$search_city);
                })->orderBy("id","desc")->take(10)->get();
            }
        }else{
            $featured_salons = Salon::whereHas('getOwner',function($query){
                $query->where('is_active','active');
            })->where('available','1')->where('featured','1')->when($search_city, function ($q) use ($search_city) {
                $q->where('city',$search_city);
            })->orderBy("id","desc")->take(10)->get();

            $at_home_salons = Salon::whereHas('getOwner',function($query){
                $query->where('is_active','active');
            })->where('available','1')->where('home_service_status','1')->when($search_city, function ($q) use ($search_city) {
                $q->where('city',$search_city);
            })->orderBy("id","desc")->take(10)->get();
        }

        foreach($featured_salons as $featured_salon){
            $featured_salon->distance = latLongDistanceCalculate($featured_salon->latitude, $featured_salon->longitude, $search_user_latitude, $search_user_longitude, 'K');
        }

        $featured_salons = $featured_salons->toArray();

        usort($featured_salons, function($a, $b) {
            return $a['distance'] - $b['distance'];
        });

        $featured_salons = SalonResource::collection($featured_salons);

        foreach($at_home_salons as $at_home_salon){
            $at_home_salon->distance = latLongDistanceCalculate($at_home_salon->latitude, $at_home_salon->longitude, $search_user_latitude, $search_user_longitude, 'K');
        }

        $at_home_salons = $at_home_salons->toArray();

        usort($at_home_salons, function($a, $b) {
            return $a['distance'] - $b['distance'];
        });

        $at_home_salons = SalonResource::collection($at_home_salons);


        $salon_list = Salon::whereHas('getOwner',function($query){
            $query->where('is_active','active');
        })->where('available','1')->when($search_city, function ($q) use ($search_city) {
            $q->where('city',$search_city);
        })->take(20)->get();

        foreach ($salon_list as $salon_data) {
            $salon_data->distance = latLongDistanceCalculate($salon_data->latitude, $salon_data->longitude, $search_user_latitude, $search_user_longitude, 'K');
        }

        $salon_list = $salon_list->toArray();

        usort($salon_list, function($a, $b) {
            return $a['distance'] - $b['distance'];
        });

        $salons =  SalonResource::collection($salon_list);

        return response()->json([
                                    'service_categories'=>$service_categories,
                                    'featured_salons'=>$featured_salons,
                                    'at_home_salons'=>$at_home_salons,
                                    'salons'=>$salons,
                                    'message'=>'Data Retrived Successfully!',
                                    'status'=>200
                                ],200);
    }

}
