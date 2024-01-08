<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCategoryResource extends JsonResource
{

    public function toArray($request){
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'description'=>$this->description,
            'image'=>imageUrl($this->image),
        ];
    }
}
