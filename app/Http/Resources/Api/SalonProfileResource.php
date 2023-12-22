<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class SalonProfileResource extends JsonResource
{

    public function toArray($request){
        return [
            'name'=>$this->getSalon->name,
            'image'=>$this->getSalon->image?imageUrl($this->getSalon->image):asset('admin_css/no-pictures.png'),
            'phone'=>$this->getSalon->phone_number,
            'city'=>$this->getSalon->city,
            'address'=>$this->getSalon->address,
            'latitude'=>$this->getSalon->latitude,
            'longitude'=>$this->getSalon->longitude,
        ];
    }
}
