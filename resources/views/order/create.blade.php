@extends('layouts.shop.app')

@section('content')
{{-- <div class="hero-background"></div> --}}
<form method="POST" enctype="form-data" action="{{ route('order.store') }}">
    @csrf

    <div class="form-group w-50">
        <label for="name" class="col-form-label">Name</label>

            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    </div>


    <div class="form-group w-50">
        <label for="surname" class="col-form-label">Surname</label>

            <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>
            @error('surname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    </div>

    <div class="form-group w-50">
        <label for="email" class="col-form-label">Email</label>

            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    </div>
    
    <hr>
    
    <div class="form-group w-50">
        <label for="road" class="col-form-label">Ulica</label>

            <input id="road" type="text" class="form-control @error('road') is-invalid @enderror" name="road" value="{{ old('road') }}" required autocomplete="road" autofocus>
            @error('road')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    </div>

    <div class="form-group w-50">
        <label for="houseno" class="col-form-label">Numer Domu</label>

            <input id="houseno" type="text" class="form-control @error('houseno') is-invalid @enderror" name="houseno" value="{{ old('houseno') }}" required autocomplete="houseno" autofocus>
            @error('houseno')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    </div>
    <div class="form-group w-50">
        <label for="flatno" class="col-form-label">Numer Mieszkania</label>

            <input id="flatno" type="text" class="form-control @error('flatno') is-invalid @enderror" name="flatno" value="{{ old('flatno') }}" required autocomplete="flatno" autofocus>
            @error('flatno')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    </div>

    <div class="form-group w-50">
        <label for="postcode" class="col-form-label">Kod Pocztowy</label>

            <input id="postcode" type="text" class="form-control @error('postcode') is-invalid @enderror" name="postcode" value="{{ old('postcode') }}" required autocomplete="postcode" autofocus>
            @error('postcode')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    </div>

    <div class="form-group w-50">
        <label for="city" class="col-form-label">Miejscowość</label>

            <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city" autofocus>
            @error('city')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    </div>


    <div class="form-group w-50">
        <label for="country" class="col-form-label">Kraj</label>

            <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}" required autocomplete="country" autofocus>
            @error('country')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    </div>











{{-- 
    <div class="form-group w-50">
        <label for="product" class="col-form-label">Product</label>

            <input id="product" type="text" class="form-control @error('product') is-invalid @enderror" name="product" value="{{ old('product') }}" required autocomplete="product" autofocus>
            @error('product')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    </div> --}}

    {{-- <div class="form-group w-50">
        <label for="price" class="col-form-label">Price</label>

            <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>

            @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    </div> --}}

    {{-- <div class="form-group w-50">
        <label for="images" class="col-form-label">Images</label>

            <input id="images" type="file" class="@error('images') is-invalid @enderror form-control-file" name="images[]" value="{{ old('images') }}" required autocomplete="images" autofocus multiple>

            @error('images')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            
            @if(session('imageresponse'))
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ session('imageresponse') }}</strong>
            </span>
            @endif
    </div> --}}

    {{-- <div class="form-group w-50">
        <label for="stock" class="col-form-label">Stock</label>

            <input id="stock" type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock') }}" required autocomplete="stock" autofocus>

            @error('stock')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    </div> --}}

    {{-- <div class="form-group w-50">

        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="limited" value="1" name="limited">
            <label class="form-check-label" for="limited">Limited?</label>
        </div>
    </div> --}}
    <div class="form-group mb-0">
            <button type="submit" class="btn btn-primary">
                Submit
            </button>
    </div>
</form>
@endsection