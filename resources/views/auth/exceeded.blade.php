@extends('templates.app')

@section('template_title')
    {!! trans('titles.exceeded') !!}
@endsection

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

@section('content')
    <div class="content animated fadeInUp">
        <div class="content-header text-center">
            <h1 class="title-legend">{!! trans('titles.exceeded') !!}</h1>
            <p>{!! trans('auth.tooManyEmails', ['email' => $email, 'hours' => $hours]) !!}</p>
        </div>
    </div>
@endsection
