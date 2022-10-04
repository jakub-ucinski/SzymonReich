<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    @include('layouts.shop.partials.head')
</head>

<body data-spy="scroll" data-target='.js-scroll-trigger' data-offset='100' id="shop">
    <div id="app" class="h-100">

        <nav id="main-nav" class="navbar navbar-expand-custom fixed-top navbar-light">
            <div class="container-fluid">

                <div class="navbar-brand logo">
                    <a class='' href="/sklep"><img src="/svg/shop/logo.svg" alt="logo"></a>
                </div>

                <!-- <div class="responsive"><i data-icon="m" class="ion-navicon-round"></i></div> -->
                <div class="menu-btn navbar-toggler" data-toggle="collapse" data-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="menu-btn__burger"></div>
                </div>
                {{-- <div class="nav-text">
                    -10% NA WSZYSTKO do 21.12 - Wysyłka do Świąt
                </div> --}}
                <div class='navbar-collapse collapse' id="navbarContent">
                    <ul class="navbar-nav ml-auto">
                        <li class='navbar-item nav-item' id="nav-text">Weekendowa Wyprzedaż <br> -10% NA WSZYSTKO!</li>
                        <li class='navbar-item nav-item'><a href="/" class="nav-link">Strona Główna</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
        @include('partials.footer')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>
