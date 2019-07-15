<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id',
        'product_name',
        'sku',
        'status',
        'base_price',
        'special_price',
        'description',
        'by',
        'type',
        'cover_image'

    ];
    public function reviews() {
        return $this->hasMany('App\Review');
    }
}
