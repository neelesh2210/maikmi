<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceCouponResource extends JsonResource
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
            'code'          => $this->code,
            'discount_type' => $this->discount_type,
            'discount'      => $this->discount,
            'description'   => $this->description,
            'services_ids'  => $this->services_ids != null ? $this->services_ids : [],
            'salons_ids'    => $this->salons_ids != null ? $this->salons_ids : [],
            'categories_ids'=> $this->categories_ids != null ? $this->categories_ids : [],
            'start_at'      => $this->start_at,
            'end_at'        => $this->end_at
        ];
        return $data;
    }
}
