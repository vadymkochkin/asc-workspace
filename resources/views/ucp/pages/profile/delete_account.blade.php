@extends('ucp.templates.app')

@section('pageTitle', "Delete Account")

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
                                        <i class="material-icons">delete</i>
                                        <h5>Delete Account</h5>

                                    </div>

                                    <div class="block-body">
                                        <div class="body-inner-title">
                                            <p><strong>Deleting</strong> your account is
                                                <u><strong>permanent</strong></u> and <u><strong>cannot</strong></u> be
                                                undone.</p>
                                        </div>

                                        {!! Form::model($user, array('action' => array('ProfilesController@deleteUserAccount', $user->id), 'method' => 'DELETE')) !!}
                                        <div class="block-form">
                                            <fieldset>
                                                <div class="form-group mt-2">
                                                    <input type="checkbox" name='checkConfirmDelete'
                                                           style="height:auto">
                                                    <label class="form-label">Confirm Account Deletion</label>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Password</label>
                                                    <input type="password" placeholder="Current Password"
                                                           class="form-control" name="password">
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" value="Delete My Account"
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
