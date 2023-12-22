<?php

namespace App\Http\Resources\Api;

use App\Models\Service;
use App\Http\Resources\Api\ServiceResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SalonDetailResource extends JsonResource
{

    public function toArray($request){
        $data = [
            'salon_id'=>$this->id,
            'salon_name'=>$this->name,
            'salon_image'=>$this->image?imageUrl($this->image):asset('admin_css/no-pictures.png'),
            'salon_address'=>$this->address,
            'salon_city'=>$this->city,
            'salon_latitude'=>$this->latitude,
            'salon_longitude'=>$this->longitude,
            'salon_rating'=>4.5,
            'is_vacant'=>1,
            'is_favorite'=>0,
        ];

        $data['services'] = ServiceResource::collection(Service::where('user_id',$this->user_id)->where('available',1)->get());

        return $data;
    }

}
