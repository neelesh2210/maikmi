<?php

namespace App\Http\Resources\Api;

use Auth;
use App\Models\ProductCart;
use App\Models\ProductCategory;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\ProductCategoryResource;

class ProductResource extends JsonResource
{

    public function toArray($request){
        $data = [
            'id'                                =>  $this->id,
            'name'                              =>  $this->name,
            'price'                             =>  $this->price,
            'discount_price'                    =>  $this->discount_price,
            'image'                             =>  $this->image?imageUrl($this->image):asset('admin_css/no-pictures.png'),
            'description'                       =>  $this->description,
            'in_cart'                           =>  0,
            'cart_product_quantity'             =>  0
        ];

        $category_name = [];
        foreach ($this->product_category_ids as $product_category_id) {
            $category_name[] = new ProductCategoryResource(ProductCategory::where('id',$product_category_id)->first());
        }

        $data['category'] = $category_name;

        $cart = ProductCart::where('user_id',Auth::user()->id)->where('product_id',$this->id)->first();
        if($cart){
            $data['in_cart'] = 1;
            $data['cart_product_quantity'] = $cart->quantity;
        }

        return $data;
    }
}
