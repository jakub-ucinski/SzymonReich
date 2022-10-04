<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::with(['images', 'variations'])->orderBy('order')->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {

        $stock = null;
        $price = null;

        if (isset($request->stock)) {
            $stock = $request->validate([
                'stock' => ['integer']
            ])['stock'];
        }

        if (isset($request->price)) {
            $price = $request->validate([
                'price' => ['integer']
            ])['price'];
        }

        if (isset($request->shortDescription)) {
            $shortDescription = $request->validate([
                'shortDescription' => ['max:2500']
            ])['shortDescription'];
        }

        $data = $request->validate([
            'title' => ['required', 'max:255'],
            'text' => ['required', 'max:2500'],
            'images' => 'required',
            'limited' => ''
        ]);

        $product = Product::create([
            'title' => $data['title'],
            'description' => $data['text'],
            'shortDescription' => $shortDescription,
            'price' => $price,
            'stock' => $stock,
            'order' => count(Product::all()) + 1,
            'limited' => isset($data['limited']) ? true : false
        ]);


        if ($request->hasFile('images')) {

            $allowedfileExtension = ['jpg', 'png', 'webp', 'jpeg'];
            $images = $request->file('images');

            foreach ($images as $image) {

                $extension = $image->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);

                if (!$check) {
                    $product->delete();
                    return back()->with('imageresponse', 'Invalid file type, only jpeg, png, webp allowed');
                }

                $image_url = Storage::disk('public')->put('uploads', $image);

                $product->images()->create([
                    'image' => $image_url,
                    'order' => count(ProductImage::all()) + 1

                ]);
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
        $stock = null;
        $price = null;
        $shortDescription = null;

        if (isset($request->stock)) {
            $stock = $request->validate([
                'stock' => ['integer']
            ])['stock'];
        }

        if (isset($request->shortDescription)) {
            $shortDescription = $request->validate([
                'shortDescription' => ['max:2500']
            ])['shortDescription'];
        }

        if (isset($request->price)) {
            $price = $request->validate([
                'price' => ['integer']
            ])['price'];
        }

        $data = $request->validate([
            'title' => ['required', 'max:255'],
            'text' => ['required', 'max:2500'],
            'images' => '',
            'limited' => ''
        ]);

        $product->update([
            'title' => $data['title'],
            'description' => $data['text'],
            'shortDescription' => $shortDescription,
            'price' => $price,
            'stock' => $stock,
            'limited' => isset($data['limited']) ? true : false
        ]);


        if ($request->hasFile('images')) {

            $allowedfileExtension = ['jpg', 'png', 'webp', 'jpeg'];
            $images = $request->file('images');

            foreach ($images as $image) {

                $extension = $image->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);

                if (!$check) {
                    return redirect()->back()->with('imageresponse', 'Invalid file type, only jpeg, png, webp allowed');
                }

                $image_url = Storage::disk('public')->put('uploads', $image);
                $product->images()->create([
                    'image' => $image_url,
                    'order' => count(Product::all()) + 1,
                ]);
            }
        }


        return redirect()->route('products.index');
    }

    public function updateall(Request $request)
    {
        foreach ($request->products as $product) {
            $productImages = ProductImage::where('product_id', $product['id'])->get();

            Product::where('id', $product['id'])->delete();
            Product::create([
                'id' => $product['id'],
                'title' => $product['title'],
                'description' => $product['description'],
                'shortDescription' => $product['shortDescription'],
                'price' => $product['price'],
                'stock' => $product['stock'],
                'order' => $product['order'],
                'limited' => $product['limited'] == 1 ? true : false
            ]);


            foreach ($productImages as $productImage) {
                ProductImage::create([
                    'id' => $productImage['id'],
                    'product_id' => $productImage['product_id'],
                    'image' => $productImage['image'],
                    'order' => $productImage['order'],
                ]);
            }
        }
        return response('Update Successful', 200);
    }
}
