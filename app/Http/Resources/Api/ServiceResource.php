<?php

namespace App\Http\Resources\Api;

use App\Models\ServiceCategory;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\ServiceCategoryResource;

class ServiceResource extends JsonResource
{

    public function toArray($request){
        $data = [
            'id'=>$this->id,
            'name'=>$this->name,
            'price'=>$this->price,
            'discount_price'=>$this->discount_price,
            'image'=>$this->image?imageUrl($this->image):asset('admin_css/no-pictures.png'),
            'duration'=>$this->duration,
            'description'=>$this->description,
        ];

        $category_name = [];
        foreach ($this->service_category_ids as $service_category_id) {
            $category_name[] = new ServiceCategoryResource(ServiceCategory::where('id',$service_category_id)->first());
        }

        $data['category'] = $category_name;

        return $data;
    }
}
