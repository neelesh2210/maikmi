<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Salon;
use App\Models\Worker;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Models\ServiceBooking;
use App\Models\AvailabilityHour;
use App\Http\Controllers\Controller;

class SlotController extends Controller
{

    public function timeSlot(Request $request){
        $salons = Salon::whereHas('getOwner',function($query){
            $query->where('is_active','active');
        })->where('available',1)->pluck('id')->toArray();

        $this->validate($request,[
            'salon_id'=>'required|in:'.implode(',',$salons),
            'date'=>'required|date_format:Y-m-d'
        ]);

        $date = Carbon::createFromFormat('Y-m-d', $request->date);
        $day = strtolower($date->format('l'));
        $periods = CarbonPeriod::since($date->subDay()->ceilDay())->minutes(30)->until($date->addDay()->ceilDay()->subMinutes(30));

        $workers = Worker::where('salon_id',$request->salon_id)->count();

        $morningTimeSlot = [];
        $afternoonTimeSlot = [];
        $eveningTimeSlot = [];
        $nightTimeSlot = [];
        $midNightTimeSlot = [];
        foreach ($periods as $key => $period) {

            $time = Carbon::parse($period)->format('H:i');

            $availability = false;

            $availabilityHour = AvailabilityHour::where('salon_id', $request->salon_id)->where('day', $day)->where('status', 1)->first();

            if($availabilityHour && $availabilityHour->start_at && $availabilityHour->end_at){
                if($availabilityHour->start_at <= $time && $availabilityHour->end_at > $time){
                    $availability = true;
                }
            }

            if(date('H:i') >= $time){
                $availability = false;
            }

            $service_bookings = ServiceBooking::where('salon_id',$request->salon_id)->whereIn('status',['pending','booked','confirmed'])->where('booking_date',$request->date)->where('booking_time',$time)->count();

            if($service_bookings >= $workers){
                $availability = false;
            }
            if($time >= "06:00" && $time < "12:00"){
                $morningTimeSlot[] = [
                    'time'          => date("g:i A", strtotime($time)),
                    'availability'  => $availability
                ];
            }

            if($time >= "12:00" && $time < "16:00"){
                $afternoonTimeSlot[] = [
                    'time'          => date("g:i A", strtotime($time)),
                    'availability'  => $availability
                ];
            }

            if($time >= "16:00" && $time < "20:00"){
                $eveningTimeSlot[] = [
                    'time'          => date("g:i A", strtotime($time)),
                    'availability'  => $availability
                ];
            }

            if($time >= "20:00" && $time < "23:59"){
                $nightTimeSlot[] = [
                    'time'          => date("g:i A", strtotime($time)),
                    'availability'  => $availability
                ];
            }

            if($time >= "00:00" && $time < "06:00"){
                $midNightTimeSlot[] = [
                    'time'          => date("g:i A", strtotime($time)),
                    'availability'  => $availability
                ];
            }
            $timeSlot[] = [
                'time'          => date("g:i A", strtotime($time)),
                'availability'  => $availability
            ];
        }

        return response([
            'morning_time_slot'     => $morningTimeSlot,
            'afternoon_time_slot'   => $afternoonTimeSlot,
            'evening_time_slot'     => $eveningTimeSlot,
            'night_time_slot'       => $nightTimeSlot,
            'mid_night_time_slot'   => $midNightTimeSlot,
            //'time_slot'             => $timeSlot
        ], 200);
    }

}
