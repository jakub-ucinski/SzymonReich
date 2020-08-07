<?php

namespace App;

use App\Order;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    

    public function orders()
    {
        
        return $this->belongsToMany(Order::class);

    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('order');
    }
}
