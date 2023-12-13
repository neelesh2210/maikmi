<?php

namespace App\Http\Resources\Users\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
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
            'name'              => $this->name,
            'type'              => $this->type,
            'phone'             => $this->phone,
            'is_active'         => $this->is_active,
        ];
        return $data;
    }
}
