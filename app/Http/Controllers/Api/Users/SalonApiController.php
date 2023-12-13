<?php

namespace App\Http\Controllers\Api\Users;

use Carbon\Carbon;
use App\Models\Salon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Models\AvailabilityHour;
use App\Http\Controllers\Controller;
use App\Http\Resources\Users\SalonResource;

class SalonApiController extends Controller
{
    public function salonDetail($id)
    {
        return response([
            'success'       => true,
            'salon_data'    => new SalonResource(Salon::with('getAvailabilityHours')->find($id))
        ], 200);
    }

    public function salonTimeSlot(Request $request)
    {
        $this->validate($request,[
            'salon_id'      => 'required',
            'date'          => 'required',

        ]);

        $date = Carbon::createFromFormat('Y-m-d', $request->date);
        $day = strtolower($date->format('l'));
        $periods = CarbonPeriod::since($date->subDay()->ceilDay())->minutes(30)->until($date->addDay()->ceilDay()->subMinutes(30));
        //$timeSlot = [];
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

            if($time >= "06:00" && $time < "12:00"){
                $morningTimeSlot[] = [
                    'time'          => $time,
                    'availability'  => $availability
                ];
            }

            if($time >= "12:00" && $time < "16:00"){
                $afternoonTimeSlot[] = [
                    'time'          => $time,
                    'availability'  => $availability
                ];
            }

            if($time >= "16:00" && $time < "20:00"){
                $eveningTimeSlot[] = [
                    'time'          => $time,
                    'availability'  => $availability
                ];
            }

            if($time >= "20:00" && $time < "23:59"){
                $nightTimeSlot[] = [
                    'time'          => $time,
                    'availability'  => $availability
                ];
            }

            if($time >= "00:00" && $time < "06:00"){
                $midNightTimeSlot[] = [
                    'time'          => $time,
                    'availability'  => $availability
                ];
            }
            $timeSlot[] = [
                'time'          => $time,
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
