<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class SalonResource extends JsonResource
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
            'name'          => $this->name,
            'image'         => imageUrl($this->image),
            'phone_number'  => $this->phoneNumber,
            'city'          => $this->city,
            'address'       => $this->address,
            'latitude'      => $this->latitude,
            'longitude'     => $this->longitude,
            'availability_range'    => $this->availability_range,
            'description'   => $this->description,
            'gallery'       => [],
            'rate'          => 0.00,
            'reviews'       => [],
            'availability_hours'    => $this->getAvailabilityHours,
            'employees'     => [],
            'close'         => false,
            'distance'      => 0.00
        ];

        if(is_array($this->gallery)){
            foreach($this->gallery as $gallery){
                $data['gallery'][] = imageUrl($gallery);
            }
        }
        return $data;
    }
}
