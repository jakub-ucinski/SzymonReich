<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{

    public function index()
    {
        $products = Product::with('images')->orderBy('order')->get();

        return view('shop.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('shop.show', compact('product'));
    }
}
