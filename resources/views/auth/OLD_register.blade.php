@extends('templates.app')

@section('additional_headers')
{{--    <link rel="stylesheet" href="{{ secure_asset(mix('css/register.css')) }}"/>--}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
          integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
@endsection

@section('content')
    <div class="hero-video-wrapper">
        <video muted="" autoplay="" loop="" id="tw-video" class="animated" style="">
            <source src="../media/video/bg_vid.mp4" type="video/mp4">
        </video>
    </div>

    <div class="content animated fadeInUp">
        <div class="content-header">
            <h1 class="title-legend">Create Your Account</h1>
            <p class="para-legend">The first steps of your journey begins here.</p>
        </div>


        <form id="register_form" class="" action="{{ route('register') }}" method="POST">
            @csrf
            <fieldset>

                <div class="textField" id="username-box" onclick="pulseObject(this)">
                    <!--Input Valid/Error Here-->
                    <i class="fas fa-user"></i>
                    <input class="crimson-input" id="username" name="username" placeholder="Username" type="name"
                           value=""
                           onblur="validateUsername(this)" required>
                    <i class="fas fa-exclamation-triangle text-input-fa hidden" id="email-error-icon"></i>
                    <i class="fas fa-check text-input-fa-success hidden" id="email-valid-icon"></i>
                </div>
                <p class="error-desc hidden" id="username-error">Username is too short!</a></p>


                <div class="textField" id="email-box" onclick="pulseObject(this)">
                    <!--Input Valid/Error Here-->
                    <i class="fas fa-envelope"></i>
                    <input class="crimson-input" id="email" name="email" placeholder="Email" type="email" value=""
                           onblur="validateEmail(this)" required>
                    <i class="fas fa-exclamation-triangle text-input-fa hidden" id="email-error-icon"></i>
                    <i class="fas fa-check text-input-fa-success hidden" id="email-valid-icon"></i>
                </div>
                <p class="error-desc hidden" id="email-error">Email format invalid! <br> Example: <a
                            href="/cdn-cgi/l/email-protection"
                            class="__cf_email__" data-cfemail="2566574c48564a4b70564057654048444c490b464a48">[email&#160;protected]</a>
                </p>


                <div class="textField" id="password-box" onclick="pulseObject(this)">
                    <!--Input Valid/Error Here-->
                    <i class="fas fa-lock"></i>
                    <input class="crimson-input" id="password" name="password" placeholder="Password" type="password"
                           value="" onblur="validatePassword(this)" required>
                    <i class="fas fa-exclamation-triangle text-input-fa hidden" id="password-error-icon"></i>
                    <i class="fas fa-check text-input-fa-success hidden" id="password-valid-icon"></i>
                </div>
                <p class="error-desc hidden" id="password-error">Password must be at least 6 characters.</p>


                <div class="textField" id="confirmPass-box" onclick="pulseObject(this)">
                    <!--Input Valid/Error Here-->
                    <i class="fas fa-lock"></i>
                    <input class="crimson-input" id="confirmPassword" name="password_confirmation"
                           placeholder="Confirm Password"
                           type="password" value="" onblur="validatePassConfirm(this)" required>
                    <i class="fas fa-exclamation-triangle text-input-fa hidden" id="confirm-error-icon"></i>
                    <i class="fas fa-check text-input-fa-success hidden fadeIn animated faster"
                       id="confirm-valid-icon"></i>
                </div>
                <p class="error-desc hidden" id="confirmPassword-error">Passwords do not match!</p>
                <div class="agreements-box">
                    @if(config('settings.reCaptchStatus'))
                        <div class="form-group">
                            <div class="col-sm-6 col-sm-offset-4">
                                <div id="g-captcha" class="g-recaptcha"
                                     data-sitekey="{{ config('settings.reCaptchSite') }}"></div>
                            </div>
                        </div>
                    @endif
                    <div class="check-box">
                        <!--<input class="" id="tosBox" name="tosBox" type="checkbox" value="y">-->
                        <div class="checkbox-container">
                            <input type="checkbox" value="" id="tosBox" name="" class="checkbox-containerInput"
                                   onclick="validateTos(this);"
                                   required/>
                            <label for="tosBox" class="" id="tosBoxOverlay"
                                   onclick="validateTos(this); pulseObject(this)"></label>
                            <!--Input Valid/Error Here-->
                        </div>
                        <p class="checkText">I have thoroughly read and agree to the <a
                                    href="{{route('terms-of-service')}}"
                                    style="color:crimson">Terms & Conditions</a>.<span style="color:rgb(255, 0, 0);">
                                *</span></p>
                    </div>

                    <div class="check-box">
                        <div class="checkbox-container">
                            <input type="checkbox" value="1" id="privacyBox" name="" class="checkbox-containerInput"
                                   onclick="validatePrivacy(this);" required/>
                            <label for="privacyBox" class="" id="privacyBoxOverlay"
                                   onclick="validatePrivacy(this); pulseObject(this)"></label>
                            <!--Input Valid/Error Here-->
                        </div>
                        <p class="checkText">I am over 18 years old.<span style="color:rgb(255, 0, 0);"> *</span></p>
                    </div>

                    <div class="check-box">
                        <div class="checkbox-container">
                            <input type="checkbox" value="1" id="newsLetterBox" name="" class="checkbox-containerInput"
                                   onclick="validateNewsLetter(this);"/>
                            <label for="newsLetterBox" class="" id="newsLetterBoxOverlay"
                                   onclick="validateNewsLetter(this); pulseObject(this)"></label>
                            <!--Input Valid/Error Here-->
                        </div>
                        <p class="checkText">I wish to sign up for the Ascension newsletter.</p>
                    </div>
                </div>

                <div class="confirm-box" id="registerBox">
                    <div class="btn-container">
                        <input class="animated" id="registerBtn" name="registerBtn" type="submit"
                               onclick="pulseObject(this)">
                    </div>
                </div>

            </fieldset>
            <div class="row socialusepart">
                <div class="col-12 col-lg-10 offset-lg-1 col-xl-8 offset-xl-2">
                    <p class="text-center mb-4">
                        Or Use Social Logins to Register
                    </p>
                    @include('auth.partials.socials')
                </div>
            </div>
        </form>
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
