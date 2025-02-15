<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanPurchaseHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plan_id',
        'order_id',
        'payment_id',
        'payment_signature',
        'plan_detail',
        'duration',
        'amount',
        'payment_status',
        'plan_status',
        'plan_expired_time',
        'plan_activated_time'
    ];
}
