<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductOrderResource extends JsonResource
{

    public function toArray($request){
        $data = [
            'order_id'=>$this->order_id,
            'salon_id'=>json_decode($this->salon)->id,
            'salon_name'=>json_decode($this->salon)->name,
            'salon_phone'=>json_decode($this->salon)->phone_number,
            'salon_image'=>json_decode($this->salon)->image?imageUrl(json_decode($this->salon)->image):asset('admin_css/no-pictures.png'),
            'products'=>null,
            'total_amount'=>$this->total_amount,
            'address'=>[
                'country'=>json_decode($this->address)->country,
                'state'=>json_decode($this->address)->state,
                'city'=>json_decode($this->address)->city,
                'pincode'=>json_decode($this->address)->pincode,
                'first_address'=>json_decode($this->address)->first_address,
                'second_address'=>json_decode($this->address)->second_address,
                'name'=>json_decode($this->address)->name,
                'phone'=>json_decode($this->address)->phone,
                'type'=>json_decode($this->address)->type,
            ],
            'payment_type'=>$this->payment_type,
            'payment_detail'=>$this->payment_detail,
            'date'=>$this->created_at->format('d-m-Y h:i A'),
        ];
        $products = [];
        foreach (json_decode($this->products) as $product) {
            $products[] = [
                'product_id'=>$product->id,
                'product_name'=>$product->name,
                'product_price'=>$product->price,
                'product_discount_price'=>$product->discount_price,
                'product_quantity'=>$product->quantity,
                'product_image'=>$product->image?imageUrl($product->image):asset('admin_css/no-pictures.png'),
                'product_order_status'=>$product->product_order_status,
            ];
        }
        $data['products'] = $products;

        return $data;
    }
}
