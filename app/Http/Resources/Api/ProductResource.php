<?php

namespace App\Http\Resources\Api;

use App\Models\ProductCategory;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\ProductCategoryResource;

class ProductResource extends JsonResource
{

    public function toArray($request){
        $data = [
            'id'=>$this->id,
            'name'=>$this->name,
            'price'=>$this->price,
            'discount_price'=>$this->discount_price,
            'image'=>$this->image?imageUrl($this->image):asset('admin_css/no-pictures.png'),
            'description'=>$this->description,
        ];

        $category_name = [];
        foreach ($this->product_category_ids as $product_category_id) {
            $category_name[] = new ProductCategoryResource(ProductCategory::where('id',$product_category_id)->first());
        }

        $data['category'] = $category_name;

        return $data;
    }
}
