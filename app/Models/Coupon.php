<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'salon_id',
        'slug',
        'code',
        'title',
        'image',
        'description',
        'coupon_type',
        'service_ids',
        'total_order_amount',
        'start_date',
        'end_date',
        'number_of_usages',
        'total_used',
        'is_active'
    ];
}
