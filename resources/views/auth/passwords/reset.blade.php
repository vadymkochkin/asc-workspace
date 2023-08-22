@extends('templates.app')

@section('content')
    <div class="hero-video-wrapper">
        <video muted="" autoplay="" loop="" id="tw-video" class="animated" style="">
            <source src="../media/video/bg_vid.mp4" type="video/mp4">
        </video>
    </div>
    <div class="content animated fadeInUp">
        <div class="content-header">
            <h1 class="title-legend">{{ __('Reset Password') }}</h1>
        </div>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form id="register_form" class="" action="{{ route('password.request') }}" method="POST">
            <input type="hidden" name="token" value="{{ $token }}">
            @csrf
            <fieldset>
                <div class="textField" id="email-box" onclick="pulseObject(this)">
                    <!--Input Valid/Error Here-->
                    <i class="fas fa-envelope"></i>
                    <input class="crimson-input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email"
                           name="email" type="email" value="{{ $email or old('email') }}" onblur="validateEmail(this)"
                           required autofocus>
                    <i class="fas fa-exclamation-triangle text-input-fa hidden" id="email-error-icon"></i>
                    <i class="fas fa-check text-input-fa-success hidden" id="email-valid-icon"></i>
                </div>
                @if ($errors->has('email'))
                    <span class="invalid-feedback">
          <strong>{{ $errors->first('email') }}</strong>
        </span>
                @endif
                <p class="error-desc hidden" id="email-error">Email format invalid!
                    <br> Example:
                    <a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                       data-cfemail="2566574c48564a4b70564057654048444c490b464a48">[email&#160;protected]
                    </a>
                </p>
                <div class="textField" id="password-box" onclick="pulseObject(this)">
                    <!--Input Valid/Error Here-->
                    <i class="fas fa-lock"></i>
                    <input class="crimson-input form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                           id="password" name="password" placeholder="{{ __('Password') }}" type="password"
                           onblur="validatePassword(this)" required>
                    <i class="fas fa-exclamation-triangle text-input-fa hidden" id="password-error-icon"></i>
                    <i class="fas fa-check text-input-fa-success hidden" id="password-valid-icon"></i>
                </div>
                @if ($errors->has('password'))
                    <span class="invalid-feedback">
          <strong>{{ $errors->first('password') }}</strong>
        </span>
                @endif
                <p class="error-desc hidden" id="password-error">Password must be at least 6 characters.</p>
                <div class="textField" id="confirmPass-box" onclick="pulseObject(this)">
                    <!--Input Valid/Error Here-->
                    <i class="fas fa-lock"></i>
                    <input class="crimson-input form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                           id="confirmPassword" name="password_confirmation" placeholder="Confirm Password"
                           type="password" value="" onblur="validatePassConfirm(this)" required>
                    <i class="fas fa-exclamation-triangle text-input-fa hidden" id="confirm-error-icon"></i>
                    <i class="fas fa-check text-input-fa-success hidden fadeIn animated faster"
                       id="confirm-valid-icon"></i>
                </div>
                @if ($errors->has('password_confirmation'))
                    <span class="invalid-feedback">
          <strong>{{ $errors->first('password_confirmation') }}</strong>
        </span>
                @endif
                <p class="error-desc hidden" id="confirmPassword-error">Passwords do not match!</p>
                <div class="confirm-box" id="registerBox">
                    <div class="btn-container">
                        <input class="animated" id="registerBtn" value="{{ __('Reset Password') }}" type="submit"
                               onclick="pulseObject(this)">
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
@endsection
