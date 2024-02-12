<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAddressResource extends JsonResource
{

    public function toArray($request){
        return [
            'id'=>$this->id,
            'country'=>$this->country,
            'state'=>$this->state,
            'city'=>$this->city,
            'pincode'=>$this->pincode,
            'first_address'=>$this->first_address,
            'second_address'=>$this->second_address,
            'name'=>$this->name,
            'phone'=>$this->phone,
            'type'=>$this->type,
            'is_default'=>$this->is_default,
        ];
    }
}
