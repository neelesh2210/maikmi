<?php

namespace App\Models\Admin;

use App\Models\ServiceCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceCatelog extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'image',
        'description'
    ];

    public function category(){
        return $this->belongsTo(ServiceCategory::class,);
    }

}
