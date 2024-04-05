<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class SalonRatingResource extends JsonResource
{

    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'user'=>['name'=>$this->user->name,'photo'=>optional(optional($this->user)->userDetail)->photo ? imageUrl(optional(optional($this->user)->userDetail)->photo) : asset('admin_css/no-pictures.png')],
            'rating'=>$this->rating,
            'comment'=>$this->comment,
        ];
    }
}
