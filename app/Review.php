<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'id',
        'name',
        'comment',
        'rating',
        'product_id'
    ];
    public function product() {
        return $this->belongsTo('App\Product');
    }
}
