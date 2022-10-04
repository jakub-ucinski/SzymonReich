<?php

namespace App;

use App\ProductVariation;
use App\VariationCategory;
use App\ProductVariationCategory;
use Illuminate\Database\Eloquent\Model;

class ProductVariationOption extends Model
{
    protected $guarded = [];

    public function variation_category()
    {
        return $this->belongsTo(ProductVariationCategory::class);

    }
    public function variations()
    {
        return $this->belongsToMany(ProductVariation::class);

    }
}
