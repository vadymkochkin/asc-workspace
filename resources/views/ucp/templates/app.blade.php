<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta http-equiv="Cache-Control" content="no-cache, no-store,must-revalidate"/>
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta http-equiv="Expires" content="0"/>
    <meta charset="utf-8">
    <meta name="robots" content="noindex"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="Ascension">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <title>@yield('pageTitle')</title>
    <link href="https://fonts.googleapis.com/css?family=Marcellus" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="{{ secure_asset(mix('css/app.css')) }}" />
    @yield('additional_headers')
  </head>
  <body class="@yield('body_class') ucp">
    @include('templates.stickyheader')
    @yield('overlay')
    <div class="d-flex align-items-stretch temp-fix-for-header" style="margin-top: 10rem;">
      @include('ucp.templates.templatesidebar')
      @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!--<script src="{{ secure_asset('js/staticheader.js') }}"></script>-->
    <script src="{{ asset('js/stickyheader.js') }}"></script>
    <script src="{{ secure_asset('js/sweetalert2.all.min.js') }}"></script>
    @yield('additional_scripts')
  </body>
</html>
