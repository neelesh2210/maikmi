<?php

namespace App\Http\Controllers\Api\Users;

use App\Models\Salon;
use App\Models\AppSlider;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;
use App\Http\Resources\Users\SalonResource;
use App\Http\Resources\Users\SliderResource;
use App\Http\Resources\Users\ServiceCategoryResource;

class HomeApiController extends Controller
{
    public function home(){
        return response([
            'success'                   => true,
            'sliders_list'              => SliderResource::collection($slider = AppSlider::orderBy('order', 'asc')->where('status', 1)->get()),
            'featured_service_category' => ServiceCategoryResource::collection(ServiceCategory::where('featured', 1)->where('status', 1)->with('getSubCategory')->get()),
            'service_category'          => ServiceCategoryResource::collection(ServiceCategory::where('status', 1)->with('getSubCategory')->get()),
            'featured_salon'            => SalonResource::collection(Salon::where('featured', 1)->where('available', 1)->with('getOwner')->get())
        ], 200);
    }
}
