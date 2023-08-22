@extends('templates.app')

@section('additional_headers')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
          integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
@endsection

@section('content')
    <div class="content" id="login">
        <div class="inner-content">
            <div class="hero-video-wrapper">
                <video muted="" autoplay="" loop="" id="tw-video" class="animated" style="">
                    <source src="../media/video/bg_vid.mp4" type="video/mp4">
                </video>
            </div>
            <div id="center-middle">
                <div class="content-header">
                    <h1 class="title-legend">Adventurer Login</h1>
                    <p class="para-legend">Manage account information and more!</p>
                </div>
                <form id="register_form" action="{{ route('login') }}" method="POST">
                    @csrf
                    <fieldset>
                        <div class="textField" id="username-box" onclick="pulseObject(this)">
                            <!--Input Valid/Error Here-->
                            <i class="fas fa-user"></i>
                            <input class="crimson-input" id="username" name="email" placeholder="Email or Username"
                                   type="text" value="" onblur="validateUsername(this)" required>
                            <i class="fas fa-exclamation-triangle text-input-fa hidden" id="email-error-icon"></i>
                            <i class="fas fa-check text-input-fa-success hidden" id="email-valid-icon"></i>
                        </div>
                        <p class="error-desc hidden" id="username-error">Username is too short!</a></p>
                        <p class="error-desc hidden" id="email-error">Email format invalid! <br> Example:
                            user@email.com</a></p>
                        <p class="error-desc hidden" id="email-error-submit">Email does not exist!</p>
                        <div class="textField" id="password-box" onclick="pulseObject(this)">
                            <!--Input Valid/Error Here-->
                            <i class="fas fa-lock"></i>
                            <input class="crimson-input auto-save" id="password" name="password" placeholder="Password"
                                   type="password" value="" required>
                            <i class="fas fa-exclamation-triangle text-input-fa hidden" id="password-error-icon"></i>
                            <i class="fas fa-check text-input-fa-success hidden" id="password-valid-icon"></i>
                        </div>
                        <p class="error-desc hidden" id="password-error">Password does not meet the requirements!</p>
                        <p class="error-desc hidden" id="password-error-submit">Password is invalid.</p>
                        <div class="agreements-box">
                            <div class="check-box">
                                <!--<input class="" id="tosBox" name="tosBox" type="checkbox" value="y">-->
                                <div class="checkbox-container">
                                    <input type="checkbox" value="" id="tosBox" name="rememberMe"
                                           class="checkbox-containerInput auto-save"
                                           onclick=""/> <!--  -->
                                    <label for="tosBox" class="" id="tosBoxOverlay"></label>
                                    <!--Input Valid/Error Here-->
                                </div>
                                <p class="checkText">Remember me!</p>
                                <p class="checkDesc">Stores your account information locally for easier access.</p>
                            </div>
                        </div>
                        <div class="confirm-box" id="registerBox">
                            <div class="btn-container">
                                <input class="animated cursor-click" id="registerBtn" name="registerBtn" type="submit"
                                       onclick="pulseObject(this)" value="Log into Account">
                            </div>
                        </div>
                        <div class="forgot">
                            <a href="{{ route('password.request') }}" class="forgot-pass" target="_onBlank">Forgot
                                Password</a>
                            <a class="forgot-divider" target="_onBlank">|</a>
                            <a href="{{ url('/register') }}" class="forgot-acc">Create an Account</a>
                        </div>
                    </fieldset>
                    <p class="text-center mb-3 mt-2">
                        Or Login with
                    </p>
                    @include('auth.partials.socials-icons')
                </form>
            </div>
        </div>
    </div>
@endsection

@section('additional_scripts')
    <script src="{{ asset('js/index/index.js') }}"></script>
    <script src="{{ asset('js/auth/anime.js') }}"></script>
    <script src="{{ asset('js/auth/register.js') }}"></script>
    <script src="{{ asset('js/auth/registration-validation.js') }}"></script>
@endsection
