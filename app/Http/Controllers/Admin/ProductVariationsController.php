<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductVariationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $productId)
    {
        $data = $request->validate([
            'title' => ['required','max:255'],
            'price'=> ['required','integer'],
            'stock' => ['required', 'integer'],
            'options' => 'array',
            'options.*' => ['required','integer'],
            'order' => ['required','integer']

        ]);

        $product = Product::findOrFail($productId);

        $productVarition = $product->variations()->create([
            'title' => $data['title'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'order' => $data['order']
        ]);

        foreach ($data['options'] as $option) {
            DB::table('product_variation_product_variation_option')->insert([
                'product_variation_id' => $productVarition->id,
                'product_variation_option_id' => $option
            ]);
        }
        return $request->options; 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($productVariation)
    {
        $productVariation = ProductVariation::findOrFail($productVariation);
        return view('admin.products.variations.edit', compact('productVariation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $productVariation)
    {
        $data = $request->validate([
            'title' => ['required','max:255'],
            'price'=> ['required','integer'],
            'stock' => ['required', 'integer']
        ]);

        $productVariation = ProductVariation::findOrFail($productVariation);
        $productVariation->update([
            'title' => $data['title'],
            'price' => $data['price'],
            'stock' => $data['stock']
        ]);
        return redirect()->route('products.edit', $productVariation->product->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductVariation::findOrFail($id)->delete();
        return redirect()->back();
    }
}
