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


<div for='home' class="cms-page">
    <div class="d-flex align-items-center justify-content-between">
        <h1>Home</h1>
        {{-- <a href="/admin/products/create" type="button" class="button">
            <i class="fas fa-plus"></i>
        </a> --}}
    </div>

    
</div>
{{-- <script>
    document.getElementById('home-side-link').classList.add('active');
</script> --}}


@endsection
