<?php

namespace App\Models;

use App\Models\Backend\Customer;
use Laravel\Sanctum\HasApiTokens;
use App\Models\WalletHistory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'type',
        'name',
        'email',
        'phone',
        'password',
        'phone_verified_at',
        'email_verified_at',
        'is_active',
        'token_from',
        'fcm_token',
    ];

    protected $hidden = [
        'password',
        'token_from',
        'fcm_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
    ];

    public function userDetail(){
        return $this->hasOne(UserDetail::class);
    }

    public function walletHistory(){
        return $this->hasMany(WalletHistory::class, 'user_id')->orderBy('id', 'desc');
    }

    public function getSalon()
    {
        return $this->hasOne(Salon::class);
    }

    public function getDefaultAddress()
    {
        return $this->hasOne(UserAddress::class, 'user_id')->where('is_default', 1);
    }
}
