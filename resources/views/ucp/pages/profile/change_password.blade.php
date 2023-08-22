@extends('ucp.templates.app')

@section('pageTitle', "Change Password")

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
                <div class="content-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="block-content">
                                <div class="block-inner">
                                    <div class="block-title">
                                        <i class="material-icons">supervisor_account</i>
                                        <h5>Change Password</h5>

                                    </div>

                                    <div class="block-body">
                                        <div class="body-inner-title">
                                            <p>You can utilize the form below to change the password of your
                                                account.</p>
                                        </div>

                                        {!! Form::model($user, array('action' => array('ProfilesController@updateUserPassword', $user->id), 'method' => 'PUT', 'autocomplete' => 'new-password')) !!}
                                        <div class="block-form">
                                            <fieldset>
                                                <div class="form-group">
                                                    <label class="form-label">Current Password</label>
                                                    <input type="password" placeholder="Current Password"
                                                           class="form-control" id="currPass" name="current_password">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">New Password</label>
                                                    <input type="password" placeholder="New Password"
                                                           class="form-control" id="newPass" name="password">
                                                    <p class="error-desc hidden" id="password-error-submit">Password is invalid.</p>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Confirm Password</label>
                                                    <input type="password" placeholder="Confirm Password"
                                                           class="form-control" id="confirmPass"
                                                           name="password_confirmation">
                                                    <p class="error-desc hidden" id="password-incorrect">Confirm Password is Incorrect.</p>
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" value="Change password"
                                                           class="btn btn-primary change-password-submit">
                                                </div>
                                            </fieldset>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('additional_scripts')
    <script src="{{ asset('js/auth/registration-validation.js') }}"></script>
@endsection

