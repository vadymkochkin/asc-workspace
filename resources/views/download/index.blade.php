@extends('templates.app')

@section('content')
<div id="page-img-container">
    <img id="page-background" src="{{ asset('media/image/backgrounds/background_28.png')}}">
</div>

<section id="download-page">
    <div class="container d-flex justify-content-center align-items-center
        text-center">
        <div class="content animated fadeInUp download-container">
            <div class="content-header text-center">
                <h1 class="thankstitle mb-5">{{ trans("titles.thanksDownload") }}</h1>
                <p class="para-legend">If your download failed to start, try again.</p>
                <p class="downloadfor">Download for:</p>
                <div class="row typebtn_row">
                    <a class="typebtn win" href="/api/download?platform=win" download>
                        <i class="fab fa-windows"></i>
                    </a>
                    <a class="typebtn mac" href="#">
                        <i class="fab fa-apple"></i>
                    </a>
                    <a class="typebtn linux" href="#">
                        <i class="fab fa-linux"></i>
                    </a>
                </div>
                <a class="return-link" href="{{ route('home') }}">Return to Ascension</a>
            </div>
        </div>
    </div>
</section>

@endsection @section('additional_scripts')
<script>
    $(document).ready(function () {
        setTimeout(function () {
            let isMac = navigator.platform.toUpperCase().indexOf("MAC") >= 0;
            let isWin = navigator.platform.toUpperCase().indexOf("WIN") >= 0;
            let isIOS = /(iPhone|iPod|iPad)/i.test(navigator.platform);
            console.log(isMac, isWin, isIOS);
            if (isMac) {
                //$(".mac")[0].click();
                // TODO: Display modal showing incompatability with chosen platform.
            } else if (isWin) {
                $(".win")[0].click();
            } else {
                //$(".linux")[0].click();
                // TODO: Display modal showing incompatability with chosen platform.
            }
        }, 1500);
    });
</script>
@endsection