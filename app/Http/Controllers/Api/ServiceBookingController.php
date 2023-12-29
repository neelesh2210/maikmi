<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Salon;
use Illuminate\Http\Request;
use App\Models\ServiceBooking;
use App\Http\Controllers\Controller;

class ServiceBookingController extends Controller
{

    public function serviceBooking(Request $request)
    {
        try {

            $data = new ServiceBooking;
            $data->booking_id = date('Ym').rand(1111, 9999);
            $data->user_id = Salon::find($request->salon_id)->user_id;
            $data->salon_id = $request->salon_id;
            $data->booked_by = auth()->id();
            $data->salon = $request->salon;
            $data->service = $request->service;
            $data->coupon = $request->coupon;
            $data->quantity = 1;
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

        } catch (\Exception $e) {

            return response([
                'success'       => false,
                'message'       => 'Somthing went worng.'
            ], 400);

        }
    }

}
