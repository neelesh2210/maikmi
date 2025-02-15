<?php

namespace App\Http\Resources\Vendors;

use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
{

    public function toArray($request){
        // return parent::toArray($request);
        return [
            'id'                    =>  $this->id,
            'title'                 =>  $this->title,
            'price'                 =>  $this->price,
            'discounted_price'      =>  $this->discounted_price,
            'duration'              =>  $this->duration,
            'description'           =>  $this->description,
            'term_and_condition'    =>  $this->term_and_condition,
        ];
    }
}
