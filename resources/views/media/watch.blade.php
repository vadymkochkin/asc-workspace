@extends('templates.app')

@section('additional_headers')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection

@section('content')

    <section id="watch" class="panel" data-section-name="watch">
        <video class="bg-vid" src="{{ asset('media/video/Tavern.mp4') }}" type="video/mp4" loop="loop"
               autoplay="autoplay"
               playsinline="playsinline" muted="muted"></video>

        <div class="container-fluid">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-12 justify-content-center align-items-center d-flex">

                    <div class="watch-container">
                        <div class="d-flex w-100 justify-content-center">
                            <div class="carousel-featured">
                                <div>
                                    <h1 class="carousel-header">Featured Twitch Stream</h1>
                                    <iframe src="https://player.twitch.tv/?channel=blizzard&muted=true" height="100%"
                                            width="100%" frameborder="0" scrolling="no" allowfullscreen="true">
                                    </iframe>
                                </div>

                                <div>
                                    <h1 class="carousel-header">Featured YouTube Stream</h1>
                                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/OubZ_Z0yUV4"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen></iframe>
                                </div>

                                <div>
                                    <h1 class="carousel-header">Featured Video</h1>
                                    <iframe width="100%" height="100%"
                                            src="///www.youtube.com/embed/lQUGQEcDF3o?controls=0"
                                            frameborder="0" allowfullscreen="">
                                    </iframe>
                                </div>
                            </div>
                        </div>

                        <div class="line-container">
                            <hr>
                        </div>

                        <h1 class="carousel-title">Live Streams</h1>

                        <div class="d-flex w-100 justify-content-center">
                            <div class="carousel-live">

                                <div>
                                    <iframe src="https://player.twitch.tv/?channel=blizzard&muted=true" height="100%"
                                            width="100%" frameborder="0" scrolling="no" allowfullscreen="true">
                                    </iframe>
                                </div>

                                <div>
                                    <iframe src="https://player.twitch.tv/?channel=blizzard&muted=true" height="100%"
                                            width="100%" frameborder="0" scrolling="no" allowfullscreen="true">
                                    </iframe>
                                </div>

                                <div>
                                    <iframe src="https://player.twitch.tv/?channel=blizzard&muted=true" height="100%"
                                            width="100%" frameborder="0" scrolling="no" allowfullscreen="true">
                                    </iframe>
                                </div>

                                <div>
                                    <iframe src="https://player.twitch.tv/?channel=blizzard&muted=true" height="100%"
                                            width="100%" frameborder="0" scrolling="no" allowfullscreen="true">
                                    </iframe>
                                </div>

                            </div>
                        </div>


                        <div class="line-container">
                            <hr>
                        </div>

                        <h1 class="carousel-title">Featured Videos</h1>

                        <div class="d-flex w-100 justify-content-center">
                            <div class="carousel-feat-vid">
                                <div>
                                    <iframe width="100%" height="100%" src="///www.youtube.com/embed/_hnhyspEp3Q"
                                            frameborder="0" allowfullscreen="">
                                    </iframe>
                                    <h1 class="carousel-subtitle">Clever Video Title Here</h1>
                                </div>

                                <div>
                                    <iframe width="100%" height="100%" src="///www.youtube.com/embed/YKTO8_oP1zM"
                                            frameborder="0" allowfullscreen="">
                                    </iframe>
                                    <h1 class="carousel-subtitle">Clever Video Title Here</h1>
                                </div>
                            </div>
                        </div>

                        <div class="line-container">
                            <hr>
                        </div>

                        <h1 class="carousel-title">State of Ascension Devlogs</h1>

                        <div class="d-flex w-100 justify-content-center">
                            <div class="carousel-live">

                                <div>
                                    <iframe width="100%" height="100%"
                                            src="///www.youtube.com/embed/-m0_Cj_Ik2c?showinfo=0&controls=0"
                                            frameborder="0"
                                            allowfullscreen="">
                                    </iframe>
                                </div>

                                <div>
                                    <iframe width="100%" height="100%"
                                            src="///www.youtube.com/embed/3pFPfOOe824?showinfo=0&controls=0"
                                            frameborder="0"
                                            allowfullscreen="">
                                    </iframe>
                                </div>

                                <div>
                                    <iframe width="100%" height="100%"
                                            src="///www.youtube.com/embed/0ZUacw1xPQI?controls=0"
                                            frameborder="0" allowfullscreen="">
                                    </iframe>
                                </div>

                                <div>
                                    <iframe width="100%" height="100%"
                                            src="///www.youtube.com/embed/L46TxL2oaNk?showinfo=0&controls=0"
                                            frameborder="0"
                                            allowfullscreen="">
                                    </iframe>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection

@section('additional_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js"
            integrity="sha256-zUQGihTEkA4nkrgfbbAM1f3pxvnWiznBND+TuJoUv3M=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.carousel-featured').slick({
                dots: true,
            });

            $('.carousel-live').slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 4
            });

            $('.carousel-feat-vid').slick({
                infinite: true,
                slidesToShow: 2,
                slidesToScroll: 2
            });
        });
    </script>
@endsection