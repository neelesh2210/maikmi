<?php

namespace App\Http\Resources\Vendors;

use App\Models\Service;
use App\Http\Resources\Api\ServiceResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
{

    public function toArray($request){
        // return parent::toArray($request);
        return [
            'slug'                  =>  $this->slug,
            'code'                  =>  $this->code,
            'title'                 =>  $this->title,
            'image'                 =>  $this->image ? imageUrl($this->image) : asset('admin_css/no-pictures.png'),
            'amount_type'           =>  $this->amount_type,
            'amount'                =>  $this->amount,
            'description'           =>  $this->description,
            'coupon_type'           =>  $this->coupon_type,
            'service_ids'           =>  ServiceResource::collection(Service::whereIn('id',json_decode($this->service_ids)??[])->get()),
            'total_order_amount'    =>  $this->total_order_amount,
            'start_date'            =>  $this->start_date,
            'end_date'              =>  $this->end_date,
            'number_of_usages'      =>  $this->number_of_usages,
            'total_used'            =>  $this->total_used,
            'is_active'             =>  $this->is_active,
        ];
    }
}
