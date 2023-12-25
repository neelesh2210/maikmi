<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class SalonResource extends JsonResource
{

    public function toArray($request){
        $data = [
            'salon_id'=>$this->id,
            'salon_name'=>$this->name,
            'salon_image'=>$this->image?imageUrl($this->image):asset('admin_css/no-pictures.png'),
            'salon_city'=>$this->city,
            'salon_address'=>$this->address,
            'salon_rating'=>4.5,
            'is_vacant'=>null,
            'is_favorite'=>0,
        ];
        $have_worker = Worker::where('salon_id',$this->id)->first();
        if($have_worke){
            $free_worker = Worker::where('salon_id',$this->id)->where('is_free','1')->first();
            if($free_worker){
                $data['is_vacant'] = 1;
            }else{
                $data['is_vacant'] = 0;
            }
        }else{
            $data['is_vacant'] = 0;
        }

        return $data;
    }
}
