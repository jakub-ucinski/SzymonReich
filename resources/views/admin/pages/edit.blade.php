@extends('layouts.admin.app')

@section('content')

<div for='pages-pages' class="cms-page">
    <h1>New Page</h1>
    <a type="button" href="{{ route('pages.index') }}" class="button mr-2">
        <i class="fas fa-arrow-left"></i>                    
    </a>

    <form method="POST" enctype="form-data" action="{{ route('pages.update', ['page' => $page->id]) }}">
        @csrf
        @method('PATCH')

        <div class="form-group w-50">
            <label for="title" class="col-form-label">Title</label>

                <input id="title" value="{{ $page->title }}" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>



        <input id="text" type="hidden" name="text" value="{{ $page->text }}">
                

        <div class="form-group w-50">
            <label for="text" class="col-form-label">text</label>

            <text-editor-tip-tap></text-editor-tip-tap>
            @error('text')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

    
        <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
        </div>
    </form>




</div>

<script>



</script>
@endsection
