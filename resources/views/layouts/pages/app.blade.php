

 <!DOCTYPE html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
     <head>
         
         @include('layouts.pages.partials.head')
     </head>
 
     <body data-spy="scroll" data-target='#main-nav' data-offset='100' id="pages">
         <div class="app-wrapper">
            <div class="navbar-wrapper">
                <nav id="main-nav" class="navbar navbar-expand-lg fixed-top navbar-light">
                    <div class="container-fluid">
                
                      <div class="navbar-brand logo">
                        <a class='js-scroll-trigger' href="/#header"><img src="/img/logo.png" alt="logo"></a>
                      </div>
                
                      <!-- <div class="responsive"><i data-icon="m" class="ion-navicon-round"></i></div> -->
                      <div class="menu-btn navbar-toggler" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                          <div class="menu-btn__burger"></div>
                      </div>
                
                      <div class='navbar-collapse collapse' id="navbarContent">
                        <ul class="navbar-nav ml-auto" >
                          <li class='navbar-item nav-item'><a href="/#about_section" class="nav-link js-scroll-trigger hvr-backward"><i class="fas fa-question"></i></i>O mnie</a></li>
                          <li class='navbar-item nav-item'><a href="/#contact-section" class="nav-link js-scroll-trigger hvr-backward"><i class="fas fa-envelope"></i>Kontakt</a></li>
                          <!-- <li class='navbar-item nav-item'><a href="#" class="nav-link">|</a></li> -->
                          {{-- <li id='shop-li' class='navbar-item nav-item'><a href="/shop" class="nav-link hvr-backward"><i class="fas fa-shopping-cart"></i>Sklep</a></li> --}}
                          <li id='shop-li' class='navbar-item nav-item'><a class="nav-link hvr-backward" tabindex="0" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="Własna kolekcja merchandise już wkrótce!"><i class="fas fa-shopping-cart"></i>Sklep</a></li>

                        </ul>
                      </div>
                    </div>
                </nav>
               </div>
        
                @yield('content')
                @include('partials.footer')
         </div>
         <script src="{{ asset('js/app.js') }}"></script>
 
     </body>
 </html>