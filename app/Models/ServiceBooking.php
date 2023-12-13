<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceBooking extends Model
{
    use HasFactory;

    protected $casts = [
        'salon'         => 'array',
        'service'       => 'array',
        'coupon'        => 'array',
        'address'       => 'array'
    ];

    public function getSalon()
    {
        return $this->belongsTo(Salon::class, 'salon_id');
    }

    public function getBookedBy()
    {
        return $this->belongsTo(User::class, 'booked_by');
    }
}
