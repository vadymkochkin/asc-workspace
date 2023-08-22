@extends('templates.app')

@section('pageTitle', 'Donation - ')

@section('content')
<div id="page-img-container">
    <img id="page-background" src="{{ asset('media/image/backgrounds/background_11.png')}}">
</div>
<section id="contactboard" class="donateboard">
    <div class="container justify-content-center align-items-center
        text-center">
        <h1 class="donate-title">Select a Payment Option</h1>

        <div class="selection">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-lg-7 col-12 justify-content-center">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="creditdebit-tab"
                                data-toggle="tab" href="#creditdebit" role="tab"
                                aria-controls="creditdebit"
                                aria-selected="true">Credit
                                / Debit Card</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="paypal-tab"
                                data-toggle="tab" href="#paypal" role="tab"
                                aria-controls="paypal" aria-selected="false">Pay
                                with PayPal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="egc-tab"
                                data-toggle="tab" href="#egc" role="tab"
                                aria-controls="egc" aria-selected="false">Epic
                                Game Card</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="creditdebit"
                            role="tabpanel" aria-labelledby="home-tab">
                            <div id="creditcard" class="payment-tab">
                                <article class="card">
                                    <div class="card-body p-5">
                                        <div class="d-flex
                                            justify-content-between">
                                            <h2>Credit / Debit Card</h2>
                                            <div class="d-flex">
                                                <img src="{{
                                                    asset('media/icon/Visa_Gray.svg')
                                                    }}" height="37px"
                                                    style="margin-right: 5px;
                                                    color: #c9aa71;">
                                                <img src="{{
                                                    asset('media/icon/MasterCard_Gray.svg')
                                                    }}" height="37px"
                                                    style="margin-right: 5px">
                                                <img src="{{
                                                    asset('media/icon/Discover_Gray.svg')
                                                    }}" height="37px"
                                                    style="margin-right: 5px">
                                                <img src="{{
                                                    asset('media/icon/Amex_Gray.svg')
                                                    }}" height="37px">
                                            </div>
                                        </div>

                                        <br>
                                        <form id="brick-creditcard-form"
                                            action="https://project-ascension.com/donate/brick_post"
                                            method="POST">
                                            <input name="custom_parameter"
                                                type="hidden" value="53233">
                                            <div class="form-group">
                                                <label for="username">Card
                                                    Holder</label>
                                                <div class="input-group">
                                                    <div
                                                        class="input-group-prepend">
                                                        <span
                                                            class="input-group-text"><i
                                                                class="fa
                                                                fa-user"></i></span>
                                                    </div>
                                                    <input
                                                        data-brick="card-holder"
                                                        type="text"
                                                        class="form-control"
                                                        name="holder"
                                                        id="card-holder"
                                                        placeholder="John Smith"
                                                        required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="cardNumber">Card
                                                    number</label>
                                                <div class="input-group">
                                                    <div
                                                        class="input-group-prepend">
                                                        <span
                                                            class="input-group-text"><i
                                                                class="fa
                                                                fa-credit-card"></i></span>
                                                    </div>
                                                    <input
                                                        data-brick="card-number"
                                                        type="text"
                                                        class="form-control"
                                                        name="card-number"
                                                        id="card-number"
                                                        placeholder="XXXX-ZZZZ-YYYY-AAAA"
                                                        required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="dp">DP Amount</label>
                                                <div class="input-group">
                                                    <div
                                                        class="input-group-prepend">
                                                        <span
                                                            class="input-group-text"><i
                                                                class="fa
                                                                fa-diamond"></i></span>
                                                    </div>
                                                    <select class="form-control"
                                                        style="width:45%">
                                                        <option value="1">1 DP
                                                            (1 USD)</option>
                                                        <option value="5">5 DP
                                                            (5 USD)</option>
                                                        <option value="10">10 DP
                                                            (10 USD)</option>
                                                        <option value="15"
                                                            selected="">15 DP
                                                            (15 USD) + 3 DP
                                                            Bonus</option>
                                                        <option value="25">25 DP
                                                            (25 USD) + 5 DP
                                                            Bonus</option>
                                                        <option value="35">35 DP
                                                            (35 USD) + 7 DP
                                                            Bonus</option>
                                                        <option value="50">50 DP
                                                            (50 USD) + 10 DP
                                                            Bonus</option>
                                                        <option value="100">100
                                                            DP (100 USD) + 20 DP
                                                            Bonus</option>
                                                        <option value="200">200
                                                            DP (200 USD) + 55 DP
                                                            Bonus</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div class="form-group">
                                                        <label><span
                                                                class="hidden-xs">Expiration</span>
                                                        </label>
                                                        <div
                                                            class="form-inline">
                                                            <input
                                                                data-brick="card-expiration-month"
                                                                type="text"
                                                                class="form-control"
                                                                name="card-month"
                                                                id="card-exp-month"
                                                                style="width:45%"
                                                                placeholder="MM"
                                                                maxlength="2"
                                                                size="2"
                                                                required>
                                                            <span
                                                                style="width:10%;
                                                                text-align:
                                                                center"> /
                                                            </span>
                                                            <input
                                                                data-brick="card-expiration-year"
                                                                type="text"
                                                                class="form-control"
                                                                name="card-year"
                                                                id="card-exp-year"
                                                                style="width:45%"
                                                                placeholder="YYYY"
                                                                maxlength="4"
                                                                size="4"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label
                                                            data-toggle="tooltip"
                                                            title="3 digits code
                                                            on back side of the
                                                            card">CVV <i
                                                                class="fa
                                                                fa-question-circle"></i></label>
                                                        <input
                                                            class="form-control"
                                                            required=""
                                                            type="text"
                                                            maxlength="3"
                                                            size="3" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <!-- INSERT RECAPTCHA HERE-->
                                            </div>
                                            <br>
                                            <button class="btn btn-primary
                                                btn-block" type="submit"> Pay
                                                with FasterPay </button>
                                        </form>
                                    </div>
                                </article>

                            </div>
                        </div>

                        <div class="tab-pane fade" id="paypal" role="tabpanel"
                            aria-labelledby="profile-tab">
                            <div id="paypal" class="payment-tab">
                                <article class="card">
                                    <div class="card-body p-5">
                                        <div class="d-flex
                                            justify-content-between">
                                            <h2>PayPal</h2>
                                            <img class="paypal-logo" src="{{
                                                asset('media/logo/paypal.svg')
                                                }}" width="90px">
                                        </div>
                                        <br>
                                        <form id="brick-creditcard-form"
                                            action="https://project-ascension.com/donate/brick_post"
                                            method="POST">

                                            <div class="form-group">
                                                <label for="dp">DP Amount</label>
                                                <div class="input-group">
                                                    <div
                                                        class="input-group-prepend">
                                                        <span
                                                            class="input-group-text"><i
                                                                class="fa
                                                                fa fa-diamond"></i></span>
                                                    </div>
                                                    <select class="form-control"
                                                        style="width:45%">
                                                        <option value="1">1 DP
                                                            (1 USD)</option>
                                                        <option value="5">5 DP
                                                            (5 USD)</option>
                                                        <option value="10">10 DP
                                                            (10 USD)</option>
                                                        <option value="15"
                                                            selected="">15 DP
                                                            (15 USD) + 3 DP
                                                            Bonus</option>
                                                        <option value="25">25 DP
                                                            (25 USD) + 5 DP
                                                            Bonus</option>
                                                        <option value="35">35 DP
                                                            (35 USD) + 7 DP
                                                            Bonus</option>
                                                        <option value="50">50 DP
                                                            (50 USD) + 10 DP
                                                            Bonus</option>
                                                        <option value="100">100
                                                            DP (100 USD) + 20 DP
                                                            Bonus</option>
                                                        <option value="200">200
                                                            DP (200 USD) + 55 DP
                                                            Bonus</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <button class="btn btn-primary
                                                btn-block" type="submit"> Pay
                                                with PayPal </button>
                                        </form>
                                    </div>
                                </article>

                            </div>
                        </div>

                        <div class="tab-pane fade" id="egc" role="tabpanel"
                            aria-labelledby="contact-tab">
                            <div id="egc" class="payment-tab">
                                <article class="card">
                                    <div class="card-body p-5">
                                        <h2>Epic Game Card</h2>
                                        <br>
                                        <form id="brick-creditcard-form"
                                            action="https://project-ascension.com/donate/brick_post"
                                            method="POST">

                                            <div class="form-group">
                                                <label for="dp">Purchase an Prepaid Epic
                                                    Game Card at:
                                                </label> &nbsp; <a href="https://epicgamecard.com/"
                                                    id="egc-link" target="_blank">epicgamecard.com</a>
                                            </div>
                                            <div class="form-group">
                                                <label for="cardNumber">Card
                                                    number</label>
                                                <div class="input-group">
                                                    <div
                                                        class="input-group-prepend">
                                                        <span
                                                            class="input-group-text"><i
                                                                class="fa
                                                                fa-credit-card"></i></span>
                                                    </div>
                                                    <input
                                                        data-brick="card-number"
                                                        type="text"
                                                        class="form-control"
                                                        name="card-number"
                                                        id="card-number"
                                                        placeholder="XXXXX-ZZZZZ-YYYYY-AAAAA"
                                                        required>
                                                </div>
                                            </div>
                                            <br>
                                            <a href="#" class="btn btn-primary
                                                btn-block" type=""> Redeem Card </a>
                                        </form>
                                    </div>
                                </article>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
    @endsection

    @section('additional_scripts')
    <script src="{{ asset('js/donate.js') }}"></script>
    @endsection
