<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'salon_id',
        'booked_id',
        'salon',
        'products',
        'total_amount',
        'address',
        'payment_type',
        'payment_detail',
        'product_order_status',
        'product_detail_order_status',
        'remark',
    ];
}
