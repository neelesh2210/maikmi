<?php

namespace App\Http\Controllers\Api\Vendors;

use Auth;
use Carbon\Carbon;
use App\Models\Worker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkerController extends Controller
{

    public function index(){
        if(Auth::user()->getSalon()){
            $workers = Worker::where('user_id',Auth::user()->id)->where('salon_id',Auth::user()->getSalon->id)->get(['id','name','engage_time','engage_duration','is_free']);

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

    public function status(Request $request){
        $workers = Worker::where('user_id',Auth::user()->id)->pluck('id');
        $this->validate($request,[
            'worker_id'=>'required|in:'.implode(',',$workers->toArray()),
            'is_free'=>'required|in:1,0',
            'engage_duration'=>'nullable|required_if:is_free,0'
        ]);

        $worker = Worker::where('user_id',Auth::user()->id)->where('id',$request->worker_id)->first();
        if($worker){
            $worker->is_free = $request->is_free;
            if($request->is_free == '0'){
                $worker->engage_time = Carbon::now();
                $worker->engage_duration = $request->engage_duration;
            }else{
                $worker->engage_time = null;
                $worker->engage_duration = null;
            }
            $worker->save();

            return response()->json(['message'=>'Worker Status Changed Successfully!','status'=>200],200);
        }else{
            return response()->json(['message'=>'No Worker Found!','status'=>422],422);
        }
    }

    public function destroy($worker_id){
        return $worker = Worker::where('user_id',Auth::user()->id)->where('id',$worker_id)->first();

        if($worker){
            $worker->delete();

            return response()->json(['message'=>'Worker Deleted Successfully!','status'=>200],200);
        }else{
            return response()->json(['message'=>'No Worker Found!','status'=>422],422);
        }
    }

}
