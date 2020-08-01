<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $guarded = [];

    public function getURL()
    {
        return '/storage/' . $this->image;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
