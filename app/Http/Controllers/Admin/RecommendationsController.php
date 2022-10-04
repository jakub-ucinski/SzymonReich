<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Recommendation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class RecommendationsController extends Controller
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
    public function store(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => ['required', 'max:255'],
            'image' => 'required',
            'description' => ['required','max:2500']
        ]);

        $allowedfileExtension=['jpg','png', 'webp'];
        $image = $request->file('image');
        
        $filename = $image->getClientOriginalName();
        $extension = $image->getClientOriginalExtension();
        $check=in_array($extension, $allowedfileExtension);
        if($check)
        {
            $image_url = Storage::disk('public')->put('uploads', $image);
            $recommendation = $product->recommendations()->create([
                'name' => $data['name'],
                'image' => $image_url,
                'description' => $data['description']
            ]);
            return $recommendation;

        }
        
        return back()->with('imageresponse', 'Invalid file type, only jpeg, png, webp allowed');

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
        Recommendation::findOrFail($id)->delete();
        return redirect()->back();
    }
}
