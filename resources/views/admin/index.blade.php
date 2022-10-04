@extends('layouts.admin.app')

@section('content')
    <div for='home' class="cms-page">
        <div class="d-flex align-items-center justify-content-between">
            <h1>Home</h1>

        </div>

        <h2>Orders</h2>
        <table>
            <colgroup>
                <col>
                <col>
                <col>
                <col>
                <col>
                <col>
                <col>

            </colgroup>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Products bought</th>
                    <th>Amount</th>

                    <th>Address</th>
                    <th>Status</th>
                    <th>Date ordered</th>

                </tr>
            </thead>
            {{-- <draggable :list="productsNew" ghost-class="ghost" :options="{animation: 200, handle: '.my-handle'}" :element="'tbody'" @change="update"> --}}

            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->name }}</td>


                    <td>
                        {{-- {{dd($order->cart_products)}} --}}

                        @foreach ($order->cart_products as $cart_product)
                            @if ($cart_product->product_variant == 'product')
                                @php
                                    $product = DB::table('products')
                                        ->where('id', $cart_product->product_variant_id)
                                        ->first();
                                    $productTitle = $product->title;
                                @endphp
                                {{ $productTitle }}
                            @else
                                @php
                                    $product = DB::table('product_variations')
                                        ->where('id', $cart_product->product_variant_id)
                                        ->first();
                                    $productTitle = $product->title;
                                @endphp
                                {{ $productTitle }}
                            @endif
                            <hr>
                        @endforeach

                        {{-- {{dd('test')}} --}}

                    </td>

                    <td>{{ $order->price }}</td>


                    <td>
                        {{-- {{dd($order)}} --}}
                        Phone: {{ $order->phone }}
                        <hr>
                        {{ $order->road }} {{ $order->houseno }}/{{ $order->flatno }}
                        <hr>
                        {{ $order->postcode }}
                        <hr>
                        {{ $order->city }}
                        <hr>
                        {{ $order->country }}
                    </td>

                    <td>{{ $order->status }}</td>

                    <td>{{ $order->created_at }}</td>











                    {{-- <!-- <td>{{product.stock}}</td> --> --}}
                    {{-- <td v-if="product.limited">true</td>
                <td v-else>false</td>
                <td class="d-flex">
                    <form :action="'products/' + product.id" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" :value="csrf">                    
                    
                        <!-- @csrf -->
                            <button type="submit" class="button mr-2">
                                <i class="fas fa-trash-alt"></i>
                             </button>
                
                    </form>
                    <a :href="'products/' + product.id + '/edit'" class="button">
                        <button type="submit" class="button">
                                <i class="fas fa-pencil-alt"></i>                     
                        </button>
                    </a>
                </td>
                <td>
                    <i class="fas fa-bars my-handle"></i>
    
                </td> --}}
                </tr>
                {{-- </draggable> --}}
            @endforeach

        </table>

        <div class="orders-links">
            {{ $orders->links() }}

        </div>





        {{-- <a href="/admin/products/create" type="button" class="button">
            <i class="fas fa-plus"></i>
        </a> --}}


    </div>
    {{-- <script>
    document.getElementById('home-side-link').classList.add('active');
</script> --}}
@endsection
