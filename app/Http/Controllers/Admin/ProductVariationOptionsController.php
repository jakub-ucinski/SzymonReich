<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\ProductVariationOption;
use App\ProductVariationCategory;
use App\Http\Controllers\Controller;

class ProductVariationOptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductVariationCategory $variationcategory)
    {
        $variation_options = $variationcategory->variation_options();
        return $variation_options;
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
    public function store(Request $request, $productvariationcategoryid)
    {
        $productvariationcategory=ProductVariationCategory::findOrFail($productvariationcategoryid);
        $data = $request->validate([
            'title' => ['required', 'max:255'],
            'order' => 'integer'
        ]);

        $variation_option = $productvariationcategory->variation_options()->create([
            'title' => $data['title'],
            'order' => $data['order']
        ]);
        return $variation_option;
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
        ProductVariationOption::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function updateall(Request $request, $id)
    {   
        ProductVariationCategory::findOrFail($id)->variation_options()->delete();
        foreach ($request->productvariationoptions as $productvariationoption) {
            ProductVariationOption::create([
                'id' => $productvariationoption['id'],
                'product_variation_category_id' => $productvariationoption['product_variation_category_id'],
                'title' => $productvariationoption['title'],
                'order' => $productvariationoption['order']
                ]);
        }
        return response('Update Successful', 200);
    }
}
