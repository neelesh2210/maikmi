<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    use HasFactory;

    protected $casts = [
        'gallery'    => 'array',
    ];

    public function getOwner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getAvailabilityHours()
    {
        return $this->hasMany(AvailabilityHour::class, 'salon_id');
    }

    public function getServiceBooking()
    {
        return $this->hasMany(ServiceBooking::class, 'salon_id');
    }
}
