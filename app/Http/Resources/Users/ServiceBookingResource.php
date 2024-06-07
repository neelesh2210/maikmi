<?php

namespace App\Http\Resources\Users;

use Auth;
use Carbon\Carbon;
use App\Models\SalonRating;
use App\Http\Controllers\Api\SlotController;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceBookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        $data = [
            'id'            => $this->id,
            'booking_id'    => $this->booking_id,
            'salon'         => $this->salon,
            'service'       => $this->service,
            'coupon'        => $this->coupon,
            'address'       => $this->address,
            'payment_type'  => $this->payment_type,
            'booking_date'  => $this->booking_date,
            'booking_time'  => $this->booking_time,
            'booking_day'   => date('D',strtotime($this->booking_date)),
            'booking_at'    => $this->booking_at,
            'at_salon'      => $this->at_salon ? true : false,
            'status'        => $this->status,
            'total_amount'  => $this->total_amount,
            'invoice'       => route('api.service.invoice',[$this->booking_id,encrypt(Auth::user()->id)]),
        ];

        $data['booked_by'] = ['name'=>$this->getBookedBy->name,'phone'=>$this->getBookedBy->phone];

        $data['review'] = SalonRating::where('user_id',Auth::user()->id)->where('salon_id',$this->salon)->first(['rating','comment']);


        $available_slots = [];
        if($this->status == 'pending' || $this->status == 'waiting'){
            $request->request->add(['salon_id'=>$this->salon['id'],'date'=>$this->booking_date]);

            $slots = new SlotController;

            $morning_time_slots = $slots->timeSlot($request)->original['morning_time_slot'];
            $afternoon_time_slots = $slots->timeSlot($request)->original['afternoon_time_slot'];
            $evening_time_slots = $slots->timeSlot($request)->original['evening_time_slot'];
            $night_time_slots = $slots->timeSlot($request)->original['night_time_slot'];

            foreach ($morning_time_slots as $morning_time_slot) {
                if(count($available_slots) < 4){
                    if(Carbon::parse($this->booking_time)->format('H:i') <= Carbon::parse($morning_time_slot['time'])->format('H:i') && $morning_time_slot['availability'] == true){
                        $available_slots[] = $morning_time_slot['time'];
                    }
                }
            }
            foreach ($afternoon_time_slots as $afternoon_time_slot) {
                if(count($available_slots) < 4){
                    if(Carbon::parse($this->booking_time)->format('H:i') <= Carbon::parse($afternoon_time_slot['time'])->format('H:i') && $afternoon_time_slot['availability'] == true){
                        $available_slots[] = $afternoon_time_slot['time'];
                    }
                }
            }
            foreach ($evening_time_slots as $evening_time_slot) {
                if(count($available_slots) < 4){
                    if(Carbon::parse($this->booking_time)->format('H:i') <= Carbon::parse($evening_time_slot['time'])->format('H:i') && $evening_time_slot['availability'] == true){
                        $available_slots[] = $evening_time_slot['time'];
                    }
                }
            }
            foreach ($night_time_slots as $night_time_slot) {
                if(count($available_slots) < 4){
                    if(Carbon::parse($this->booking_time)->format('H:i') <= Carbon::parse($night_time_slot['time'])->format('H:i') && $night_time_slot['availability'] == true){
                        $available_slots[] = $night_time_slot['time'];
                    }
                }
            }
        }

        $data['slots'] = $available_slots;

        return $data;
    }
}
