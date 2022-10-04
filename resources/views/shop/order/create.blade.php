@extends('layouts.shop.app')

@section('content')
<div class="order-form-section container">
    <form method="POST" enctype="form-data" action="{{ route('order.store') }}">
        @csrf

        <div class="form-group">
            <label for="name" class="col-form-label">Imię*</label>
    
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>
    
    
        <div class="form-group">
            <label for="surname" class="col-form-label">Surname*</label>
    
                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>
                @error('surname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>
    
        <div class="form-group">
            <label for="email" class="col-form-label">Email*</label>
    
                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>

        <div class="form-group">
            <label for="phone" class="col-form-label">Phone*</label>
    
                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>
                
        <div class="form-group">
            <label for="road" class="col-form-label">Ulica*</label>
    
                <input id="road" type="text" class="form-control @error('road') is-invalid @enderror" name="road" value="{{ old('road') }}" required autocomplete="road" autofocus>
                @error('road')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>
    
        <div class="form-group">
            <label for="houseno" class="col-form-label">Numer Domu*</label>
    
                <input id="houseno" type="text" class="form-control @error('houseno') is-invalid @enderror" name="houseno" value="{{ old('houseno') }}" required autocomplete="houseno" autofocus>
                @error('houseno')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>
        <div class="form-group">
            <label for="flatno" class="col-form-label">Numer Mieszkania</label>
    
                <input id="flatno" type="text" class="form-control @error('flatno') is-invalid @enderror" name="flatno" value="{{ old('flatno') }}" autocomplete="flatno" autofocus>
                @error('flatno')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>
    
        <div class="form-group">
            <label for="postcode" class="col-form-label">Kod Pocztowy*</label>
    
                <input id="postcode" type="text" class="form-control @error('postcode') is-invalid @enderror" name="postcode" value="{{ old('postcode') }}" required autocomplete="postcode" autofocus>
                @error('postcode')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>
    
        <div class="form-group">
            <label for="city" class="col-form-label">Miejscowość*</label>
    
                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city" autofocus>
                @error('city')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>
    
    
        <div class="form-group">
            <label for="country" class="col-form-label">Kraj*</label>
    
                <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}" required autocomplete="country" autofocus>
                @error('country')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>

        <order-form></order-form>
        <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary submit">
                    Submit
                </button>
        </div>
    </form>
</div>
@endsection