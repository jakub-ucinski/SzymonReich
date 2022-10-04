<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use Illuminate\Http\Request;
use App\ProductVariationCategory;
use App\Http\Controllers\Controller;

class ProductVariationCategoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        return $product->variation_categories();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $data = $request->validate([
            'title' => ['required', 'max:255'],
            'order' => 'integer'
        ]);

        $variation_category = $product->variation_categories()->create([
            'title' => $data['title'],
            'order' => $data['order']
        ]);
        return $variation_category;
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        ProductVariationCategory::findOrFail($id)->delete();
        return redirect()->back();
    }
    
    public function updateall(Request $request, Product $product)
    {   
        $product->variation_categories()->delete();
        foreach ($request->productvariationcategories as $productvariationcategory) {
            ProductVariationCategory::create([
                'id' => $productvariationcategory['id'],
                'product_id' => $productvariationcategory['product_id'],
                'title' => $productvariationcategory['title'],
                'order' => $productvariationcategory['order']
                ]);
        }
        return response('Update Successful', 200);
    }
}
