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
                    <h1 class="title-legend">{{ __('Reset Password') }}</h1>
                    <p class="para-legend">Let's begin the password reset process</p>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <form id="register_form" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <fieldset>
                        <div class="textField" id="username-box" onclick="pulseObject(this)">
                            <!--Input Valid/Error Here-->
                            <i class="fas fa-user"></i>
                            <input class="crimson-input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   id="username" name="email" placeholder="{{ __('E-Mail Address') }}" type="text"
                                   value="{{ old('email') }}" onblur="validateUsername(this)" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
                            @endif
                            <i class="fas fa-exclamation-triangle text-input-fa hidden" id="email-error-icon"></i>
                            <i class="fas fa-check text-input-fa-success hidden" id="email-valid-icon"></i>
                        </div>
                        <p class="error-desc hidden" id="username-error">Username is too short!</a></p>
                        <p class="error-desc hidden" id="email-error">Email format invalid! <br> Example:
                            user@email.com</a></p>
                        <p class="error-desc hidden" id="email-error-submit">Email does not exist!</p>
                        <div class="confirm-box" id="registerBox">
                            <div class="btn-container">
                                <input class="animated cursor-click" id="registerBtn" name="registerBtn" type="submit"
                                       onclick="pulseObject(this)" value="{{ __('Send Reset Link') }}">
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                              <strong>{{ $errors->first('email') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
