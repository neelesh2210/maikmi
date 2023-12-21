<?php

namespace App\Http\Resources\Vendors;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{

    public function toArray($request){
        $data = [
            'id'            => $this->id,
            'type'          => $this->type,
            'owner_name'    => $this->name,
            'phone'         => $this->phone,
            'salon_name'    => $this->getSalon->name,
            'phone_number'  => $this->getSalon->phone_number,
            'latitude'      => $this->getSalon->latitude,
            'longitude'     => $this->getSalon->longitude,
            'city'          => $this->getSalon->city,
            'address'       => $this->getSalon->address,
            'availability_range'    => $this->getSalon->availability_range,
            'description'   => $this->getSalon->description,
            'image'         => $this->getSalon->image ? imageUrl($this->getSalon->image) : asset('admin_css/no-pictures.png')
        ];

        return $data;
    }
}
