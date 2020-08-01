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
        $productImages = ProductImage::where('product_id', '=', $request->productid)->orderBy('order')->get();
        // $product = $request->productid;
        
        return $productImages;
    }
    
    
    public function destroy(ProductImage $productimage)
    {
        $productimage->delete();
        return redirect()->back();
    }




    public function updateall(Request $request)
    {
        $flag=false;
        foreach ($request->productImages as $productImage) {
            if (!$flag) {
                ProductImage::where('product_id', $productImage['product_id'])->delete();
            }
            ProductImage::create([
                'id' => $productImage['id'],
                'product_id' => $productImage['product_id'],
                'image' => $productImage['image'],
                'order' => $productImage['order']
                ]);
                $flag=true;
        }
        return response('Update Successful', 200);
    }
}
