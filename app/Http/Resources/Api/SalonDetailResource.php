<?php

namespace App\Http\Resources\Api;

use App\Models\Worker;
use App\Models\Product;
use App\Models\Service;
use App\Http\Resources\Api\ProductResource;
use App\Http\Resources\Api\ServiceResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SalonDetailResource extends JsonResource
{

    public function toArray($request){
        $data = [
            'salon_id'=>$this->id,
            'salon_name'=>$this->name,
            'salon_phone_number'=>$this->phone_number,
            'salon_image'=>$this->image?imageUrl($this->image):asset('admin_css/no-pictures.png'),
            'salon_address'=>$this->address,
            'salon_city'=>$this->city,
            'salon_latitude'=>$this->latitude,
            'salon_longitude'=>$this->longitude,
            'salon_rating'=>4.5,
            'is_vacant'=>null,
            'is_favorite'=>0,
            'home_service_charge'=>$this->home_service_charge,
            'home_service_status'=>$this->home_service_status,
            'partial_payment_percent'=>$this->partial_payment_percent
        ];

        $data['services'] = ServiceResource::collection(Service::where('user_id',$this->user_id)->where('available',1)->get());
        $data['products'] = ProductResource::collection(Product::where('user_id',$this->user_id)->where('available',1)->get());

        $have_worker = Worker::where('salon_id',$this->id)->first();
        if($have_worker){
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
