<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class AppSliderResource extends JsonResource
{

    public function toArray($request){
        return [
            'order'             =>  $this->order,
            'text'              =>  $this->text,
            'button'            =>  $this->button,
            'text_position'     =>  $this->text_position,
            'text_color'        =>  $this->text_color,
            'button_color'      =>  $this->button_color,
            'background_color'  =>  $this->background_color,
            'image_fit'         =>  $this->image_fit,
            'salon_id'          =>  $this->salon_id,
            'image'             =>  imageUrl($this->image),
        ];
    }
}
