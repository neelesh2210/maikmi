<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceCoupon extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'services_ids'          => 'array',
        'salons_ids'            => 'array',
        'categories_ids'        => 'array',
    ];
}
