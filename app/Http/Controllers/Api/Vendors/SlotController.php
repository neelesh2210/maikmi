<?php

namespace App\Http\Controllers\Api\Vendors;

use Auth;
use App\Models\Salon;
use Illuminate\Http\Request;
use App\Models\AvailabilityHour;
use App\Http\Controllers\Controller;

class SlotController extends Controller
{

    public function getTimeSlot(){
        $list = AvailabilityHour::where('user_id',Auth::user()->id)->get(['day','start_at','end_at','status']);

        return response()->json(['list'=>$list,'message'=>'List Retrived Successfully!','status'=>200],200);
    }

    public function updateTimeSlot(Request $request){
        $input = $request->all();
        $salonData = Salon::find(Auth::user()->getSalon->id);
        foreach($request->days as $key => $day){
            $data = AvailabilityHour::where('salon_id', Auth::user()->getSalon->id)->where('day', $day)->first();
            if(!$data){
                $data = new AvailabilityHour;
            }
            $data->user_id = $salonData->user_id;
            $data->salon_id = Auth::user()->getSalon->id;
            $data->day = $day;
            $data->start_at = $request->start_at?$request->start_at[$key]:NULL;
            $data->end_at = $request->end_at?$request->end_at[$key]:NULL;
            $data->status = isset($input[$day.'_status']) ? $input[$day.'_status']: 0;
            $data->save();
        }

        return response()->json(['message'=>'Slot Updated Successfully!','status'=>200],200);
    }

}
