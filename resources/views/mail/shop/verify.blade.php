<p>Dziękujemy za zakupy w sklepie QoQosa!</p>
<p>Potwierdzam zamówienie Twojego koszyka:</p>
@foreach ($order->cart_products as $cart_product)
    @if ($cart_product->product_variant == 'product')

        @php
            $product = DB::table('products')->where('id', $cart_product->product_variant_id)->first();
            $productTitle = $product->title
        @endphp
        {{$product->title}} {{($product->price)*0.9/100}} <br>
    @else
        @php
            $product = DB::table('product_variations')->where('id', $cart_product->product_variant_id)->first();
            $productTitle = $product->title
        @endphp
        {{$product->title}} {{($product->price)*0.9/100}} <br>

    @endif

@endforeach

Przesyłka Kurierska Inpost 13.00
<p>Suma łącznie: {{($order->price)/100}}</p>
<p>Na adres:</p>
<p>{{$order->name}} {{$order->surname}}</p>
<p>{{$order->road}} {{$order->houseno}}@if ($order->flatno)/{{$order->flatno}}@endif</p>
<p>{{$order->postcode}}</p>
<p>{{$order->city}}</p>
@if ($order->country)<p>{{$order->country}}</p>@endif

<p>Pamiętaj, że Plannery wysyłamy dopiero od 13.11.2020 r. 🥥</p>
<p>Jeśli chcesz zrobić sobie zdjęcie z którymś z moich produktów, wyślij mi je na e-mail sklep@szymonreich.pl bądź na Instagram @szymonreich załączając swój numer ID: {{$order->id}}</p>
<p>Pamiętaj, aby być sobą i nie zapominaj się doskonalić 🥥</p>
<br>
<p>Jeżeli nie składałeś zamówienia, zamówiłeś coś innego, albo zamówiłeś na inny adres, opisz to proszę wysyłając mail na sklep@szymonreich.pl, podając swój numer ID: {{$order->id}}</p>
<br>
<p>Stay BLESSED</p>
<p>QoQos</p>