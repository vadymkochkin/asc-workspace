@extends('templates.app')

@section('pageTitle', "503: Be Right Back - ")

@section('additional_headers')
    <link rel="stylesheet" href="{{ secure_asset(mix('css/error.css')) }}"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection

@section('content')
    <div class="maincontainer">
        <div class="content vertical-center">
            <div>
                <h1>503: Be Right Back</h1>
                <p>The healer went AFK to order pizza.</p>
                <div class="load-container">
                    <div id="load-button" onclick="history.go(-1);">
                        FIND A NEW HEALER
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