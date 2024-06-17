<?php

namespace App\Http\Resources\Vendors;

use Illuminate\Http\Resources\Json\JsonResource;

class PlanPurchaseResource extends JsonResource
{

    public function toArray($request){
        // return parent::toArray($request);
        return [
            'order_id'          =>  $this->order_id,
            'payment_id'        =>  $this->payment_id,
            'plan_id'           =>  json_decode($this->plan_detail)->id,
            'plan_title'        =>  json_decode($this->plan_detail)->title,
            'plan_duration'     =>  json_decode($this->plan_detail)->duration,
            'amount'            =>  $this->amount,
            'plan_status'       =>  $this->plan_status,
        ];
    }
}
