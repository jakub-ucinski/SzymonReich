<?php

namespace App;

use App\Product;
use App\VariationOption;
use App\ProductVariationOption;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    protected $guarded = [];

    public function variation_options()
    {
        
        return $this->belongsToMany(ProductVariationOption::class);

    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
