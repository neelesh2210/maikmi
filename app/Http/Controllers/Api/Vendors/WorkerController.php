<?php

namespace App\Http\Controllers\Api\Vendors;

use Auth;
use App\Models\Worker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkerController extends Controller
{

    public function index(){
        if(Auth::user()->getSalon()){
            $workers = Worker::where('user_id',Auth::user()->id)->where('salon_id',Auth::user()->getSalon->id)->get(['id','name','is_free']);

            return response()->json(['workers'=>$workers,'message'=>'Worker List Retrive Successfully!','status'=>200],200);
        }else{
            return response()->json(['message'=>'Salon Not Found','status'=>422],422);
        }
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required'
        ]);
        if(Auth::user()->getSalon){
            $worker = new Worker;
            $worker->user_id = Auth::user()->id;
            $worker->salon_id = Auth::user()->getSalon->id;
            $worker->name = $request->name;
            $worker->save();

            return response()->json(['message'=>'Worker Added Successfully!','status'=>200],200);
        }else{
            return response()->json(['message'=>'Salon Not Found!','status'=>422],422);
        }
    }

}
