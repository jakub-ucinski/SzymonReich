<?php

namespace App;

use App\ProductImage;
use App\ProductVariation;
use App\ProductVariationCategory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('order');
    }

    public function variation_categories()
    {
        return $this->hasMany(ProductVariationCategory::class)->orderBy('order');
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class)->orderBy('order');
    }
    public function recommendations()
    {
        return $this->hasMany(Recommendation::class);
    }

}
