<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCoupon extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'products_ids'          => 'array',
        'salons_ids'            => 'array',
        'categories_ids'        => 'array',
    ];
}
