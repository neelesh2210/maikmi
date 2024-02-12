<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceSearchResource extends JsonResource
{

    public function toArray($request){
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'type'=>$this->type,
            'image'=>$this->image?imageUrl($this->image):asset('admin_css/no-pictures.png'),
        ];
    }
}
