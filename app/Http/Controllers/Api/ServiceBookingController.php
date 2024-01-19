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

            return response([
                'success'       => true,
                'booking_id'    => $data->booking_id,
                'message'       => 'Booking successfully',
            ], 200);

        }catch(\Exception $e){

            return response([
                'success'       => false,
                'message'       => 'Somthing went worng.'
            ], 400);

        }
    }

    public function serviceBookingList(){
        return response([
            'success'       => true,
            'data'          => ServiceBookingResource::collection(ServiceBooking::where('booked_by', auth()->id())->orderBy('id', 'desc')->get()),
        ], 200);
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
