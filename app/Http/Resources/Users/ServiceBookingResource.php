<?php

namespace App\Http\Resources\Users;

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
            'booking_at'    => $this->booking_at,
            'at_salon'      => $this->at_salon ? true : false,
            'status'        => $this->status,
            'total_amount'  => $this->total_amount,
        ];

        return $data;
    }
}
