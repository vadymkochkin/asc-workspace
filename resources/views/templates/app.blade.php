<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8" />
  <meta name="robots" content="index, follow" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="keywords"
    content="WoW private server, wow server, Private WoW Server, wow private server, Warmane, Kronos, World of Warcraft Classless, Ascension, best free private server, Awakening, Vanilla, WoW, Custom, Private Server Community, wotlk private server, blizzlike server,  " />
  <meta name="description"
    content="Ascension is a progressive Classless project, starting from Vanilla progressing through the expansions. The realms vary from softcore: just the Vanilla world with Classless systems to hardcore with elements like Hunger, High risk death, and Randomly Enchanted items." />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
  <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
  <meta name="_token" content="{{ csrf_token() }}">
  <meta property="og:title" content="Ascension - World of Warcraft Private Server" />
  <meta property="og:type" content="website" />
  <meta property="og:image" content="{{ asset('favicon.png') }}" />
  <meta property="og:image:secure" content="{{ asset('favicon.png') }}" />
  <meta property="og:description"
    content="Ascension is a progressive Classless project, starting from Vanilla progressing through the expansions. The realms vary from softcore: just the Vanilla world with Classless systems to hardcore with elements like Hunger, High risk death, and Randomly Enchanted items." />
  <meta property="og:locale" content="en_US" />
  <meta property="og:url" content="https://ascension.gg" />
  <meta property="twitter:title" content="Ascension - World of Warcraft Private Server" />
  <meta property="twitter:description"
    content="Ascension is a progressive Classless project, starting from Vanilla progressing through the expansions. The realms vary from softcore: just the Vanilla world with Classless systems to hardcore with elements like Hunger, High risk death, and Randomly Enchanted items." />
  <meta name="twitter:image" content="{{ asset('favicon.png') }}" />
  <!-- Developmnet -->
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />
  <!--Always force latest IE rendering engine (even in intranet) & Chrome Frame-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>@yield('pageTitle') Ascension Classless Realm</title>
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Cinzel|Cinzel+Decorative" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,900&amp;subset=latin-ext"
    rel="stylesheet" />
  <link rel="stylesheet" href="{{ secure_asset(mix('css/app.css')) }}" />
  @yield('additional_headers')
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
        integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous" />
</head>

<body style="overflow: hidden !important;">
  @include('templates.preloader')
  @include('templates.stickyheader')
  <div id="page-wrapper">
    <div id="content-wrapper">
      @yield('content')
    </div>
    @include('templates.footer')
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.5.2/lottie.min.js"></script>
  <script src="{{asset('js/velocity.min.js')}}"></script>
  <script src="{{ asset('js/preloader.js') }}"></script>
  <script src="{{asset('js/background.js')}}"></script>
  <script src="{{ secure_asset('js/sweetalert2.all.min.js') }}"></script>
  {{--<script src="{{ secure_asset('js/sweetalert.min.js') }}"></script>--}}
  <script src="{{ asset('js/stickyheader.js') }}"></script>
  @yield('additional_scripts')
</body>

</html>
