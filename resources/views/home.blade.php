@extends('templates.app')

@section('content')
    <div class="homeblade">
        <ul class="pagination">
            <li><a class="active" href="#home"><span class="hover-text">Home</span></a></li>
            <li><a class="" href="#media"><span class="hover-text">Media</span></a></li>
            <li><a class="" href="#distribution"><span class="hover-text">Distribution</span></a></li>
            <li><a class="" href="#realmlist"><span class="hover-text">Realmlist</span></a></li>
            <li><a class="" href="#news"><span class="hover-text">News</span></a></li>
        </ul>

        <section id="intro" class="panel" data-section-name="home">
            <video class="bg-vid" src="{{ asset('media/video/bg_vid.mp4') }}" type="video/mp4" loop="loop"
                   autoplay="autoplay"
                   playsinline="playsinline" muted="muted"></video>

            <div class="container-fluid">
                <div class="row h-100 justify-content-center align-items-center">
                    <div class="col-12">
                        <div class="hero-text justify-content-center">
                            <h1>Ascension</h1>
                            <h4 class="intro-sub">World of Warcraft Private Server</h4>
                            <a href="{{ route('register') }}" id="play-btn">Play Now</a>
                        </div>
                    </div>
                </div>

                <div class="footer justify-content-center">
                    <div class="scroller-item" onclick="$.scrollify.next();">
                        <div class="footer-element">
                            <div class="scroll-downs">
                                <div class="mousey">
                                    <div class="scroller"></div>
                                </div>
                            </div>
                        </div>
                        <div class="footer-element">Scroll to View</div>
                    </div>
                </div>
            </div>
        </section>

        <section id="media" class="panel" data-section-name="media">
            {{--<video class="bg-vid" src="{{ asset('media/video/laughingskull.mp4') }}" type="video/mp4" loop="loop"--}}
            {{--autoplay="autoplay" playsinline="playsinline" muted="muted"></video>--}}

            <div class="container-fluid">
                <div class="row h-100 justify-content-center align-items-center">
                    <div class="col-12 justify-content-center align-items-center d-flex">


                        <div class="carousel">

                            <div>
                                <iframe width="100%" height="100%" src="///www.youtube.com/embed/lQUGQEcDF3o?controls=0"
                                        frameborder="0" allowfullscreen=""></iframe>
                            </div>

                            <div style="width: 100%;height: 100%;">
                                <video src="{{ asset('media/video/andorhal.mp4') }}" type="video/mp4" loop="loop"
                                       autoplay="autoplay" playsinline="playsinline" muted="muted" style="position: relative;"></video>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="distribution" class="panel" data-section-name="distribution">
            {{--<video class="bg-vid" src="{{ asset('media/video/distribution.mp4') }}" type="video/mp4" loop="loop"--}}
            {{--autoplay="autoplay" playsinline="playsinline" muted="muted"></video>--}}

            <div class="container-fluid">
                <div class="row h-100 justify-content-around align-items-center">

                    <div class="col-xl-3 col-lg-3 col-6 col-sm-6 col-md-6 order-lg-first balancediv">
                        <h2 class="faction-title">The Horde</h2>

                        <div class="race-item">
                            <div class="d-flex align-items-center">
                                <img class="race-img ml-0" src="{{ asset('media/icon/class/orc.png') }}"/>
                                <div class="progress race-horde d-flex">
                                    <div class="progress-bar race-bar" role="progressbar" aria-valuenow="70"
                                         aria-valuemin="0"
                                         aria-valuemax="100" style="width:25%">
                                        25%
                                    </div>
                                    <p class="race-title">ORCS</p>
                                </div>
                            </div>
                        </div>

                        <div class="race-item">
                            <div class="d-flex align-items-center">
                                <img class="race-img ml-0" src="{{ asset('media/icon/class/tauren.png') }}"/>
                                <div class="progress race-horde d-flex">
                                    <div class="progress-bar race-bar" role="progressbar" aria-valuenow="70"
                                         aria-valuemin="0"
                                         aria-valuemax="100" style="width:25%">
                                        25%
                                    </div>
                                    <p class="race-title">TAUREN</p>
                                </div>
                            </div>
                        </div>

                        <div class="race-item">
                            <div class="d-flex align-items-center">
                                <img class="race-img ml-0" src="{{ asset('media/icon/class/undead.png') }}"/>
                                <div class="progress race-horde d-flex">
                                    <div class="progress-bar race-bar" role="progressbar" aria-valuenow="70"
                                         aria-valuemin="0"
                                         aria-valuemax="100" style="width:25%">
                                        25%
                                    </div>
                                    <p class="race-title">FORSAKEN</p>
                                </div>
                            </div>
                        </div>

                        <div class="race-item">
                            <div class="d-flex align-items-center">
                                <img class="race-img ml-0" src="{{ asset('media/icon/class/troll.png') }}"/>
                                <div class="progress race-horde d-flex">
                                    <div class="progress-bar race-bar" role="progressbar" aria-valuenow="70"
                                         aria-valuemin="0"
                                         aria-valuemax="100" style="width:25%">
                                        25%
                                    </div>
                                    <p class="race-title">TROLLS</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                            class="col-xl-3 col-lg-3 col-10 col-offset-1 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 order-first order-sm-first order-md-first">
                        <div class="balance">
                            <h2 class="balance-title">Faction Balance</h2>
                            <div class="progress faction">
                                <div class="progress-bar faction-bar" role="progressbar" aria-valuenow="70"
                                     aria-valuemin="0"
                                     aria-valuemax="100" style="width:50%">
                                    50%
                                </div>
                                <p class="progress-secondary">
                                    50%
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-6 col-sm-6 col-md-6 balancediv">
                        <h2 class="faction-title">The Alliance</h2>
                        <div class="race-item">
                            <div class="d-flex align-items-center">
                                <img class="race-img order-lg-first" src="{{ asset('media/icon/class/human.png') }}"/>
                                <div class="progress race-alliance d-flex order-first">
                                    <div class="progress-bar race-bar" role="progressbar" aria-valuenow="70"
                                         aria-valuemin="0"
                                         aria-valuemax="100" style="width:25%">
                                        25%
                                    </div>
                                    <p class="race-title">HUMANS</p>
                                </div>
                            </div>
                        </div>

                        <div class="race-item">
                            <div class="d-flex align-items-center">
                                <img class="race-img order-lg-first" src="{{ asset('media/icon/class/dwarf.png') }}"/>
                                <div class="progress race-alliance d-flex order-first">
                                    <div class="progress-bar race-bar" role="progressbar" aria-valuenow="70"
                                         aria-valuemin="0"
                                         aria-valuemax="100" style="width:25%">
                                        25%
                                    </div>
                                    <p class="race-title">DWARVES</p>
                                </div>
                            </div>
                        </div>

                        <div class="race-item">
                            <div class="d-flex align-items-center">
                                <img class="race-img order-lg-first" src="{{ asset('media/icon/class/gnome.png') }}"/>
                                <div class="progress race-alliance d-flex order-first">
                                    <div class="progress-bar race-bar" role="progressbar" aria-valuenow="70"
                                         aria-valuemin="0"
                                         aria-valuemax="100" style="width:25%">
                                        25%
                                    </div>
                                    <p class="race-title">GNOMES</p>
                                </div>
                            </div>
                        </div>

                        <div class="race-item">
                            <div class="d-flex align-items-center">
                                <img class="race-img order-lg-first"
                                     src="{{ asset('media/icon/class/night-elf.png') }}"/>
                                <div class="progress race-alliance d-flex order-first">
                                    <div class="progress-bar race-bar" role="progressbar" aria-valuenow="70"
                                         aria-valuemin="0"
                                         aria-valuemax="100" style="width:25%">
                                        25%
                                    </div>
                                    <p class="race-title">NIGHT ELVES</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="balance-bot">
                        <h2 class="balance-title">Andorhal</h2>
                        <p>Online Players: 3000</p>
                    </div>


                </div>
            </div>
        </section>

        <section id="realmlist" class="panel" data-section-name="realmlist">
            {{--<video class="bg-vid" src="{{ asset('media/video/Tavern.mp4') }}" type="video/mp4" loop="loop" autoplay="autoplay"--}}
            {{--playsinline="playsinline" muted="muted"></video>--}}

            <div class="container-fluid">
                <div class="row h-100 justify-content-center align-items-center">
                    <div class="col-12">
                        <div class="card-container justify-content-center d-flex">

                    <span data-tilt onclick="window.location.href='{{ asset('docs/andorhal.html') }}'">
                        <div class="asc-card js-tilt" id="test">
                            <div class="card-front">
                                <img src="{{ asset('media/image/index/old_Andorhal.png') }}" class="fc__thumb"/>
                                <div class="card-desc justify-content-center">
                                    <h3>Ascension Realm</h3>
                                    <h4>Andorhal</h4>
                                </div>
                            </div>
                            <div class="card-back">
                                <img src="{{ asset('media/image/index/Seasonal.png') }}" class="fc__thumb"/>
                                <div class="card-desc justify-content-center">
                                    <h3>Ascension Realm</h3>
                                    <h4>Andorhal</h4>
                                </div>
                            </div>
                        </div>
                    </span>

                            <span data-tilt onclick="window.location.href='{{ asset('docs/bloodscalp.html') }}'">
                        <div class="asc-card js-tilt">
                            <img src="{{ asset('media/image/index/old_Bloodscalp.png') }}" class="fc__thumb"/>
                            <div class="card-desc justify-content-center">
                                <h3>Ascension Realm</h3>
                                <h4>Bloodscalp</h4>
                            </div>
                        </div>
                    </span>

                            <span data-tilt onclick="window.location.href='{{ asset('docs/laughing-skull.html') }}'">
                        <div class="asc-card js-tilt">
                            <img src="{{ asset('media/image/index/Laughing Skull.png') }}" class="fc__thumb"/>
                            <div class="card-desc justify-content-center">
                                <h3>Ascension Realm</h3>
                                <h4>Laughing Skull</h4>
                            </div>
                        </div>
                    </span>

                        </div>

                        <div class="tablet-card-container justify-content-center d-flex">
                            <div>
                                <img class="tablet-flip" height="200px" src="{{ asset('media/icon/Tilt.svg') }}">
                                <h1 class="tablet-flip-header">This page is currently under construction.</h1>
                                <h1 class="tablet-flip-header">Tilt your device to view.</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="news" class="panel" data-section-name="news">
            {{--<video class="bg-vid" src="{{ asset('media/video/Ship.mp4') }}" type="video/mp4" loop="loop" autoplay="autoplay"--}}
            {{--playsinline="playsinline" muted="muted"></video>--}}

            <div class="container-fluid">
                <div class="row h-100 justify-content-center align-items-center">
                    <div class="news-container col-12 d-flex justify-content-sm-center">
                        <div class="news-main col-lg-6 col-md-9 col-12 col-sm-8">
                            <div class="news-item-large col-12 col-sm-12 news-pos-target">
                                <img class="asc-default-hover" onclick="fullscreen();"
                                     src="https://pbs.twimg.com/media/DuwF1TFUwAAKkdu.jpg">
                                <!--asc-default-hover-->
                            </div>
                            <div class="news-item-bottom d-flex">
                                <div class="col-12 col-sm-12">
                                    <div class="row d-flex">
                                        <div class="news-item news-main-bl col-lg-6 col-12 col-sm-12">
                                            <img class="asc-default-hover news-pos-target" onclick="fullscreen();"
                                                 src="media/news/Field_Marshal.jpg">
                                        </div>
                                        <div class="news-item news-main-br col-lg-6 col-12 col-sm-12">
                                            <img class="asc-default-hover news-pos-target" onclick="fullscreen();"
                                                 src="media/news/MCAchievements.jpg">
                                        </div>
                                    </div>

                                    <div class="row alt-news d-sm-none">
                                        <div class="d-flex">
                                            <div class="news-item news-main-bl col-6">
                                                <img class="asc-default-hover" onclick="fullscreen();"
                                                     src="media/news/ScepteroftheshiftingSands.jpg">
                                            </div>
                                            <div class="news-item news-main-br col-6">
                                                <img class="asc-default-hover" onclick="fullscreen();"
                                                     src="media/news/Season1.jpg">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="alt-news-large d-sm-none">
                                <div class="news-item-large col-12 news-pos-target" style="margin-bottom: 10px;">
                                    <img class="asc-default-hover" onclick="fullscreen();"
                                         src="media/news/ScepteroftheshiftingSands.jpg">
                                    <!--asc-default-hover-->
                                </div>
                                <div class="news-item-large col-12 news-pos-target">
                                    <img class="asc-default-hover" onclick="fullscreen();" src="media/news/Season1.jpg">
                                    <!--asc-default-hover-->
                                </div>
                            </div>
                        </div>

                        <div class="news-side col-12 d-sm-none">
                            <div class="news-side-item news-spec-top col-12 news-pos-target" id="side-top">
                                <img class="asc-default-hover" onclick="fullscreen();"
                                     src="media/news/ScepteroftheshiftingSands.jpg">
                            </div>
                            <div class="news-side-item col-12 news-pos-target" id="side-mid">
                                <img class="asc-default-hover" onclick="fullscreen();" src="media/news/Season1.jpg">
                            </div>
                            <div class="news-side-item news-spec-bottom col-12 news-pos-target" id="side-bot">
                                <img class="asc-default-hover" onclick="fullscreen();" src="media/news/AQReleased2.jpg">
                            </div>
                        </div>

                        <div class="col-3 d-sm-block" id="twitter-container">
                            <a class="twitter-timeline" data-width="465" data-height="656" data-theme="dark"
                               data-link-color="#ECA659" href="https://twitter.com/Ascensionfeed?ref_src=twsrc%5Etfw">Tweets
                                by
                                Ascensionfeed</a>
                        </div>

                        <div class="col-3 d-sm-none" id="twitter-container-2">
                            <a class="twitter-timeline" data-tweet-limit="1" data-width="465" data-height="656"
                               data-theme="dark" data-link-color="#ECA659"
                               href="https://twitter.com/Ascensionfeed?ref_src=twsrc%5Etfw">Tweets by
                                Ascensionfeed</a>
                        </div>
                    </div>

                    <div class="news-transition">
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('additional_scripts')
    <script src="{{ asset('js/index/index.js') }}"></script>
    <script src="{{ asset('js/index/tilt.js') }}"></script>
    <script src="{{ asset('js/news.js') }}"></script>
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    <script src="{{ asset('js/index/twitter.js') }}"></script>

    <!--
    <script src="https://projects.lukehaas.me/scrollify/script/jquery.scrollify.js"></script>
    <script src="{{ asset('js/index/scroll.js') }}"></script>-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js"
            integrity="sha256-zUQGihTEkA4nkrgfbbAM1f3pxvnWiznBND+TuJoUv3M=" crossorigin="anonymous"></script>


    <script type="text/javascript">
        $(document).ready(function () {
            $('.carousel').slick({
                dots: true,
            });
        });
    </script>
@endsection
