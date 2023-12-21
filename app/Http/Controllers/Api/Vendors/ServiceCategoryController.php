<?php

namespace App\Http\Controllers\Api\Vendors;

use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ServiceCategoryResource;

class ServiceCategoryController extends Controller
{

    public function index(){
        $service_categories = ServiceCategoryResource::collection(ServiceCategory::where('status',1)->get());

        return response()->json(['service_categories'=>$service_categories,'message'=>'Service Category List Retrive Successfully!','status'=>200],200);
    }

}
