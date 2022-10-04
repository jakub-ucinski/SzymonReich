<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.shop.partials.head')
    </head>
    <body data-spy="scroll" data-target='.js-scroll-trigger' data-offset='100' id="shop">
        <div id="app" class="thankyou" class="h-100">

        <nav id="main-nav" class="navbar navbar-expand-custom fixed-top navbar-light">
            <div class="container-fluid">
        
              <div class="navbar-brand logo">
                <a class='' href="/sklep"><img src="/svg/shop/logo.svg" alt="logo"></a>
              </div>
        
              <div class="menu-btn navbar-toggler" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                  <div class="menu-btn__burger"></div>
              </div>
        
              <div class='navbar-collapse collapse' id="navbarContent">
                <ul class="navbar-nav ml-auto" >
                  <li class='navbar-item nav-item'><a href="/" class="nav-link">Strona Główna</a></li>
                  
                </ul>
              </div>
            </div>
        </nav>

        <section class="thank-you-page container">
            <div class="message"><div class="top">Dobrze, że jesteś!</div><div class="bottom">Witaj w gronie (nie)doskonałych</div></div>        
            <img id="szymon-box" src="/img/shop/szymon-box.png" alt="" srcset="">
            <a class="go-back-button" href="/sklep">Powrót do sklepu</a>
        </section>
        <span class="credits">&#169; Copyright Dorota Czoch dla RTCK</span>

        <script>
            document.getElementById('#app').style.backgroundColor = '#dedede';
        </script>
        @include('partials.footer')
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>