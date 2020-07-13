@extends('layouts.admin.app')

@section('content')


{{-- <div class="container align-self-center">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('products.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">Price</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="images" class="col-md-4 col-form-label text-md-right">Images</label>

                            <div class="col-md-6">
                                <input id="images" type="file" class="form-control @error('images') is-invalid @enderror" name="images[]" value="{{ old('images') }}" required autocomplete="images" autofocus multiple>

                                @error('images')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                                @if(session('imageresponse'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ session('imageresponse') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<h1>{{ $product->title }}</h1>
<a type="button" href="{{ route('products.index') }}" class="button mr-2">
    <i class="fas fa-arrow-left"></i>                    
</a>

            <form method="POST" enctype="multipart/form-data" action="{{ route('products.update', $product->id) }}">
                        @method('PATCH')

                        @csrf

                        <div class="form-group w-50">
                            <label for="title" class="col-form-label">Title</label>

                                <input id="title" value="{{ $product->title }}" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>


                        <div class="form-group w-50">
                            <label for="description" class="col-form-label">Description</label>

                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" rows="6" autofocus>{{ $product->description }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group w-50">
                            <label for="price" class="col-form-label">Price</label>

                                <input id="price" type="text" value="{{ $product->price }}" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        
                        <div class="form-group w-50">
                            <label for="images" class="col-form-label">Images</label>

                                <input id="images" type="file" class="@error('images') is-invalid @enderror form-control-file" name="images[]" value="{{ old('images') }}" autocomplete="images" autofocus multiple>

                                @error('images')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                                @if(session('imageresponse'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ session('imageresponse') }}</strong>
                                </span>
                                @endif
                        </div>

                        <div class="form-group w-50">
                            <label for="stock" class="col-form-label">Stock</label>

                                <input id="stock" type="number" value="{{ $product->stock }}" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock') }}" required autocomplete="stock" autofocus>

                                @error('stock')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group w-50">
                            <label for="order" class="col-form-label">Order</label>

                                <input id="order" type="number" value="{{ $product->order }}" class="form-control @error('order') is-invalid @enderror" name="order" value="{{ old('order') }}" autocomplete="order" autofocus>

                                @error('order')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group w-50">

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="limited" value="1" name="limited">
                                <label class="form-check-label" for="limited">Limited?</label>
                            </div>
                        </div>

                        <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                        </div>
                    </form>

                    <div class="img-index">
                        @foreach ($product->images as $image)
                            <div class="d-flex w-100 my-2">
                                <img src="/storage/{{ $image->image }}" alt="" srcset="">
                                <form action="/admin/productimages/{{ $image->id }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    
                                        <button type="submit" class="button mr-2">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                            
                                </form>
                            </div>
                        @endforeach
                    </div>
                    



    <script>
        document.getElementById('products-side-link').classList.add('active');
    </script>
@endsection