<?php

namespace App;

use App\Product;
use App\ProductVariationOption;
use Illuminate\Database\Eloquent\Model;

class ProductVariationCategory extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variation_options()
    {
        return $this->hasMany(ProductVariationOption::class)->orderBy('order');

    }

}
