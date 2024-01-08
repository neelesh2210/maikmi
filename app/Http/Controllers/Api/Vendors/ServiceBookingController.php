<?php

namespace App\Http\Controllers\Api\Vendors;

use Illuminate\Http\Request;
use App\Models\ServiceBooking;
use App\Http\Controllers\Controller;
use App\Http\Resources\Users\ServiceBookingResource;

class ServiceBookingController extends Controller
{

    public function serviceBookingList(){
        return response([
            'success'       => true,
            'data'          => ServiceBookingResource::collection(ServiceBooking::where('user_id', auth()->id())->orderBy('id', 'desc')->get()),
        ], 200);
    }

    public function serviceBookingStatusChange(Request $request){
        $this->validate($request,[
            'booking_id'=>'required',
            'status'=>'required|in:booked,confirmed,completed,cancelled'
        ]);

        $service_booking = ServiceBooking::where('booking_id',$request->booking_id)->first();
        if($service_booking){
            $service_booking->status = $request->status;
            $service_booking->save();

            return response()->json(['message'=>'Booking Status Changed Successfully!','status'=>200],200);
        }else{
            return response()->json(['message'=>'Booking Not Found','status'=>401],401);
        }
    }

}
