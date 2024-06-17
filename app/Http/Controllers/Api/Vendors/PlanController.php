<?php

namespace App\Http\Controllers\Api\Vendors;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Vendors\PlanResource;

class PlanController extends Controller
{

    public function index(){
        $plans = Plan::where('is_active','1')->oldest('discounted_price')->get();

        return response()->json(['plans'=>PlanResource::collection($plans),'message'=>'Plan List Retrive Successfully!','status'=>200],200);
    }

}
