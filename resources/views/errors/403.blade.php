@extends('templates.app')

@section('pageTitle', "403: Forbidden - ")

@section('additional_headers')
    <link rel="stylesheet" href="{{ secure_asset(mix('css/error.css')) }}"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection

@section('content')
    <div class="maincontainer">
        <div class="content vertical-center">
            <div>
                <h1>403: Forbidden.</h1>
                <p>You are not attuned to visit this area yet.</p>
                <div class="load-container">
                    <div id="load-button" onclick="history.go(-1);">
                        TELEPORT TO SAFEZONE
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional_scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('js/news/news-scroll.js') }}"></script>
    <script>
        AOS.init();
    </script>
@endsection