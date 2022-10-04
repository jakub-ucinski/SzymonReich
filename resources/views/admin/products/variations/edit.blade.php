@extends('layouts.admin.app')

@section('content')
    <div for='pages-products' class="cms-page">
        <h1>{{ $productVariation->title }}</h1>
        <a type="button" href="{{ route('products.edit', $productVariation->product->id) }}" class="button mr-2">
            <i class="fas fa-arrow-left"></i>
        </a>


        <form method="POST" action="/admin/variation/{{ $productVariation->id }}">
            @method('PATCH')

            @csrf

            <div class="form-group w-50">
                <label for="title" class="col-form-label">Title</label>

                <input id="title" value="{{ $productVariation->title }}" type="text"
                    class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}"
                    required autocomplete="title" autofocus>

                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group w-50">
                <label for="price" class="col-form-label">Price</label>

                <input id="price" type="text" value="{{ $productVariation->price }}"
                    class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}"
                    autocomplete="price" autofocus>

                @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            {{-- @endif --}}


            <div class="form-group w-50">
                <label for="stock" class="col-form-label">Stock</label>

                <input id="stock" type="number" value="{{ $productVariation->stock }}"
                    class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock') }}"
                    autocomplete="stock" autofocus>

                @error('stock')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </div>
        </form>
    </div>
@endsection
