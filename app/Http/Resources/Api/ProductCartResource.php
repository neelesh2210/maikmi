<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCartResource extends JsonResource
{

    public function toArray($request){
        return [
            'product_id'                => $this->product->id,
            'product_name'              => $this->product->name,
            'product_price'             => $this->product->price,
            'product_discount_price'    => $this->product->discount_price,
            'product_image'             => $this->product->image?imageUrl($this->product->image):asset('admin_css/no-pictures.png'),
            'quantity'                  => $this->quantity,
            'salon_id'                  => $this->salon->id,
            'salon_name'                => $this->salon->name,
            'salon_phone'               => $this->salon->phone_number,
            'salon_image'               => $this->salon->image?imageUrl($this->salon->image):asset('admin_css/no-pictures.png'),
        ];
    }
}
