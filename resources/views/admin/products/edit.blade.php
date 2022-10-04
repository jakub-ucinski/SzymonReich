@extends('layouts.admin.app')

@section('content')
    <div for='pages-products' class="cms-page">
        <h1>{{ $product->title }}</h1>
        <a type="button" href="{{ route('products.index') }}" class="button mr-2">
            <i class="fas fa-arrow-left"></i>
        </a>

        <form method="POST" enctype="multipart/form-data" action="{{ route('products.update', $product->id) }}">
            @method('PATCH')

            @csrf

            <div class="form-group w-50">
                <label for="title" class="col-form-label">Title</label>

                <input id="title" value="{{ $product->title }}" type="text"
                    class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}"
                    required autocomplete="title" autofocus>

                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <input id="text" type="hidden" name="text" value="{{ $product->description }}">

            <div class="form-group w-50">
                <label for="text" class="col-form-label">Description</label>

                <text-editor-tip-tap></text-editor-tip-tap>

                @error('text')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group w-50">
                <label for="shortDescription" class="col-form-label">Short Description</label>

                <textarea id="shortDescription" type="text" class="form-control @error('shortDescription') is-invalid @enderror"
                    name="shortDescription" autocomplete="shortDescription" rows="6" autofocus>
                                    {{ $product->shortDescription }}
                                </textarea>
                @error('shortDescription')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group w-50">
                <label for="images" class="col-form-label">Images</label>

                <input id="images" type="file" class="@error('images') is-invalid @enderror form-control-file"
                    name="images[]" value="{{ old('images') }}" autocomplete="images" autofocus multiple>

                @error('images')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                @if (session('imageresponse'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ session('imageresponse') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group w-50">
                <label for="price" class="col-form-label">Price</label>

                <input id="price" type="text" value="{{ $product->price }}"
                    class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}"
                    autocomplete="price" autofocus>

                @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            @if (count($product->variations) == 0)
                <div class="form-group w-50">
                    <label for="stock" class="col-form-label">Stock</label>

                    <input id="stock" type="number" value="{{ $product->stock }}"
                        class="form-control @error('stock') is-invalid @enderror" name="stock"
                        value="{{ old('stock') }}" autocomplete="stock" autofocus>

                    @error('stock')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            @endif

            <div class="form-group w-50">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="limited" value="1" name="limited" {{  $product->limited == 1 ? ' checked' : '' }}>
                    <label class="form-check-label" for="limited">Limited?</label>
                </div>
            </div>

            <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </div>
        </form>

        <product-images-draggable :product='{{ $product }}' :productimages='{{ $product->images }}'>
        </product-images-draggable>

        <products-variation-categories-draggable :product='{{ $product }}'
            :productvariationcategories='{{ $product->variation_categories }}'></products-variation-categories-draggable>



        <h2 class="mt-5">Product Variant Options</h2>

        @foreach ($product->variation_categories as $variation_category)
            <products-variation-options-draggable :product='{{ $product }}'
                :productvariationcategory='{{ $variation_category }}'
                :productvariationoptions='{{ $variation_category->variation_options }}'>
            </products-variation-options-draggable>
        @endforeach


        @php $optionArray =[] @endphp
        @foreach ($product->variations as $variation)
            @php array_push($optionArray, $variation->variation_options) @endphp
        @endforeach

        <products-variations-draggable :product='{{ $product }}'
            :productvariationcategories='{{ $product->variation_categories }}'
            :productvariations='{{ $product->variations }}' :productvariationoptions="{{ json_encode($optionArray) }}">
        </products-variations-draggable>


        <recommendations :product='{{ $product }}' :productrecommendations='{{ $product->recommendations }}'>
        </recommendations>
    </div>
@endsection
