<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
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
            'text'              => $this->text,
            'button'            => $this->button,
            'text_position'     => $this->text_position,
            'text_color'        => $this->text_color,
            'button_color'      => $this->button_color,
            'background_color'  => $this->background_color,
            'image_fit'         => $this->image_fit,
            'salon_id'          => $this->salon_id,
            'image'             => imageUrl($this->image)
        ];

        return $data;
    }
}
