<?php

namespace App\Http\Controllers\Admin;

use App\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductImagesController extends Controller
{
    public function destroy(ProductImage $productimage)
    {
        $productimage->delete();
        return redirect()->back();
    }
}
