<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray($request){
        $data = [
            'name'              => $this->name,
            'email'             => $this->email,
            'phone'             => $this->phone,
            'dob'               => optional($this->userDetail)->dob,
            'gender'            => optional($this->userDetail)->gender,
        ];

        return $data;
    }
}
