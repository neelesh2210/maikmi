<?php

namespace App\Models;

use App\Models\Backend\Block;
use App\Models\Backend\State;
use App\Models\Backend\Country;
use App\Models\Backend\Village;
use App\Models\Backend\District;
use App\Models\Backend\GramPanchayat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserDetail extends Model
{
    use HasFactory, SoftDeletes;
}
