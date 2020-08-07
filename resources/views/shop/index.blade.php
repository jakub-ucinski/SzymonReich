@extends('layouts.shop.app')

@section('content')

{{-- <div class="hero-background"></div> --}}
    <div class="hero-background">
        <img class="hero-img" src="/img/shop/ab67616d0000b273c093346b4cc20490f720c735.png" alt="" srcset="">
    </div>
    <div class="products d-flex">
        
        

        @foreach ($products as $product)
            <div class="product mx-3 d-flex flex-column">
                @foreach ($product->images as $image)
                    @if ($loop->first)
                        <img src="{{ $image->getURL() }}" alt="" srcset="">
                    @endif                    
                @endforeach

                
                <span class="title">{{ $product->title }}</span>
                <span class="description">{{ $product->description }}</span>
                <span class="price">PLN: {{ $product->price }}</span>
                
                <a class="btn btn-show-product" type="button" href="/shop/{{$product->id}}">Zobacz</a>
            </div>
        @endforeach
    </div>
@endsection

