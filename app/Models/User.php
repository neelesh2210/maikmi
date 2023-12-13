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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'assigned_id'       => 'array',
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
