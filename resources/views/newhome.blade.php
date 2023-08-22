@extends('templates.apphome')

@section('content')
<section id="home">
    <section id="home-landing">
        <video class="bg-vid" src="{{ asset('media/video/web_bg_new_9.mp4') }}" type="video/mp4" loop="loop"
            autoplay="autoplay" playsinline="playsinline" muted="muted"></video>
        <div class="hero-container d-flex justify-content-between h-100">
            <div class="row mx-auto"></div>
            <div class="row mx-auto align-self-center">
                <div class="hero-content justify-content-center text-center d-flex">
                    <!--
                            <h2 class="hero-title">World of Warcraft</h2>
                            <h1 class="hero-main">CLASSLESS</h1>
                            -->
                    <h2 class="hero-title">World of Warcraft</h2>
                    <h1 class="hero-main">CLASSLESS</h1>
                    <div class="trailer-container d-flex text-center" style="justify-content: space-evenly !important">
                        <div class="trailer-item">
                            <a href="#">
                                <img src="{{ asset('media/icon/download_cloud.svg') }}" type="svg" height="50px">
                                <span class="text-weight-bold">DOWNLOAD CLIENT</span>
                            </a>
                        </div>

                        <div class="trailer-item">
                            <a href="#">
                                <img src="{{ asset('media/icon/play_button_solid.svg') }}" type="svg" height="40px">
                                <span class="text-weight-bold">CINEMATIC TRAILER</span>
                            </a>
                        </div>
                    </div>

                    <!--
                            <div class="trailer-container d-flex">
                                <div class="trailer-item" style="margin-right: 10%">
                                    <a href="#">
                                        <i class="fas fa-play-circle"></i>
                                        <span>GAMEPLAY OVERVIEW</span>
            
                                    </a>
                                </div>
            
                                <div class="trailer-item">
                                    <a href="#">
                                        <i class="fas fa-play-circle"></i>
                                        <span>CINEMATIC TRAILER</span>
            
                                    </a>
                                </div>
                            </div>
                            <button class="btn-primary btn">
                                PLAY NOW
                            </button>
                            -->
                </div>
            </div>


            <div class="row mx-auto">
                <div class="hero-footer align-self-end text-center">
                    <a href="#">
                        <span class="hf-category">SEASON IV REALM:</span>
                        <h5 class="hf-main">DARKMOON</h5>
                        <span href="#" class="hf-subtitle">AVAILABLE NOW</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="bottom-fade"></div>
    </section>

    <section id="home-transition-1" class="d-flex justify-content-center">
        <div
            class="transition-content d-flex w-100 h-100 text-center justify-content-center col-xl-4 col-lg-6 col-md-8 col-12">
            <div>
                <h1 class="align-self-center">EXPERIENCE CLASSLESS</h1>
                <p class="align-self-center">Ascension is a Classless WoW Server. Choose any Abilities and Talents
                    and Progress through the World
                    of Warcraft expansions.</p>
            </div>
        </div>
    </section>

    <section id="temp-2" class="d-flex justify-content-center">
        <div class="half-wrapper col-xl-10 w-100 h-100 d-flex justify-content-end">
            <div class="half-container col-lg-6 h-100 d-flex justify-content-center">
                <div class="half-inner">
                    <h1 class="half-title">Experience Classless</h1>
                    <p class="half-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus
                        congue, tellus convallis dapibus faucibus, lorem leo tristique est, non facilisis ipsum tortor
                        efficitur orci. Curabitur sit amet lectus molestie, rutrum leo porta, porttitor libero.</p>
                    <button class="btn-primary btn">
                        PLAY NOW
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section id="temp-3" class="d-flex justify-content-center">
        <div class="half-wrapper col-xl-10 w-100 h-100 d-flex">
            <div class="half-container col-lg-6 h-100 d-flex justify-content-center">
                <div class="half-inner">
                    <h1 class="half-title">Experience Classless</h1>
                    <p class="half-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus
                        congue, tellus convallis dapibus faucibus, lorem leo tristique est, non facilisis ipsum tortor
                        efficitur orci. Curabitur sit amet lectus molestie, rutrum leo porta, porttitor libero.</p>
                    <button class="btn-primary btn">
                        PLAY NOW
                    </button>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection
@section('additional_scripts')
@endsection