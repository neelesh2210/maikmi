<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceSubCategoryResource extends JsonResource
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
            'color'         => $this->color,
            'description'   => $this->description,
        ];

        return $data;
    }
}
