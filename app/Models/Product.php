<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'product_category_ids'          => 'array',
        'product_subcategory_ids'       => 'array',
    ];

    public function getProductCategory($product_category_ids)
    {
        $list = ProductCategory::whereIn('id', $product_category_ids)->get();
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
