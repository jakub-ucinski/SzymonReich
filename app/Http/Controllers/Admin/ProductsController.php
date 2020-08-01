<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::with('images')->orderBy('order')->get();
        
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {   
        $data = $request->validate([
            'title' => ['required','max:255'],
            'description' => ['required','max:2500'],
            'price' => ['regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/', 'required', 'max:10'],
            'images' => 'required',
            'stock' => ['required', 'integer'],
            'limited' => ''
        ]);

        //dd();

        $product = Product::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'order' => count(Product::all())+1,
            'limited' => isset($data['limited']) ? true : false
            ]);
        

        if($request->hasFile('images')){
        
            $allowedfileExtension=['jpg','png', 'webp'];
            $images = $request->file('images');
            $flag=false;
            foreach($images as $image){

                $filename = $image->getClientOriginalName();
                $extension = $image->getClientOriginalExtension();
                $check=in_array($extension, $allowedfileExtension);
                if($check)
                {
                    $image_url = $image->store('uploads', 'public');
                    $product->images()->create([
                        'image' => $image_url,
                        'order' => count(ProductImage::all())+1

                    ]);
                
                }else{
                    $flag = true;
                }
            
            }

            if ($flag){
                $product->delete();
                return back()->with('imageresponse', 'Invalid file type, only jpeg, png, webp allowed');
            }
        }
        return redirect()->route('products.index');
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Product $product, Request $request)
    {

        $data = $request->validate([
            'title' => ['required','max:255'],
            'description' => ['required','max:2500'],
            'price'=> ['regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/', 'max:10'],
            'images'=> '',
            'stock' => ['required', 'integer'],
            'limited' => ''
        ]);

        $product->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'limited' => isset($data['limited']) ? true : false
            ]);


        if($request->hasFile('images')){
        
            $allowedfileExtension=['jpg','png', 'webp'];
            $images = $request->file('images');
            $flag=false;
            foreach($images as $image){

                $filename = $image->getClientOriginalName();
                $extension = $image->getClientOriginalExtension();
                $check=in_array($extension, $allowedfileExtension);
                if($check)
                {
                    $image_url = $image->store('uploads', 'public');
                    // dd(count(ProductImage::all())+1);
                    $product->images()->create([
                        'image' => $image_url,
                        'order' => count(Product::all())+1,
                    ]);
                
                }else{
                    $flag = true;
                }
            
            }

            if ($flag){
                return redirect()->back()->with('imageresponse', 'Invalid file type, only jpeg, png, webp allowed');
            }
        }

        
        return redirect()->route('products.index');
    }



    public function updateall(Request $request)
    {
        
        //Product::truncate();
        // $productImages=ProductImage::get();

        foreach ($request->products as $product) {
            $productImages=ProductImage::where('product_id', $product['id'])->get();

            // dd($product::with('images')->get());
            Product::where('id', $product['id'])->delete();
            Product::create([
                'id' => $product['id'],
                'title' => $product['title'],
                'description' => $product['description'],
                'price' => $product['price'],
                'stock' => $product['stock'],
                'order' => $product['order'],
                'limited' => isset($product['limited']) ? true : false
                ]);

            
            foreach ($productImages as $productImage) {
                $productImage::create([
                    'id' => $productImage['id'],
                    'product_id' => $productImage['product_id'],
                    'image' => $productImage['image'],
                    'order' => $productImage['order'],
                ]);
            }

        }
        return response('Update Successful', 200)->with($product::with('images')->get());
    }


}