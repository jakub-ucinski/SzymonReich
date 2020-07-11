@extends('layouts.admin.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}

{{-- <div class="container">
    <div class="row justify-content-center">
        <p>products cms page</p>
    </div>
</div> --}}

<div class="d-flex align-items-center justify-content-between">
    <h1>Products</h1>
    <a href="/admin/products/create" type="button" class="button">
        <i class="fas fa-plus"></i>
    </a>
</div>

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
    <tr>
      <th>Title</th>
      <th>Description</th>
      <th>Price</th>
      <th>Images</th>
      <th>Stock</th>
      <th>Limited</th>
      <th>Options</th>

      {{-- <th>Stock</th>
      <th>Limited</th> --}}
    </tr>
    @foreach ($products as $product)

    <tr>
        <td>{{$product->title}}</td>
        <td>{{$product->description}}</td>
        <td>{{$product->price}}</td>
        <td>
        @foreach ($product->images as $image)
            <img src="/storage/{{$image->image}}" alt="" srcset="">
        @endforeach        
        </td>

        <td>{{$product->stock}}</td>
        {{-- <td>{{$product->limited ? true : false}}</td> --}}
        <td>@if ($product->limited){{'true'}}@else{{'false'}}@endif</td>
        <td class="d-flex">
            <form action="{{ route('products.destroy', $product->id) }}" method="post">
                @method('DELETE')
                @csrf
                
                    <button type="submit" class="button mr-2">
                        <i class="fas fa-trash-alt"></i>
                     </button>
        
            </form>

            <form action="{{ route('products.edit', $product->id) }}" method="get">
                @csrf
                
                    <button type="submit" class="button">
                        <i class="fas fa-pencil-alt"></i>                     
                    </button>
        
            </form>
        </td>
        
    </tr>
    @endforeach

    {{-- <tr>
      <td>Eve</td>
      <td>Jackson</td>
      <td>94</td>
    </tr> --}}
  </table>

  <script>
    document.getElementById('products-side-link').classList.add('active');
</script>

@endsection
