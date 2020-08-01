@extends('layouts.pages.app')

@section('content')

<div class="container content-wrapper">
    <h1>{{$page->title}}</h1>
    {!!$page->text!!}

</div>

@endsection
