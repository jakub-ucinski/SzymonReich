@extends('layouts.landing.app')

@section('content')
    <header id="header" class="home">
        <div class="container">

            <div class="header-content animated fadeIn delay-05">
                <h1>Jestem M<span class="typed"></span></h1>
                <p>Twórca - aktywista - optymista</p>

                <ul class="list-unstyled list-social">
                    <li><a href="//www.instagram.com/szymonreich/"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="//www.youtube.com/channel/UCFN12Qsy0h5kIXWvagUdlRQ"><i class="fab fa-youtube"></i></a></li>
                    <li id='icomoon-li'><a href="https://www.youtube.com/channel/UCFqPlDL6ESG5lP1AwtjzxDg"><i
                                class="icon-dzn icomoon-icon"></i></a></li>
                    <li><a href="//open.spotify.com/artist/1MzFJR6MaPjYS4A5J62DA6?si=r74R6WoSR9-PJXiCcrv06Q"><i
                                class="fab fa-spotify"></i></a></li>
                </ul>
            </div>

            <a class='chevron_down js-scroll-trigger' href="#about_section">
                <p class='chevron_text'>Zainspiruj się!</p>
                <i class="fas fa-chevron-down"></i>
            </a>


        </div>
    </header>



    <section id='about_section'>
        <div class='container wow animate__animated animate__fadeInLeft'>
            <h2 class='section_heading'>Słowo o mnie...</h2>
            <div class='section-content'>
                <div class="general-about">
                    <h3 class='heading'>Moje "dlaczego?"</h3>
                    <p>
                        Gdy byłem młodszy, chciałem, aby znalazł się ktoś, kto porozmawia ze mną na trudne tematy. Dziś
                        staram się być taką osobą dla innych.
                        <br>
                        <br>
                        Zauważam, jak wielu młodych boryka się z tematami, które sam musiałem przerobić - poczucie braku
                        sensu i osamotnienia, lęki społeczne, bariery w komunikacji intra- oraz interpersonalnej. Po
                        rówieśnikach rozpoznaję, że niekoniecznie są to problemy, z których się po prostu “wyrasta”.
                        Odwiedzając szkoły i przez social media dzielę się tym, jak niektóre wartości - miłość,
                        odpowiedzialność, empatia, inicjatywność, odwaga - pomagają mi nawigować przez życie, dzieląc się
                        przy tym wiarą chrześcijańską.
                    </p>
                </div>

                <div class="help-invite">Mogę Ci pomóc jako:</div>
                <div class='section_switcher'>
                    <h3><span id='Model_pick' class='focused_on hvr-float'>Model</span> <span class='hvr-float'
                            id='Muzyk_pick'>Muzyk</span> <span class='hvr-float' id='Ministrant_pick'>Ministrant</span></h3>
                </div>


                <div id='about_texts'>


                    <div class='about_text focused_on' id='model_text'>
                        <span datatarget='model'>
                            Rozpoznawalność zyskałem dzięki udziałowi w programach telewizyjnych Topmodel Polska oraz Hotel
                            Paradise. Modelingiem zajmuję się od dziecka i zrealizowałem kampanie dla marek jak Tchibo,
                            Esprit, OTTO, Normani. Dziś jestem reprezentantem Fitness Catering. Modeling pełni ważną rolę w
                            moim życiu jako praca, staram się jednak stopniowo poświęcać swojej pasji, czyli muzyce i
                            inspiracji innych.
                        </span>


                        <div class='align-buttom'>
                            <div class='highlighted_achivements'>
                                <div class='achievement'>
                                    <div class='achievement_big'>
                                        {{ Str::substr($socialStats['instagram']['followers'], 0, 3) . 'k' }}</div>
                                    <div class='achievement_small'>obserwujących na Instagramie</div>
                                </div>
                                <div class='achievement'>
                                    <div class='achievement_big'><img
                                            src="img/wspolpraca_loga_nomargin/Fitness_catering_logo.png" alt="">
                                    </div>
                                    <div class='achievement_small'>Ambasador marki Fitness Catering</div>
                                </div>
                            </div>

                            <a href='#contact-section'
                                class='contact-button btn btn-dark js-scroll-trigger hvr-radial-out'>Współpraca<i
                                    class="fas fa-chevron-down"></i></a>
                        </div>

                    </div>

                    <div class='about_text' id='muzyk_tekst'>
                        <span datatarget='muzyk'>
                            W życiu staram się cieszyć wszystkim, ale jest coś, czego nie trawię - monotonia. Kocham zmiany,
                            ruch, lubię, gdy się coś dzieje. Jako nastolatek jednakże mało angażowałem się w kreatywne
                            projekty. Wychowano mnie tak, aby osiągać najlepsze wyniki w szkole, co też przyniosło swoje
                            owoce. Mój wewnętrzny buntownik nie mógł jednak usiedzieć w spokoju zbyt długo. Angażując się w
                            różne projekty, pomagałem znajomym w realizacji swoich wizji. Pierwszy teledysk, w którym brałem
                            swój udział, miał ponad 10 milionów wyświetleń! Poruszony wyjątkową sytuacją życiową w zeszłym
                            roku nagrałem pierwszy teledysk. “Jestem BLESSED” uzyskało 300 tys. wyświetleń. “Jesteś BLESSED,
                            jesteś BLESSED - wrzuć na luz, po co Ci stres; znajdź swój cel, ja swój znam, a Ty jaki masz?” -
                            ciekawe, że muzyka jest narzędziem, które pozwala mi dzielić się swoim wnętrzem z innymi, a z
                            drugiej strony - podczas tworzeniu jej sam stale się czegoś uczę.
                        </span>
                        <!-- <iframe src="https://open.spotify.com/embed/track/7I4GyZQPC5GkZ71siiScSf" width="300" height="80" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe> -->

                        <div class='align-buttom'>
                            <div class='highlighted_achivements'>
                                <div class='achievement'>
                                    <div class='achievement_big'>
                                        {{ Str::substr($socialStats['youtube']['muzykViews'], 0, 3) . 'k' }}</div>
                                    <div class='achievement_small'>Wyswietleń na Youtube</div>
                                </div>
                                <div class='achievement'>
                                    <div class='achievement_big'>2</div>
                                    <div class='achievement_small'>single <br>(album już wkrótce)</div>
                                </div>
                            </div>

                            <a href='#contact-section'
                                class='contact-button btn btn-dark js-scroll-trigger hvr-radial-out'>Collab<i
                                    class="fas fa-chevron-down"></i></a>

                        </div>
                    </div>

                    <div class='about_text' id='ministrant_tekst'>
                        <span datatarget='ministrant'>
                            Jestem ministrantem (ministrare - służyć). Jednak moja służba i pomoc innym wychodzi poza ramy
                            kościoła. W zeszłym roku odwiedziłem ok. 11.000 młodych w szkołach czy masowych wydarzeniach.
                            Angażuję się w projekty społeczne i jestem uczestnikiem Ligi NGO’s dla aktywistów i przyszłych
                            liderów. Szukam sposobów, aby dzielić się wiarą, z którą łączę optymizm, wiarę w ludzkie dobro,
                            nadzieję na lepsze jutro i że warto próbować: realizować siebie, być stale lepszym człowiekiem,
                            dawać i dążyć do ogólnego dobra. Dlatego też, wiara pełni centralną rolę w moim życiu i jest
                            motorem wszelkich działań. Dotknięty przykrościami życia wielu przyjaciół, ale też własnych
                            doświadczeń, szerzę poglądy, które uważam, że mogą wielu osobom pomóc. Na wystąpieniach
                            publicznych omawiam tematy typu: sukces - więcej niż tylko pieniądze?, optymizm i
                            samorealizacja, kluczowe wartości: rodzina, odpowiedzialność, miłość oraz odpowiadam na pytanie
                            “Jak to jest być osobą wierzącą w show-biznesie?”. </span>

                        <div class='align-buttom'>
                            <div class='highlighted_achivements'>
                                <div class='achievement'>
                                    <div class='achievement_big'>11k</div>
                                    <div class='achievement_small'>zainspirowanych na wystąpieniach publicznych</div>
                                </div>
                                <div class='achievement'>
                                    <div class='achievement_big' style='margin-top: 7px;'><img id='do-zoba-img'
                                            src="img/wspolpraca_loga_nomargin/Do_zobaczenia_w_niebie.png" alt="">
                                    </div>
                                    <div class='achievement_small'>Prezenter kanału "Do zobaczenia w Niebie"</div>
                                </div>
                            </div>

                            <a href='#contact-section'
                                class='contact-button btn btn-dark js-scroll-trigger hvr-radial-out'>Zaproś mnie jako mówcę
                                lub artystę<i class="fas fa-chevron-down"></i></a>
                        </div>

                    </div>

                </div>

            </div>
        </div>

        {{-- <img class='big_transparent wow fadeInRight' src="img/big_szymon.png" alt=""> --}}
        <img class='big_transparent wow animate__animated animate__fadeInRight' src="img/big_szymon.png" alt="">

    </section>

    <section id='achievement_slider_section' class='wow animate__animated animate__fadeInUp'>
        <div class="progress" style="height: 3px;">
            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="container-fluid">

            <div class='achievement-slider'>
                <div id='partnerships' class='achievement_content'>
                    <h2 class='achievement_slider_title'>Marki, które mi zaufały</h2>
                    <div class='owl-carousel owl-6 section_items'>
                        <img class='item' src="img/wspolpraca_loga_nomargin/Esprit_logo.png" alt="">
                        <img class='item' src="img/wspolpraca_loga_nomargin/House_logo.png" alt="">
                        <a href='//fitnesscatering.com.pl/TAK-SMAKUJE-PASJA-cinfo-pol-96.html'><img class='item'
                                src="img/wspolpraca_loga_nomargin/Fitness_catering_logo.png" alt=""></a>
                        <img class='item' src="img/wspolpraca_loga_nomargin/Normani_logo.png" alt="">
                        <img class='item' src="img/wspolpraca_loga_nomargin/Otto_logo.png" alt="">
                        <img class='item' src="img/wspolpraca_loga_nomargin/Tchibo_logo.png" alt="">
                    </div>
                </div>

                <div id='statistics' class='achievement_content'>
                    <h2 class='achievement_slider_title'>Statystyki i zasięgi</h2>
                    <div class='owl-carousel owl-6 section_items'>
                        <p class='item'><span
                                class='big_stat'>{{ Str::substr($socialStats['instagram']['followers'], 0, 3) . 'k' }}</span><span
                                class='small_stat'>Obserwujących na Instagramie</span></p>
                        <p class='item'><span
                                class='big_stat'>{{ Str::substr($socialStats['youtube']['totalViews'], 0, 3) . 'k' }}</span><span
                                class='small_stat'>Wyświetleń kanału "Szymon Reich"</span></p>
                        <p class='item'><span
                                class='big_stat'>{{ Str::substr($socialStats['youtube']['subscribers'], 0, 1) . 'k' }}</span><span
                                class='small_stat'>Sybskrybentów kanału "Szymon Reich"</span></p>
                        <p class='item'><span class='big_stat'>2</span><span class='small_stat'>Single (album
                                wkrótce)</span></p>
                        <p class='item'><span class='big_stat'>62k</span><span class='small_stat'>Odsłuchań na
                                Spotify</span></p>
                        <p class='item'><span class='big_stat'>11k</span><span class='small_stat'>Zainspirowanych na
                                wystąpieniach publicznych</span></p>
                    </div>
                </div>

                <div id='projects' class='achievement_content'>
                    <h2 class='achievement_slider_title'>Projekty, którym się poświęcam</h2>
                    <div class='owl-carousel owl-2 section_items'>

                        <a href='//www.ligangos.pl'><img class='item' src="img/wspolpraca_loga_nomargin/ligangos.png"
                                alt=""></a>
                        <a href='//www.youtube.com/channel/UCFqPlDL6ESG5lP1AwtjzxDg'><img class='item'
                                src="img/wspolpraca_loga_nomargin/Do_zobaczenia_w_niebie.png" alt=""></a>
                    </div>
                </div>

                <div id='more' class='achievement_content'>
                    <h2 class='achievement_slider_title'>Dowiedz się więcej</h2>
                    <div class='owl-carousel owl-2 section_items'>

                        <a
                            href='//deon.pl/wiara/swiadectwa/szymon-reich-z-top-model-zachwyca-nowa-piosenka-i-szczerym-swiadectwem-dot-wiary-w-boga-wideo,682155?fbclid=IwAR2erkXham6cI8njKOX5dQqznesSOeD25-o2f14QD5QSEZpg5ystjp5OxPY'><img
                                id='deon-logo' class='item' src="img/wspolpraca_loga_nomargin/deon.png"
                                alt=""></a>
                        <a
                            href='//dziendobry.tvn.pl/a/szymon-reich-bozy-wariat-ktory-czuje-powolanie-by-glosic-wiare-w-boga'><img
                                class='item' src="img/wspolpraca_loga_nomargin/ddt_logo.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section id='contact-section' class=''>
        <div class="container">
            <h2 id="contact-head" class='wow animate__animated animate__fadeInDown delay-05'>Kontakt</h2>
            <div class="content">
                <div class="wow animate__animated animate__fadeInRight" id='contact-info'>
                    <div class="contact-section-heading">Współpraca komercyjna</div>
                    <div class="contact-section-content">
                        <a class="item" href='mailto:szymon@reichsmanagement.com'><i class="fas fa-at"></i>
                            <div class="item-text">szymon@reichsmanagement.com</div>
                        </a>
                        <div class="item"><i class="fab fa-whatsapp"></i>
                            <div class="item-text">+49 157 55714434 • WhatsApp</div>
                        </div>
                    </div>
                </div>
                <div class="wow animate__animated animate__fadeInLeft" id='contact-form'>
                    <div class="contact-section-heading">Zaproszenie do szkoły - miasta - parafii</div>
                    <p id="contact-text" class=''>Jeżeli chciałbyś mnie zaprosić do swojej szkoły/miasta/parafii, to
                        świetnie! Wypełnij poniższy formularz kontaktowy - przedstaw się i podaj mi kilka szczegółów.
                        Niebawem odezwie się do Ciebie ktoś z mojego zespołu, aby domówić szczegóły.</p>

                    <form method="post" action='/contact' class="needs-validation" novalidate>
                        @csrf
                        <div class="message-form form-row">

                            <div class="form-group col-md-6">
                                <label for="name">Imię i Nazwisko</label>
                                <input class='form-control' id='name' type="name" name="name" value=""
                                    placeholder="Jan Kowalski" required>
                                <div class="valid-feedback">
                                    Wygląda dobrze!
                                </div>
                                <div class="invalid-feedback">
                                    Proszę podać Imię i Nazwisko.
                                </div>
                            </div>

                            <!-- <div class="form-group">
                                      <label for="representation">Reprezentuję:</label>
                                      <select class="custom-select" id="representation">
                                          <option value="School">Szkołę</option>
                                          <option value="Parish">Parafię</option>
                                      </select>
                                  </div> -->

                            <div class="form-group col-md-6">
                                <label for="representation">Reprezentuję:</label>
                                <input class='form-control' id='representation' type="representation"
                                    name="representation" value="" placeholder="Szkołę/Parafię w ..." required>
                                <div class="valid-feedback">
                                    Wygląda dobrze!
                                </div>
                                <div class="invalid-feedback">
                                    Proszę wypełnić pole.
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Adres email</label>
                                <input class='form-control' id='email' type="email" name="email"
                                    value="<?php echo !empty($postData['email']) ? $postData['email'] : ''; ?>" placeholder="adres@email.com" required>

                                <div class="valid-feedback">
                                    Wygląda dobrze!
                                </div>
                                <div class="invalid-feedback">
                                    Proszę podać poprawny adres email.
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone">Numer telefonu</label>
                                <input class='form-control' id='phone' type="phone" name="phone"
                                    value="<?php echo !empty($postData['phone']) ? $postData['phone'] : ''; ?>" placeholder="Numer telefonu" required>
                                <div class="valid-feedback">
                                    Wygląda dobrze!
                                </div>
                                <div class="invalid-feedback">
                                    Proszę podać numer telefonu.
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="message">Wiadomość</label>
                                <textarea class='form-control' id='message' name="message" placeholder="Wiadomość" rows="5" required><?php echo !empty($postData['message']) ? $postData['message'] : ''; ?></textarea>
                                <div class="valid-feedback">
                                    Wygląda dobrze!
                                </div>
                                <div class="invalid-feedback">
                                    Proszę napisać wiadomość.
                                </div>

                            </div>
                        </div>
                        {{-- <div class="g-recaptcha" data-sitekey="6LfIn-UUAAAAAAmRyGt1r13F62fteA2XOoI1u8Zj"></div> --}}
                        <input type="submit" name="contactSubmit" class="btn" id='contact-form-submit'
                            value="Wyślij">


                    </form>
                    <!-- Display the status message -->

                    @if (count($errors) > 0)
                        <div class="alert error alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <ul class='mb-0'>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if ($response = Session::get('response'))
                        <div class="alert {{ $response['status'] }} alert-dismissible fade show">{{ $response['message'] }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                </div>

            </div>
        </div>
        {{-- <script>
        function validateCaptcha() {

            if (!grecaptcha.getResponse()) {
                document.getElementById('recaptcha-error').innerHTML ='<p class="field-error">The recaptcha field is required</p>';
                return false;
            }
            return true;
            
        }
    </script> --}}
    </section>
@endsection
