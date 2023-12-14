<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ServiceCategoryResource;

class HomeController extends Controller
{

    public function home(){
        $service_categories = ServiceCategoryResource::collection(ServiceCategory::where('status','1')->where('featured','1')->get());

        return response()->json(['service_categories'=>$service_categories,'message'=>'Data Retrived Successfully!','status'=>200],200);
    }

}
