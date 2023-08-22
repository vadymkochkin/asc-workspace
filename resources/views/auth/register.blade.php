@extends('templates.app')

@section('content')
<div id="page-img-container">
    <img id="page-background" src="{{
        asset('media/image/backgrounds/background_13.png')}}">
</div>

<div class="container-flex h-100 d-flex">
    <div class="row justify-content-center w-100">
        <div id="auth-form" class="payment-tab col-xl-3 col-lg-5 col-md-6
            col-sm-8 col-xs-12">
            <article class="card">
                <div class="card-body p-5">
                    <div class="d-flex
                        justify-content-center">
                        <h2>Create Your Account</h2>
                    </div>

                    <br>
                    <form id="register-form" action="{{ route('register') }}"
                        method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="input-group">
                                <div
                                    class="input-group-prepend">
                                    <span
                                        class="input-group-text"><i
                                            class="fa
                                            fa-user"></i></span>
                                </div>
                                <input
                                    type="name"
                                    class="form-control"
                                    id="username"
                                    name="username"
                                    value=""
                                    placeholder="Username"
                                    required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div
                                    class="input-group-prepend">
                                    <span
                                        class="input-group-text"><i
                                            class="fa
                                            fa-user"></i></span>
                                </div>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    value=""
                                    placeholder="Email Address"
                                    required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div
                                    class="input-group-prepend">
                                    <span
                                        class="input-group-text"><i
                                            class="fa
                                            fa-lock"></i></span>
                                </div>
                                <input
                                    class="form-control"
                                    id="password" name="password"
                                    placeholder="Password"
                                    type="password" value="" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div
                                    class="input-group-prepend">
                                    <span
                                        class="input-group-text"><i
                                            class="fa
                                            fa-lock"></i></span>
                                </div>
                                <input
                                    class="form-control"
                                    id="confirmPassword"
                                    name="password_confirmation"
                                    placeholder="Confirm Password"
                                    type="password" value="" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="agreements-box">
                                <div class="form-check">
                                    <input class="form-check-input"
                                        type="checkbox" value=""
                                        id="tosBox">
                                    <label class="form-check-label"
                                        for="tosBox">
                                        <p class="checkText">I have thoroughly
                                            read and agree to the <a
                                                href="{{route('terms-of-service')}}"
                                                style="color:crimson">Terms &
                                                Conditions</a>.<span
                                                style="color:rgb(255, 0, 0);">
                                                *</span></p>
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input"
                                        type="checkbox" value=""
                                        id="privacyBox">
                                    <label class="form-check-label"
                                        for="privacyBox">
                                        <p class="checkText">I am over 18 years
                                            old.<span
                                                style="color:rgb(255, 0, 0);"> *</span></p>
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input"
                                        type="checkbox" value=""
                                        id="newsLetterBox">
                                    <label class="form-check-label"
                                        for="newsLetterBox">
                                        <p class="checkText">I wish to sign up
                                            for
                                            the Ascension newsletter.</p>
                                    </label>
                                </div>
                            </div>
                            @if(config('settings.reCaptchStatus'))
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-4">
                                    <div id="g-captcha" class="g-recaptcha"
                                        data-sitekey="{{ config('settings.reCaptchSite') }}"></div>
                                </div>
                            </div>
                            @endif
                        </div>


                        <div class="row">
                            <!-- INSERT RECAPTCHA HERE-->
                        </div>
                        <br>
                        <button class="btn btn-primary
                            btn-block" type="submit" id="registerBtn" name="registerBtn"> Register </button>
                    </form>
                </div>
            </article>

        </div>
    </div>
</div>
@endsection

@section('additional_scripts')
<script src="{{ asset('js/index/index.js') }}"></script>
<script src="{{ asset('js/auth/anime.js') }}"></script>
<script src="{{ asset('js/auth/register.js') }}"></script>
<script src="{{ asset('js/auth/registration-validation.js') }}"></script>
@if(config('settings.reCaptchStatus'))
<script type="text/javascript">
    var onloadCallback = function () {
        grecaptcha.render('g-captcha', {
            'theme': 'dark'
        });
    };
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async
        defer></script>
@endif
@endsection
