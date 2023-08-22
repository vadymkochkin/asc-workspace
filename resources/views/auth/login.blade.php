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
                        <h2>Adventurer Login</h2>
                    </div>

                    <br>
                    <form id="login-form" action="{{ route('login') }}"
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
                                    data-brick="login-usernam"
                                    type="text"
                                    class="form-control"
                                    id="username"
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

                        <div class="row">
                            <!-- INSERT RECAPTCHA HERE-->
                        </div>
                        <br>
                        <button class="btn btn-primary
                            btn-block" type="submit"> Login </button>
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
<script>

</script>
@endsection
