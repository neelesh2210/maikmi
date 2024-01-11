<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Models\Salon;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ServiceSearchResource;

class ServiceSearchController extends Controller
{

    public function search(Request $request){
        $search_key = $request->search_key;

        $services = Service::where('name','LIKE','%'.$search_key.'%')->select(['id','name','image', DB::raw("'service' as type")])->get();
        $salons = Salon::where('name','LIKE','%'.$search_key.'%')->select(['id','name','image', DB::raw("'salon' as type")])->get();

        $results = ServiceSearchResource::collection($services->concat($salons)->take(10));

        return response()->json(['results'=>$results,'message'=>'Search Results Retrived Successfully!','status'=>200],200);
    }

}
