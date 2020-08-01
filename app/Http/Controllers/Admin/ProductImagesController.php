<?php

namespace App\Http\Controllers\Admin;

use App\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductImagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $productimages = ProductImage::where('product_id', '=', $request->productid)->orderBy('order')->get();
        // $product = $request->productid;
        dd($productimages);
        
        return $productimages;
    }
    
    
    public function destroy(ProductImage $productimage)
    {
        $productimage->delete();
        return redirect()->back();
    }




    public function updateall(Request $request)
    {
        $flag=false;
        //dd($request->productimages);
        foreach ($request->productimages as $productimage) {
            if (!$flag) {
                ProductImage::where('product_id', $productimage['product_id'])->delete();
            }
            ProductImage::create([
                'id' => $productimage['id'],
                'product_id' => $productimage['product_id'],
                'image' => $productimage['image'],
                'order' => $productimage['order']
                ]);
                $flag=true;
        }
        return response('Update Successful', 200);
    }
}
