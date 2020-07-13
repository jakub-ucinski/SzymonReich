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


<div for='pages-products' class="cms-page">
    <div class="d-flex align-items-center justify-content-between">
        <h1>Products</h1>
        <a href="/admin/products/create" type="button" class="button">
            <i class="fas fa-plus"></i>
        </a>
    </div>

    <products-draggable :products="{{ $products }}"></products-draggable>
</div>

  {{-- <script>
    document.getElementById('products-side-link').classList.add('active');
</script> --}}

@endsection
