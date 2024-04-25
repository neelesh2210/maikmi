<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class SalonProfileResource extends JsonResource
{

    public function toArray($request){
        $data = [
            'salon_unique_id'=>$this->getSalon->salon_unique_id,
            'name'=>$this->getSalon->name,
            'image'=>$this->getSalon->image?imageUrl($this->getSalon->image):asset('admin_css/no-pictures.png'),
            'phone'=>$this->getSalon->phone_number,
            'city'=>$this->getSalon->city,
            'address'=>$this->getSalon->address,
            'latitude'=>$this->getSalon->latitude,
            'longitude'=>$this->getSalon->longitude,
            'kyc_document'=>null,
            'kyc_status'=>$this->getSalon->kyc_status,
        ];
        if($this->getSalon->kyc_document){
            $kyc_docs = [];
            foreach (json_decode($this->getSalon->kyc_document) as $key => $kyc_document) {
                $image = imageUrl($kyc_document);
                $kyc_docs[] = [$key=>$image];
            }
            $mergedData = [];

            foreach ($kyc_docs as $kyc_doc) {
                $mergedData = array_merge($mergedData, $kyc_doc);
            }
        }else{
            $mergedData = null;
        }
        $data['kyc_document'] = $mergedData;

        return $data;
    }
}
