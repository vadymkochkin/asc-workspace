@extends('templates.app')

@section('pageTitle', 'Donation - ')

@section('content')
<section id="contactboard">
    <div class="container justify-content-center align-items-center
        text-center">
        <div class="donation-header">
            <h1 class="">Donation Hub</h1>
            <h2 class="">We are purely funded by donations from patrons within
                the community.</h2>
        </div>

        <div class="selection">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-lg-4 col-12 d-flex justify-content-center">
                    <a href="{{ route('donation.donate') }}" class="item-anchor" id="item-1">
                        <div class="item-inner">
                            <div class="item-icon donate-icon">
                            </div>
                            <h2 class="item-title">Become a Patron</h2>
                            <p class="item-desc">
                                Support us with improving Ascension by leaving a
                                voluntary donation.
                            </p>
                        </div>
                        <div class="item-footer">
                            <span href="#">Donate</span>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-12 d-flex justify-content-center">
                    <a href="{{ route('donation.donate') }}" class="item-anchor" id="item-2">
                        <div class="item-inner">
                            <div class="item-icon history-icon">
                            </div>
                            <h2 class="item-title">Transaction History</h2>
                            <p class="item-desc">
                                View the all transactions made from your account
                                in the last 30 days.
                            </p>
                        </div>
                        <div class="item-footer">
                            <span href="#">View History</span>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-12 d-flex justify-content-center">
                    <a href="{{ route('donation.donate') }}" class="item-anchor" id="item-3">
                        <div class="item-inner">
                            <div class="item-icon redeem-icon">
                            </div>
                            <h2 class="item-title">Redeem Code</h2>
                            <p class="item-desc">
                                Donated using Epic Game Card? Redeem the code
                                here!
                            </p>
                        </div>
                        <div class="item-footer">
                            <span href="#">Redeem Code</span>
                        </div>
                    </a>
                </div>
            </div>

            <div class="sub-items">
                <div class="row d-flex align-items-center
                    justify-content-center">
                    <div class="col-lg-5 col-12 d-flex justify-content-center">
                        <div class="sub-container right-separator">
                            <h2>Did you know?</h2>
                            <p>
                                We are purely funded through donations,
                                that includes the costs for our hardware,
                                development, advertisement and staff.
                            </p>
                        </div>
                    </div>

                    <div class="sub-separator hidden-sm-down">

                    </div>

                    <div class="col-lg-5 col-12 d-flex justify-content-center">
                        <div class="sub-container">
                            <h2>Secure Transactions</h2>
                            <p>
                                All transactions are encrypted and handled
                                securely by third-parties. We do not process nor
                                have access to any payment details.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('additional_scripts')
<script src="{{ asset('js/donate-hub.js') }}" type="text/javascript"></script>
@endsection
