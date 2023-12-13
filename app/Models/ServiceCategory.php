<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceCategory extends Model
{
    use HasFactory, SoftDeletes;

    public function getFeaturedSubCategory()
    {
        return $this->hasMany(ServiceSubCategory::class, 'service_category_id')->where('featured', 1)->where('status', 1);
    }

    public function getSubCategory()
    {
        return $this->hasMany(ServiceSubCategory::class, 'service_category_id')->where('status', 1);
    }

}
