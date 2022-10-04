<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{

    public function landing()
    {
        $products = Product::with('images')->orderBy('order')->get();

        return view('shop.landing', compact('products'));
    }

    public function products()
    {
        $products = Product::with('images')->orderBy('order')->get();

        return view('shop.products', compact('products'));
    }
}
