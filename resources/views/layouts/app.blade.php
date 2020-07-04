<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        
        @include('layouts.partials.head')
    </head>

    <body data-spy="scroll" data-target='#main-nav' data-offset='100'>
        
        @include('layouts.partials.navbar')

        @yield('content')
        @include('layouts.partials.footer')
        <script src="{{ asset('js/app.js') }}"></script>
        {{-- <script src="/public/js/app.js"></script> --}}

    </body>
</html>