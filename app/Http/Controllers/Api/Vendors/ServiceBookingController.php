<?php

namespace App\Http\Controllers\Api\Vendors;

use Illuminate\Http\Request;
use App\Models\ServiceBooking;
use App\Models\PlanPurchaseHistory;
use App\Http\Controllers\Controller;
use App\Http\Resources\Users\ServiceBookingResource;

class ServiceBookingController extends Controller
{

    public function serviceBookingList(){
        return response([
            'success'       => true,
            'data'          => ServiceBookingResource::collection(ServiceBooking::where('user_id', auth()->id())->with('getBookedBy')->orderBy('id', 'desc')->get()),
        ], 200);
    }

    public function serviceBookingStatusChange(Request $request){
        $this->validate($request,[
            'booking_id'=>'required',
            'status'=>'required|in:booked,confirmed,completed,cancelled',
            'time'  =>'nullable|date_format:g:i A'
        ]);
        $service_booking = ServiceBooking::where('booking_id',$request->booking_id)->whereIn('status',['waiting','pending'])->first();
        if($service_booking){
            $plan_purchase = PlanPurchaseHistory::where('user_id',auth()->id())->where('plan_status','active')->first();
            if($plan_purchase){
                if($request->status == 'confirmed'){
                    if($request->time){
                        $service_booking->booking_time = $request->time;
                        $service_booking->status = 'time_update';
                    }else{
                        $service_booking->status = 'confirmed';
                    }
                    sendNotification('Booking Confirm', 'Your Booking is confirmed by vendor with booking id '.$service_booking->booking_id, $service_booking->getBookedBy->fcm_token);
                }else{
                    $service_booking->status = $request->status;
                    sendNotification('Booking Cancelled', 'Your Booking is cancelled by vendor with booking id '.$service_booking->booking_id, $service_booking->getBookedBy->fcm_token);
                }
                $service_booking->save();

                return response()->json(['message'=>'Booking Status Changed Successfully!','status'=>200],200);
            }else{
                return response()->json(['message'=>'You do not have any subscription to accept booking!','status'=>401],401);
            }
        }else{
            return response()->json(['message'=>'Booking Not Found','status'=>401],401);
        }
    }

}
