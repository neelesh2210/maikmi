<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $fillabel = [
        'user_id',
        'salon_id',
        'name',
        'engage_time',
        'engage_duration',
        'is_free'
    ];
}
