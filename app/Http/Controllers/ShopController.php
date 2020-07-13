<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::all()->sortBy('order');

        return view('shop.index', compact('products'));
    }
}
