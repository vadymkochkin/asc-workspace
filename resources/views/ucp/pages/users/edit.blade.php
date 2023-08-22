@extends('ucp.templates.app')
@section('additional_headers')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
          integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
@endsection
@section('content')
    <div class="content-wrapper wrapper-default">
        <div class="content-header">
            <div class="container-fluid">
                <p>Edit Account</p>
            </div>
        </div>
        <div class="container-fluid">
            <div class="content-nav">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active-page noselect">edit Account</li>
                </ul>
            </div>
        </div>
        Name: {{$user}}
    </div>
@endsection
