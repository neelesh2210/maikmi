<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'service_category_ids'          => 'array',
        'service_subcategory_ids'       => 'array',
        'addon_services'                => 'array',
    ];

    public function getServiceCategory($service_category_ids)
    {
        $list = ServiceCategory::whereIn('id', $service_category_ids)->get();
        $name = '';
        foreach ($list as $data){
            $name  = $data->name.', '.$name;
        }

        return $name;
    }

    public function getSalon()
    {
        return $this->belongsTo(Salon::class, 'salon_id');
    }

}
