<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Salon;
use Illuminate\Http\Request;
use App\Models\ServiceBooking;
use App\Http\Controllers\Controller;
use App\Http\Resources\Users\ServiceBookingResource;

class ServiceBookingController extends Controller
{

    public function serviceBooking(Request $request){
        try{
            $data = new ServiceBooking;
            $data->booking_id = date('Ym').rand(1111, 9999);
            $data->user_id = Salon::find($request->salon_id)->user_id;
            $data->salon_id = $request->salon_id;
            $data->booked_by = auth()->id();
            $data->salon = $request->salon;
            $data->service = $request->service;
            $data->coupon = $request->coupon;
            $data->quantity = 1;
            $data->total_amount = $request->total_amount;
            $data->address = $request->address;
            $data->payment_type = $request->payment_type;
            $data->booking_date = $request->booking_date;
            $data->booking_time = $request->booking_time;
            $data->booking_at = Carbon::now();
            $data->start_at = Carbon::now();
            $data->end_at = Carbon::now();
            $data->at_salon = $request->at_salon;
            $data->status = $request->status;
            $data->save();

            // sendNotification('Service Booking', 'Service Booked Successfully with booking id '.$data->booking_id, auth()->user()->fcm_token);
            sendNotification('New Booking', 'New Booking Arrived with booking id '.$data->booking_id.'. Please confirm it.', $data->getSalon->getOwner->fcm_token);

            return response([
                'success'       => true,
                'booking_id'    => $data->booking_id,
                'message'       => 'Booking successfully',
            ], 200);

        }catch(\Exception $e){

            return response([
                'success'       => false,
                'message'       => 'Somthing went Wrong.'
            ], 400);

        }
    }

    public function serviceBookingList(){
        return response([
            'success'       => true,
            'data'          => ServiceBookingResource::collection(ServiceBooking::where('booked_by', auth()->user()->id)->orderBy('id', 'desc')->get()),
        ], 200);
    }

    public function serviceBookingCancel(Request $request){
        $booking = ServiceBooking::where('booked_by',auth()->user()->id)->where('booking_id',$request->booking_id)->first();
        if($booking){
            $booking->cancel_reason = $request->cancel_reason;
            $booking->status = 'cancelled';
            $booking->save();

            sendNotification('Service Booking Cancelled', 'Service Cancelled Successfully with booking id '.$booking->booking_id, auth()->user()->fcm_token);

            return response()->json(['message'=>'Booking Cancel Successfully!','status'=>200],200);
        }else{
            return response()->json(['message'=>'Booking Not Found!','status'=>422],422);
        }
    }

    public function serviceBookingWaiting(Request $request){
        $booking = ServiceBooking::where('booked_by',auth()->user()->id)->where('booking_id',$request->booking_id)->where('status','pending')->first();
        if($booking){
            $booking->status = 'waiting';
            $booking->save();

            sendNotification('Service Booking Waiting', 'Service Added in Queue Successfully with booking id '.$booking->booking_id, auth()->user()->fcm_token);

            return response()->json(['message'=>'Booking Added in Queue Successfully!','status'=>200],200);
        }else{
            return response()->json(['message'=>'Booking Not Found!','status'=>422],422);
        }
    }

    public function serviceBookingConfirm(Request $request){
        $booking = ServiceBooking::where('booked_by',auth()->user()->id)->where('booking_id',$request->booking_id)->where('status','time_update')->first();
        if($booking){
            $booking->status = 'time_update';
            $booking->save();

            sendNotification('Service Booking Confirmed', 'Service Confirmed Successfully with booking id '.$booking->booking_id, auth()->user()->fcm_token);
            sendNotification('Service Booking Confirmed', 'Service Confirmed Successfully with booking id '.$booking->booking_id, $booking->getSalon->getOwner->fcm_token);

            return response()->json(['message'=>'Booking Added in Queue Successfully!','status'=>200],200);
        }else{
            return response()->json(['message'=>'Booking Not Found!','status'=>422],422);
        }
    }

    public function serviceBookingStatusCheck(Request $request){
        $booking = ServiceBooking::where('booked_by',auth()->user()->id)->where('booking_id',$request->booking_id)->first();
        if($booking){
            return response()->json(['time'=>$booking->booking_time,'booking_status'=>$booking->status,'message'=>'Booking Added in Queue Successfully!','status'=>200],200);
        }else{
            return response()->json(['message'=>'Booking Not Found!','status'=>422],422);
        }
    }

    public function serviceBookingReschedule(Request $request){
        $booking = ServiceBooking::where('booked_by',auth()->user()->id)->where('booking_id',$request->booking_id)->first();
        if($booking){
            $booking->booking_date = $request->booking_date;
            $booking->booking_time = $request->booking_time;
            $booking->save();

            sendNotification('Service Booking Reschedule', 'Service Reschedule Successfully with booking id '.$booking->booking_id, auth()->user()->fcm_token);

            return response()->json(['message'=>'Booking Reschedule Successfully!','status'=>200],200);
        }else{
            return response()->json(['message'=>'Booking Not Found!','status'=>422],422);
        }
    }

    public function invoice($booking_id,$user_id){
        $booking = ServiceBooking::where('user_id',decrypt($user_id))->where('booking_id',$booking_id)->first();
        if($booking){
            view()->share('booking',$booking);

            $pdf = PDF::loadView('service_invoice');
            return $pdf->download('invoice.pdf');
        }else{
            abort(404);
        }
    }

}
