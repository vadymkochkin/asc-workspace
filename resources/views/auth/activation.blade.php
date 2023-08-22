@extends('templates.app')

@section('additional_headers')
    <style>
        #page-wrapper{
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 100vh;
        }
        #content-wrapper{
            padding-top: 0px!important;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            justify-content: center;
            min-height: 0px!important;
        }
    </style>
@endsection

@section('template_title')
    {{ trans('titles.activation') }}
@endsection

@section('content')
    {{--<div class="hero-video-wrapper">--}}
        {{--<video muted="" autoplay="" loop="" id="tw-video" class="animated" style="">--}}
            {{--<source src="../media/video/bg_vid.mp4" type="video/mp4">--}}
        {{--</video>--}}
    {{--</div>--}}
    <div class="content animated fadeInUp">
        <div class="content-header text-center">
            <h1 class="title-legend">{{ trans('auth.regThanks') }}</h1>
            <p class="para-legend">{{ trans('titles.activation') }}</p>
            <p class="para-legend">{{ trans('auth.anEmailWasSent',['email' => $email, 'date' => $date ] ) }}</p>
            <p class="para-legend">{{ trans('auth.clickInEmail') }}</p>
            <p><a href='{{url("activation")}}' class="forgot-pass">{{ trans('auth.clickHereResend') }}</a></p>
        </div>
    </div>
@endsection