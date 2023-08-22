@extends('templates.app') @section('content')
<div id="page-img-container">
    <img id="page-background" src="{{ asset('media/image/backgrounds/background_5.png')}}">
</div>
<section id="contactboard">
    <div class="container justify-content-center align-items-center
        text-center">
        <div class="support-header">
            <h1 class="">Contact Us</h1>
            <h2 class="">Get in touch and let us know how we can help.</h2>
        </div>

        <div class="selection">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-lg-4 col-12 d-flex justify-content-center">
                    <a class="item-anchor" href="{{ route('contact') }}" id="item-1">
                        <div class="item-inner">
                            <div class="item-icon sale-icon">
                            </div>
                            <h2 class="item-title">Sales</h2>
                            <p class="item-desc">
                                We’d love to talk about how we can work
                                together.
                            </p>
                        </div>
                        <div class="item-footer">
                            <span href="#">Contact sales</span>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-12 d-flex justify-content-center">
                    <a class="item-anchor" href="{{ route('contact') }}" id="item-2">
                        <div class="item-inner">
                            <div class="item-icon support-icon">
                            </div>
                            <h2 class="item-title">Support Tickets</h2>
                            <p class="item-desc">
                                We're here to help with solving any issues you
                                might encounter.
                            </p>
                        </div>
                        <div class="item-footer">
                            <span href="#">Get Support</span>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-12 d-flex justify-content-center">
                    <a class="item-anchor" href="{{ route('contact') }}" id="item-3">
                        <div class="item-inner">
                            <div class="item-icon press-icon">
                            </div>
                            <h2 class="item-title">Media & Press</h2>
                            <p class="item-desc">
                                Download the official Ascension Press Kit for
                                creator use.
                            </p>
                        </div>
                        <div class="item-footer">
                            <span href="#">Download Press Kit</span>
                        </div>
                    </a>
                </div>
            </div>

            <div class="sub-items">
                <div class="row d-flex align-items-center
                    justify-content-center">
                    <div class="col-lg-5 col-12 d-flex justify-content-center">
                        <div class="sub-container right-separator">
                            <h2>Join us on Discord</h2>
                            <p>If you have general questions, chat live with
                                developers
                                and support staff in our <a href="https://discord.gg/bEfV3M5">Discord</a>.</p>
                        </div>
                    </div>

                    <div class="sub-separator hidden-sm-down">

                    </div>

                    <div class="col-lg-5 col-12 d-flex justify-content-center">
                        <div class="sub-container">
                            <h2>Other inqueries</h2>
                            <p>For legal inqueries, please direct all concerns towards &nbsp; <a href="mailto:legal@ascension.gg">legal@ascension.gg</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 
@section('additional_scripts')
<script src="{{asset('js/support-hub.js') }}"></script>
<script>
  $(document).ready(function() {
    $(".searchinput").keyup(function(e) {
      var keyword = $(this).val();
      if (e.keyCode == 13) {
        window.location.replace("/faq?q=" + keyword);
      }
    });
    $("#back-button").click(function() {
      window.location.replace("/faq");
    });
  });
</script>
@endsection
