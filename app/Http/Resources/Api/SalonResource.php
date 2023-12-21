<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class SalonResource extends JsonResource
{

    public function toArray($request){
        return [
            'salon_id'=>$this->id,
            'salon_name'=>$this->name,
            'salon_image'=>$this->image?imageUrl($this->image):asset('admin_css/no-pictures.png'),
            'salon_rating'=>4.5,
            'is_vacant'=>1,
            'is_favorite'=>0,
        ];
    }
}
