<?php

namespace App\Http\Resources\Users;

use App\Models\Service;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceCategoryResource extends JsonResource
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
            'sub_category'  => ServiceSubCategoryResource::collection($this->getSubCategory),
            'services'      => ServiceResource::collection(Service::whereJsonContains('service_category_ids', ''.$this->id)->where('available', 1)->where('is_ban', 0)->with('getSalon')->inRandomOrder()->limit(10)->get())
        ];

        return $data;
    }
}
