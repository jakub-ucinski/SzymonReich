{{-- <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
 --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        
        @include('layouts.shop.partials.head')
    </head>

    <body data-spy="scroll" data-target='#main-nav' data-offset='100' id="shop">
        <div id="app" class="h-100">

        <nav id="main-nav" class="navbar navbar-expand-lg fixed-top navbar-light">
            <div class="container-fluid">
        
              <div class="navbar-brand logo">
                <a class='js-scroll-trigger' href="/#header"><img src="img/logo.png" alt="logo"></a>
              </div>
        
              <!-- <div class="responsive"><i data-icon="m" class="ion-navicon-round"></i></div> -->
              <div class="menu-btn navbar-toggler" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                  <div class="menu-btn__burger"></div>
              </div>
        
              <div class='navbar-collapse collapse' id="navbarContent">
                <ul class="navbar-nav ml-auto" >
                  <li class='navbar-item nav-item'><a href="/" class="nav-link js-scroll-trigger hvr-backward"><i class="fas fa-home"></i></i>Strona Główna</a></li>
                  {{-- <li class='navbar-item nav-item'><a href="/#contact-section" class="nav-link js-scroll-trigger hvr-backward"><i class="fas fa-envelope"></i>Kontakt</a></li> --}}
                  <!-- <li class='navbar-item nav-item'><a href="#" class="nav-link">|</a></li> -->
                  <li class='navbar-item nav-item'><a href="/shop" class="nav-link hvr-backward"><i class="fas fa-check"></i>Regulamin</a></li>
                  <li class='navbar-item nav-item'><a href="/shop" class="nav-link hvr-backward"><i class="fas fa-lock"></i>Klauzura Poufności</a></li>


                  {{-- @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest --}}
        
                  <!-- <li><a href="#header" class="js-scroll-trigger">Test</a></li> -->
                </ul>
              </div>
            </div>
        </nav>

        @yield('content')
        @include('partials.footer')
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        {{-- <script src="/public/js/app.js"></script> --}}

    </body>
</html>