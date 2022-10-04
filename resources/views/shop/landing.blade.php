@extends('layouts.shop.app')

@section('content')

    <section class="hero container">
        <div class="hero-cd-text-wrapper">
            <div class="hero-cd allow-rotation">
                <div class="hero-cd-sides">
                    <div class="hero-cd-front">
                        <img class="hero-img" src="/img/shop/albumcover.jpg" alt="" srcset="">

                    </div>
                    <div class="hero-cd-back">
                        <img class="hero-img" src="/img/shop/albumcoverback.jpg" alt="" srcset="">

                    </div>

                </div>

            </div>
            
            <div class="hero-text">
                <div class="title">Kolekcja (nie)doskonały - prawie wyprzedana!</div>
                <div class="body">
                    Rozglądając się po świecie, pewnie zauważasz na każdym kroku iluzję doskonałości. Prawda jest taka, że nikt z nas nie jest doskonały – i to jest piękne! Odkryj doskonałość w swojej niedoskonałości to dosłowny przekaz tej kolekcji. Bądź sobą, bądź (nie)doskonały i odkryj siłę w swej autentyczności.
                    <br>
                    <br>
                    Z każdego zakupu 5% zostanie przeznaczone na fundację Gajusz.
                    <br>
                    <br>
                    Kupując wszystkie produkty, otrzymasz pakiet PREMIUM DELUXE i darmowy krzyżyk z prawdziwego kokosa.</div>
                <a href="#products" class="js-scroll-trigger cta-hero-button" type="button">Zobacz więcej</a>

            </div>
        </div>
        
        <div class='hover-message show'>Kliknij i dowiedz się więcej</div>
    </section>
    <a href="/sklep/products" class="cta-bottom-button" type="button">Przejdź do sklepu</a>

    <section class="products container" id="products">
        @foreach ($products as $product)
            @if ($product->shortDescription)
                <div class="product">
                    @foreach ($product->images as $image)
                        @if ($loop->first)
                            <div class="product-image-wrapper" style="background-image: url({{ $image->getURL() }})">
                                <img class="product-image" src="{{ $image->getURL() }}" alt="" srcset="">
                            </div>
                        @endif                    
                    @endforeach                    
                    <span class="title">{{ $product->title }}</span>
                    <span class="description">{{ $product->shortDescription }}</span>
                </div>
            @endif
            
        @endforeach
    </section>
@endsection

