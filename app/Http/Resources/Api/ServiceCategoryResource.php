<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceCategoryResource extends JsonResource
{

    public function toArray($request){
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'color'=>$this->color,
            'description'=>$this->description,
            'image'=>imageUrl($this->image),
        ];
    }
}
