@extends('templates.app')

@section('pageTitle', 'Donation - ')

@section('content')
<section id="contactboard" class="donateboard">
    <div class="container justify-content-center align-items-center
        text-center">
        <h1 class="">How much would you like to donate?</h1>

        <div class="selection">
            <div class="row d-flex align-items-center justify-content-center dp-row">
                <div class="col-lg-4 col-12 d-flex justify-content-center">
                    <a class="item-anchor" id="dp-item-0">
                        <div class="item-inner">
                            <div class="item-icon money-icon">
                            </div>
                            <h2 class="item-title">1 DP <span class="bonus-dp">+
                                    (0 DP)</span></h2>
                        </div>
                        <div class="item-footer">
                            <span href="#">1 USD</span>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-12 d-flex justify-content-center">
                    <a class="item-anchor" id="dp-item-1">
                        <div class="item-inner">
                            <div class="item-icon money-icon">
                            </div>
                            <h2 class="item-title">5 DP <span class="bonus-dp">+
                                    (0 DP)</span></h2>
                        </div>
                        <div class="item-footer">
                            <span href="#">5 USD</span>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-12 d-flex justify-content-center">
                    <a class="item-anchor"id="dp-item-2">
                        <div class="item-inner">
                            <div class="item-icon money-icon">
                            </div>
                            <h2 class="item-title">10 DP <span class="bonus-dp">+
                                    (0 DP)</span></h2>
                        </div>
                        <div class="item-footer">
                            <span href="#">10 USD</span>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row d-flex align-items-center justify-content-center dp-row">
                <div class="col-lg-4 col-12 d-flex justify-content-center">
                    <a class="item-anchor"id="dp-item-3">
                        <div class="item-inner">
                            <div class="item-icon money-icon">
                            </div>
                            <h2 class="item-title">15 DP <span class="bonus-dp">+
                                    (3 DP)</span></h2>
                        </div>
                        <div class="item-footer">
                            <span href="#">15 USD</span>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-12 d-flex justify-content-center">
                    <a class="item-anchor"id="dp-item-4">
                        <div class="item-inner">
                            <div class="item-icon money-icon">
                            </div>
                            <h2 class="item-title">25 DP <span class="bonus-dp">+
                                    (5 DP)</span></h2>
                        </div>
                        <div class="item-footer">
                            <span href="#">25 USD</span>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-12 d-flex justify-content-center">
                    <a class="item-anchor"id="dp-item-5">
                        <div class="item-inner">
                            <div class="item-icon money-icon">
                            </div>
                            <h2 class="item-title">35 DP <span class="bonus-dp">+
                                    (7 DP)</span></h2>
                        </div>
                        <div class="item-footer">
                            <span href="#">35 USD</span>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row d-flex align-items-center justify-content-center dp-row">
                <div class="col-lg-4 col-12 d-flex justify-content-center">
                    <a class="item-anchor"id="dp-item-6">
                        <div class="item-inner">
                            <div class="item-icon money-icon">
                            </div>
                            <h2 class="item-title">50 DP <span class="bonus-dp">+
                                    (10 DP)</span></h2>
                        </div>
                        <div class="item-footer">
                            <span href="#">50 USD</span>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-12 d-flex justify-content-center">
                    <a class="item-anchor"id="dp-item-7">
                        <div class="item-inner">
                            <div class="item-icon money-icon">
                            </div>
                            <h2 class="item-title">100 DP <span
                                    class="bonus-dp">+ (20 DP)</span></h2>
                        </div>
                        <div class="item-footer">
                            <span href="#">100 USD</span>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-12 d-flex justify-content-center">
                    <a class="item-anchor" id="dp-item-8">
                        <div class="item-inner">
                            <div class="item-icon money-icon">
                            </div>
                            <h2 class="item-title">200 DP <span
                                    class="bonus-dp">+ (55 DP)</span></h2>
                        </div>
                        <div class="item-footer">
                            <span href="#">200 USD</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endsection

    @section('additional_scripts')
    <script src="{{ asset('js/donate.js') }}"></script>
    @endsection
