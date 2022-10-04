@extends('layouts.admin.app')

@section('content')
    <div for='pages-products' class="cms-page">
        <div class="d-flex align-items-center justify-content-between">
            <h1>Products</h1>
            <a href="/admin/products/create" type="button" class="button">
                <i class="fas fa-plus"></i>
            </a>
        </div>

        <products-draggable :products="{{ $products }}"></products-draggable>
    </div>
@endsection
