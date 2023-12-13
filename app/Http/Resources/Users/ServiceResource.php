<?php

namespace App\Http\Resources\Users;

use App\Models\ServiceCategory;
use App\Models\ServiceSubCategory;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        $data = [
            'id'                => $this->id,
            'name'              => $this->name,
            'price'             => $this->price,
            'discount_price'    => $this->discount_price,
            'duration'          => $this->duration,
            'image'             => imageUrl($this->image),
            'description'       => $this->description,
            'featured'          => $this->featured,
            'enable_booking'    => $this->enable_booking,
            'enable_at_salon'   => $this->enable_at_salon,
            'enable_at_customer_address'    =>  $this->enable_at_customer_address,
            'available'         =>  $this->available,
            'category'          => [],
            'subcategory'       => [],
            'salon'             => new SalonResource($this->getSalon)
        ];
        $categoryArr = [];
        foreach($this->service_category_ids as $category){
            $categoryData = ServiceCategory::find($category);
            $categoryArr['id'] = $categoryData->id;
            $categoryArr['name'] = $categoryData->name;
            $categoryArr['color'] = $categoryData->color;
            $data['category'][] = $categoryArr;
        }
        $subCategoryArr = [];
        foreach($this->service_subcategory_ids as $subcategory){
            $subcategoryData = ServiceSubCategory::find($subcategory);
            $subCategoryArr['id'] = $subcategoryData->id;
            $subCategoryArr['name'] = $subcategoryData->name;
            $subCategoryArr['color'] = $subcategoryData->color;
            $data['subcategory'][] = $subCategoryArr;
        }

        return $data;
    }
}
