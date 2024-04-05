<?php

namespace App\Http\Resources\Api;

use App\Models\Worker;
use App\Models\SalonRating;
use Illuminate\Http\Resources\Json\JsonResource;

class SalonResource extends JsonResource
{

    public function toArray($request){
        $data = [
            'salon_id'=>$this['id'],
            'salon_name'=>$this['name'],
            'salon_image'=>$this['image']?imageUrl($this['image']):asset('admin_css/no-pictures.png'),
            'salon_city'=>$this['city'],
            'salon_address'=>$this['address'],
            'salon_distance'=>$this['distance'],
            'salon_rating'=>null,
            'is_vacant'=>null,
            'is_favorite'=>0,
        ];
        $have_worker = Worker::where('salon_id',$this['id'])->first();
        if($have_worker){
            $free_worker = Worker::where('salon_id',$this['id'])->where('is_free','1')->first();
            if($free_worker){
                $data['is_vacant'] = 1;
            }else{
                $data['is_vacant'] = 0;
            }
        }else{
            $data['is_vacant'] = 0;
        }

        $total_rating = SalonRating::where('salon_id',$this['id'])->sum('rating');
        $total_rating_user = SalonRating::where('salon_id',$this['id'])->count();

        if($total_rating_user == 0){
            $data['salon_rating'] = 0;
        }else{
            $data['salon_rating'] = $total_rating/$total_rating_user;
        }

        return $data;
    }
}
