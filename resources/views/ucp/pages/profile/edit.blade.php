@extends('ucp.templates.app')

@section('pageTitle', "Edit Profile")

@section('template_title')
    {{ trans('profile.templateTitle') }}
@endsection

@section('additional_headers')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
          integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
@endsection

@section('content')
    <div class="content-wrapper wrapper-default">
        <section>
            <div class="container-fluid">
                <div class="content-inner">
                    <div class="content-body">
                        <div class="content-title">
                            <h5>Edit Info</h5>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                @if ($user->profile)
                                    @if (Auth::user()->id == $user->id)
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="tab-content" id="v-pills-tabContent">
                                                        <div class="tab-pane fade show active edit-profile-tab"
                                                             role="tabpanel" aria-labelledby="edit-profile-tab">
                                                            {!! Form::model($user->profile, ['method' => 'PATCH', 'route' => ['profile.update', $user->username], 'id' => 'user_profile_form', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
                                                            {{ csrf_field() }}
                                                            <div class="form-group has-feedback {{ $errors->has('bio') ? ' has-error ' : '' }}">
                                                                {!! Form::label('bio', trans('profile.label-bio') , array('class' => 'col-12 control-label')); !!}
                                                                <div class="col-12">
                                                                    {!! Form::textarea('bio', old('bio'), array('id' => 'bio', 'class' => 'col-12', 'placeholder' => trans('profile.ph-bio'))) !!}
                                                                    <span class="glyphicon glyphicon-pencil form-control-feedback"
                                                                          aria-hidden="true"></span>
                                                                    @if ($errors->has('bio'))
                                                                        <span class="help-block">
                                                                    <strong>{{ $errors->first('bio') }}</strong>
                                                                </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group has-feedback {{ $errors->has('twitter_username') ? ' has-error ' : '' }}">
                                                                {!! Form::label('twitter_username', trans('profile.label-twitter_username') , array('class' => 'col-12 control-label')); !!}
                                                                <div class="col-12">
                                                                    {!! Form::text('twitter_username', old('twitter_username'), array('id' => 'twitter_username', 'class' => 'form-control', 'placeholder' => trans('profile.ph-twitter_username'))) !!}
                                                                    <span class="glyphicon glyphicon-pencil form-control-feedback"
                                                                          aria-hidden="true"></span>
                                                                    @if ($errors->has('twitter_username'))
                                                                        <span class="help-block">
                                                                    <strong>{{ $errors->first('twitter_username') }}</strong>
                                                                </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="margin-bottom-2 form-group has-feedback {{ $errors->has('github_username') ? ' has-error ' : '' }}">
                                                                {!! Form::label('github_username', trans('profile.label-github_username') , array('class' => 'col-12 control-label')); !!}
                                                                <div class="col-12">
                                                                    {!! Form::text('github_username', old('github_username'), array('id' => 'github_username', 'class' => 'form-control', 'placeholder' => trans('profile.ph-github_username'))) !!}
                                                                    <span class="glyphicon glyphicon-pencil form-control-feedback"
                                                                          aria-hidden="true"></span>
                                                                    @if ($errors->has('github_username'))
                                                                        <span class="help-block">
                                                                    <strong>{{ $errors->first('github_username') }}</strong>
                                                                </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group margin-bottom-2">
                                                                <div class="col-12">
                                                                    <input type="submit" value="Update My Info"
                                                                           class="btn btn-primary change-password-submit">
                                                                </div>
                                                            </div>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <p>{{ trans('profile.notYourProfile') }}</p>
                                    @endif
                                @else
                                    <p>{{ trans('profile.noProfileYet') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('ucp.pages.profile.partials.modal-form')

@endsection

@section('footer_scripts')

    @include('ucp.pages.profile.partials.form-modal-script')

    @if(config('settings.googleMapsAPIStatus'))
        @include('ucp.pages.profile.partials.gmaps-address-lookup-api3')
    @endif

    @include('ucp.pages.profile.partials.user-avatar-dz')

    <script type="text/javascript">
        $('.dropdown-menu li a').click(function () {
            $('.dropdown-menu li').removeClass('active');
        });
        $('.profile-trigger').click(function () {
            $('.panel').alterClass('card-*', 'card-default');
        });
        $('.settings-trigger').click(function () {
            $('.panel').alterClass('card-*', 'card-info');
        });
        $('.admin-trigger').click(function () {
            $('.panel').alterClass('card-*', 'card-warning');
            $('.edit_account .nav-pills li, .edit_account .tab-pane').removeClass('active');
            $('#changepw')
                .addClass('active')
                .addClass('in');
            $('.change-pw').addClass('active');
        });
        $('.warning-pill-trigger').click(function () {
            $('.panel').alterClass('card-*', 'card-warning');
        });
        $('.danger-pill-trigger').click(function () {
            $('.panel').alterClass('card-*', 'card-danger');
        });
        $('#user_basics_form').on('keyup change', 'input, select, textarea', function () {
            $('#account_save_trigger').attr('disabled', false).removeClass('disabled').show();
        });
        $('#user_profile_form').on('keyup change', 'input, select, textarea', function () {
            $('#confirmFormSave').attr('disabled', false).removeClass('disabled').show();
        });
        $('#checkConfirmDelete').change(function () {
            var submitDelete = $('#delete_account_trigger');
            var self = $(this);
            if (self.is(':checked')) {
                submitDelete.attr('disabled', false);
            } else {
                submitDelete.attr('disabled', true);
            }
        });
        $("#password_confirmation").keyup(function () {
            checkPasswordMatch();
        });
        $("#password, #password_confirmation").keyup(function () {
            enableSubmitPWCheck();
        });
        $('#password, #password_confirmation').hidePassword(true);
        $('#password').password({
            shortPass: 'The password is too short',
            badPass: 'Weak - Try combining letters & numbers',
            goodPass: 'Medium - Try using special charecters',
            strongPass: 'Strong password',
            containsUsername: 'The password contains the username',
            enterPass: false,
            showPercent: false,
            showText: true,
            animate: true,
            animateSpeed: 50,
            username: false, // select the username field (selector or jQuery instance) for better password checks
            usernamePartialMatch: true,
            minimumLength: 6
        });

        function checkPasswordMatch() {
            var password = $("#password").val();
            var confirmPassword = $("#password_confirmation").val();
            if (password != confirmPassword) {
                $("#pw_status").html("Passwords do not match!");
            } else {
                $("#pw_status").html("Passwords match.");
            }
        }

        function enableSubmitPWCheck() {
            var password = $("#password").val();
            var confirmPassword = $("#password_confirmation").val();
            var submitChange = $('#pw_save_trigger');
            if (password != confirmPassword) {
                submitChange.attr('disabled', true);
            } else {
                submitChange.attr('disabled', false);
            }
        }
    </script>

@endsection
