<?php

namespace App\Http\Resources\Vendors;

use Illuminate\Http\Resources\Json\JsonResource;

class WithdrawalResource extends JsonResource
{

    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'amount'    => $this->amount,
            'status'     => $this->status,
            'date'      => $this->created_at->format('d M Y h:i A'),
        ];
    }
}
