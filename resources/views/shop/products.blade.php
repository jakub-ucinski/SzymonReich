@extends('layouts.shop.app')

@section('content')
    <section class="container shop-products">

        @foreach ($products as $product)
            @php
                $varcategories = [];
            @endphp

            @foreach ($product->variation_categories as $variationcategory)
                @php
                    $variationcategory->varoptions = $variationcategory->variation_options;
                    array_push($varcategories, $variationcategory);
                @endphp
            @endforeach

            @php
                $varcategories = json_encode($varcategories);
            @endphp

            @if ($product->limited == 0)
                <product-tile-standard :product='{{ $product }}' :productvariationcategories='{{ $varcategories }}'
                    :productvariations='{{ $product->variations }}'
                    :productrecommendations='{{ $product->recommendations }}'></product-tile-standard>
            @else
                <product-tile-limited :product='{{ $product }}'></product-tile-limited>
            @endif
        @endforeach

        <basket></basket>
    </section>
    <section class="container order-products hidden">
        <order-form></order-form>



    </section>
    @if ($errors->any())
        <div class='alert alert-warning alert-dismissible show'>
            @foreach ($errors->all() as $error)
                <div class="error">
                    {{ $error }}
                </div>
            @endforeach

            <button type="button" data-dismiss="alert" class="close" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

@endsection
