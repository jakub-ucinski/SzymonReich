<?php

namespace App;

use App\CartProduct;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function cart_products()
    {
        return $this->hasMany(CartProduct::class);
    }

}
