<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'salon_user_id',
        'salon_id',
        'user_id',
        'product_id',
        'quantity',
    ];
}
