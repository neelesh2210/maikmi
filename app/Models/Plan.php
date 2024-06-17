<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'title',
        'price',
        'discounted_price',
        'duration',
        'description',
        'term_and_condition',
        'is_active'
    ];
}
