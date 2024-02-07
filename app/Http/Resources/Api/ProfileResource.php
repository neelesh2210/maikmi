<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray($request){
        $data = [
            'type'              => $this->type,
            'name'              => $this->name,
            'email'             => $this->email,
            'phone'             => $this->phone,
            'dob'               => optional($this->userDetail)->dob,
            'gender'            => optional($this->userDetail)->gender,
            'avatar'            => optional($this->userDetail)->photo?imageUrl(optional($this->userDetail)->photo):asset('frontend/images/no_user.png')
        ];

        return $data;
    }
}
