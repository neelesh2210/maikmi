<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Models\Salon;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProductSearchResource;

class ProductSearchController extends Controller
{

    public function search(Request $request){
        $search_key = $request->search_key;

        $products = Product::where('name','LIKE','%'.$search_key.'%')->select(['id','name','image', DB::raw("'product' as type")])->get();
        $salons = Salon::where('name','LIKE','%'.$search_key.'%')->select(['id','name','image', DB::raw("'salon' as type")])->get();

        $results = ProductSearchResource::collection($products->concat($salons)->take(10));

        return response()->json(['results'=>$results,'message'=>'Search Results Retrived Successfully!','status'=>200],200);
    }

}
