@extends('ucpnew.templates.app') @section('pageTitle', 'Dashboard')
@section('content')
<div id="page-img-container">
    <img id="page-background" src="{{
        asset('media/image/backgrounds/background_25.png') }}" />
</div>

<section id="ucpboard" class="justify-content-center align-items-center d-flex">
    <div class="container justify-content-center align-items-center" id="ucp-container">
        <div class="row">
            <div class="col-xl-4 col-12 nav-panel">
                <!--<h3>Categories</h3>-->
                <div class="nav nav-pills ucp-nav" id="ucp-tabs" role="tablist" aria-orientation="vertical">
                    <div class="nav-link nav-separator" aria-selected="false">
                        Dashboard
                    </div>
                    <a href="#tab1" class="nav-link active" data-toggle="pill" role="tab" aria-controls="tab1"
                        aria-selected="true">
                        <i class="mdi mdi-help-circle"></i> Account Overview
                    </a>
                    <a href="#tab2" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab2"
                        aria-selected="false">
                        <i class="mdi mdi-account"></i> My Characters
                    </a>
                    <a href="#tab3" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab3"
                        aria-selected="false">
                        <i class="mdi mdi-account-settings"></i> Account Details
                    </a>

                    <div class="nav-link nav-transparent">
                        &nbsp;
                    </div>

                    <div class="nav-link nav-separator" aria-selected="false">
                        Security & Settings
                    </div>
                    <a href="#tab4" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab4"
                        aria-selected="false">
                        <i class="mdi mdi-heart"></i> Account Security
                    </a>
                    <a href="#tab5" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab5"
                        aria-selected="false">
                        <i class="mdi mdi-coin"></i> Two-Factor Authentication
                    </a>
                    <a href="#tab6" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab6"
                        aria-selected="false">
                        <i class="mdi mdi-help"></i> Discord Connection
                    </a>

                    <div class="nav-link nav-transparent">
                        &nbsp;
                    </div>

                    <div class="nav-link nav-separator" aria-selected="false">
                        Donations & Store
                    </div>
                    <a href="#tab4" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab7"
                        aria-selected="false">
                        <i class="mdi mdi-heart"></i> Visit Store
                    </a>
                    <a href="#tab5" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab8"
                        aria-selected="false">
                        <i class="mdi mdi-coin"></i> Donate
                    </a>
                    <a href="#tab6" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab9"
                        aria-selected="false">
                        <i class="mdi mdi-help"></i> View Cart
                    </a>
                </div>
            </div>

            <div class="col-xl-9 col-12 tab-panel">
                <div class="container mt-0">
                    <div class="tab-content" id="ucp-tab-content">
                        <div class="tab-pane show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                            <div class="accordion" id="accordion-tab-1">
                                <h1 class="page-title">Account Overview</h1>
                                <div class="container con-test">
                                    <div class="row">
                                        <div class="col-lg-6 ucp-card">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3>REDEEM A CODE</h3>
                                                </div>

                                                <div class="card-body d-flex
                                                    h-100">
                                                    <form id="brick-creditcard-form"
                                                        action="https://project-ascension.com/donate/brick_post"
                                                        method="POST" class="align-self-center
                                                        w-100">
                                                        <div class="form-group
                                                            mb-0">
                                                            <div class="input-group
                                                                row d-flex
                                                                justify-content-between">
                                                                <div class="d-flex
                                                                    col-7">
                                                                    <input data-brick="card-number" type="text"
                                                                        class="form-control" name="card-number"
                                                                        id="card-number"
                                                                        placeholder="XXXXX-ZZZZZ-YYYYY-AAAAA"
                                                                        required />
                                                                </div>

                                                                <div class="col-5">
                                                                    <button href="#" class="btn
                                                                        btn-primary
                                                                        btn-block" type="submit">
                                                                        Redeem
                                                                        Code
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 ucp-card">
                                            <div class="card">
                                                <div class="card-header d-flex
                                                    justify-content-between">
                                                    <h3>DONATION BALANCE</h3>
                                                    <div class="d-flex
                                                        link-container">
                                                        <a href="#" class="card-link">DONATE</a>
                                                        <i class="fa
                                                            fa-chevron-right" aria-hidden="true"></i>
                                                    </div>
                                                </div>

                                                <div class="card-body d-flex
                                                    h-100">
                                                    <div class="row d-flex align-items-center justify-content-between donation-row"
                                                        style="width: 100%">
                                                        <div class="d-flex
                                                            align-items-center col-xl-3 col-12">
                                                            <span class="donation-balance">3000</span>
                                                            <img src="https://site.test/media/icon/dp.svg" height="18px"
                                                                style="margin-left:
                                                                10px;" />
                                                        </div>

                                                        <button href="#" class="btn
                                                        btn-primary
                                                        btn-block col-xl-4 shop-btn" type="submit">
                                                            Visit Shop
                                                        </button>

                                                        <button href="#" class="btn
                                                        btn-primary
                                                        btn-block col-xl-4 donate-btn" type="submit">
                                                            Donate
                                                        </button>

                                                        <!--

                                                        <div class="col-xl-9 col-12 d-flex">
                                                            <button href="#" class="btn
                                                                btn-primary
                                                                btn-block col-6" type="submit"
                                                                style="margin-top: 0 !important; margin-bottom: 0 !important; margin-right: 10px !important;">
                                                                Visit Shop
                                                            </button>

                                                            <button href="#" class="btn
                                                                btn-primary
                                                                btn-block col-6" type="submit"
                                                                style="margin-top: 0 !important; margin-bottom: 0 !important;">
                                                                Donate
                                                            </button>
                                                        </div>
                                                        -->
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 ucp-card">
                                            <div class="card">
                                                <div class="card-header d-flex
                                                    justify-content-between">
                                                    <h3>YOUR INFORMATION</h3>
                                                    <div class="d-flex
                                                        link-container">
                                                        <a href="#" class="card-link">ACCOUNT
                                                            DETAILS</a>
                                                        <i class="fa
                                                            fa-chevron-right" aria-hidden="true"></i>
                                                    </div>
                                                </div>

                                                <div class="card-body d-flex
                                                    h-100">
                                                    <form class="align-items-center w-100 col-12">
                                                        <div class="form-group
                                                            row info-card">
                                                            <label for="inputUser" class="col-lg-3 col-12
                                                                col-form-label info-label">Username</label>
                                                            <div class="col-lg-9 col-12">
                                                                <div id="inputUser" class="form-control info-value">
                                                                    @if (Auth::check())
                                                                    {{Auth::User()->username}}
                                                                    @else
                                                                    NOT LOGGED IN
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group
                                                            row info-card">
                                                            <label for="inputEmail" class="col-lg-3 col-12
                                                                col-form-label info-label">Email</label>
                                                            <div class="col-lg-9 col-12">
                                                                <div id="inputEmail" class="form-control info-value">
                                                                    @if (Auth::check())
                                                                    {{Auth::User()->email}}
                                                                    @else
                                                                    NOT LOGGED IN
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group
                                                        row info-card">
                                                            <label for="inputDiscord" class="col-lg-3 col-12
                                                            col-form-label info-label">Discord</label>
                                                            <div class="col-lg-9 col-12">
                                                                <div id="inputDiscord"
                                                                    class="form-control info-value info-link">
                                                                    <button href="#" class="btn
                                                                    btn-primary
                                                                    btn-block" type="submit">
                                                                        Add Discord Account
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 ucp-card">
                                            <div class="card">
                                                <div class="card-header d-flex
                                                        justify-content-between">
                                                    <h3>ACCOUNT SECURITY</h3>
                                                    <div class="d-flex
                                                            link-container">
                                                        <a href="#" class="card-link">SECURITY</a>
                                                        <i class="fa
                                                                fa-chevron-right" aria-hidden="true"></i>
                                                    </div>
                                                </div>

                                                <div class="card-body d-flex h-100">
                                                    <div class="row d-flex h-100 security-row">
                                                        <div class="col-md-5 col-12">
                                                            <div class="security-progress">
                                                                <div class="progress mx-auto" data-value='33'>
                                                                    <span class="progress-left">
                                                                        <span
                                                                            class="progress-bar border-primary"></span>
                                                                    </span>
                                                                    <span class="progress-right">
                                                                        <span
                                                                            class="progress-bar border-primary"></span>
                                                                    </span>
                                                                    <div
                                                                        class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                                                        <div>
                                                                            <div
                                                                                class="h2 font-weight-bold percentage-text">
                                                                                33%</div>
                                                                            <span
                                                                                class="percentage-subtext">COMPLETE</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-7 col-12">
                                                            <div class="security-checklist">
                                                                <ul>
                                                                    <li class="checklist-item d-flex completed">
                                                                        <!--justify-content-between-->
                                                                        <i class="fa fa-check-circle"
                                                                            aria-hidden="true"></i>
                                                                        <button href="#" class="btn
                                                                                btn-primary
                                                                                btn-block" type="submit">
                                                                            Email Verified
                                                                        </button>
                                                                    </li>

                                                                    <li class="checklist-item d-flex ">
                                                                        <i class="fa fa-circle-thin"
                                                                            aria-hidden="true"></i>
                                                                        <!--
                                                                                <span class="checklist-text">Enable 2FA
                                                                                    Authentication</span>
                                                                                -->
                                                                        <button href="#" class="btn
                                                                                btn-primary
                                                                                btn-block" type="submit">
                                                                            Enable 2FA Auth
                                                                        </button>
                                                                    </li>

                                                                    <li class="checklist-item d-flex ">
                                                                        <i class="fa fa-circle-thin"
                                                                            aria-hidden="true"></i>
                                                                        <!--
                                                                                    <span class="checklist-text">Add Discord Account</span>
                                                                                -->

                                                                        <button href="#" class="btn
                                                                                    btn-primary
                                                                                    btn-block" type="submit">
                                                                            Add Discord Account
                                                                        </button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 ucp-card">
                                            <div class="card">
                                                <div class="card-header d-flex
                                                            justify-content-between">
                                                    <h3>RECENT CONNECTIONS</h3>
                                                    <div class="d-flex
                                                                link-container">
                                                        <a href="#" class="card-link">CONNECTION HISTORY</a>
                                                        <i class="fa
                                                                    fa-chevron-right" aria-hidden="true"></i>
                                                    </div>
                                                </div>

                                                <div class="card-body d-flex
                                                            h-100">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">IP Address</th>
                                                                <th scope="col" class="table-country">Country</th>
                                                                <th scope="col">Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td scope="row">127.0.0.1</td>
                                                                <td class="table-country">NON-CLOUD-FLARE</td>
                                                                <td>6 hours ago</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">212.112.150.44</td>
                                                                <td class="table-country">NON-CLOUD-FLARE</td>
                                                                <td>1 day ago</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">99.54.141.250</td>
                                                                <td class="table-country">NON-CLOUD-FLARE</td>
                                                                <td>1 day ago</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">::1</td>
                                                                <td class="table-country">NON-CLOUD-FLARE</td>
                                                                <td>2 days ago</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">104.222.154.114</td>
                                                                <td class="table-country">NON-CLOUD-FLARE</td>
                                                                <td>2 days ago</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">212.112.150.44</td>
                                                                <td class="table-country">NON-CLOUD-FLARE</td>
                                                                <td>2 days ago</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">127.0.0.1</td>
                                                                <td class="table-country">NON-CLOUD-FLARE</td>
                                                                <td>2 days ago</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">104.222.154.114</td>
                                                                <td class="table-country">NON-CLOUD-FLARE</td>
                                                                <td>2 days ago</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">99.54.141.250</td>
                                                                <td class="table-country">NON-CLOUD-FLARE</td>
                                                                <td>2 days ago</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">127.0.0.1</td>
                                                                <td class="table-country">NON-CLOUD-FLARE</td>
                                                                <td>2 days ago</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab2" role="tabpanel" aria-labelledby="tab2">
                            <div class="accordion" id="accordion-tab-2">
                                <h1 class="page-title">My Characters</h1>
                                <div class="container con-test">
                                    <div class="row">
                                        <div class="col-lg-6 ucp-card">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3>REDEEM A CODE</h3>
                                                </div>

                                                <div class="card-body d-flex
                                                        h-100">
                                                    <form id="brick-creditcard-form"
                                                        action="https://project-ascension.com/donate/brick_post"
                                                        method="POST" class="align-self-center
                                                            w-100">
                                                        <div class="form-group
                                                                mb-0">
                                                            <div class="input-group
                                                                    row d-flex
                                                                    justify-content-between">
                                                                <div class="d-flex
                                                                        col-7">
                                                                    <input data-brick="card-number" type="text"
                                                                        class="form-control" name="card-number"
                                                                        id="card-number"
                                                                        placeholder="XXXXX-ZZZZZ-YYYYY-AAAAA"
                                                                        required />
                                                                </div>

                                                                <div class="col-5">
                                                                    <button href="#" class="btn
                                                                            btn-primary
                                                                            btn-block" type="submit">
                                                                        Redeem
                                                                        Code
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 ucp-card">
                                            <div class="card">
                                                <div class="card-header d-flex
                                                        justify-content-between">
                                                    <h3>DONATION BALANCE</h3>
                                                    <div class="d-flex
                                                            link-container">
                                                        <a href="#" class="card-link">DONATE</a>
                                                        <i class="fa
                                                                fa-chevron-right" aria-hidden="true"></i>
                                                    </div>
                                                </div>

                                                <div class="card-body d-flex
                                                        h-100">
                                                    <div class="row d-flex align-items-center justify-content-between donation-row"
                                                        style="width: 100%">
                                                        <div class="d-flex
                                                                align-items-center col-xl-3 col-12">
                                                            <span class="donation-balance">3000</span>
                                                            <img src="https://site.test/media/icon/dp.svg" height="18px"
                                                                style="margin-left:
                                                                    10px;" />
                                                        </div>

                                                        <button href="#" class="btn
                                                            btn-primary
                                                            btn-block col-xl-4 shop-btn" type="submit">
                                                            Visit Shop
                                                        </button>

                                                        <button href="#" class="btn
                                                            btn-primary
                                                            btn-block col-xl-4 donate-btn" type="submit">
                                                            Donate
                                                        </button>

                                                        <!--
    
                                                            <div class="col-xl-9 col-12 d-flex">
                                                                <button href="#" class="btn
                                                                    btn-primary
                                                                    btn-block col-6" type="submit"
                                                                    style="margin-top: 0 !important; margin-bottom: 0 !important; margin-right: 10px !important;">
                                                                    Visit Shop
                                                                </button>
    
                                                                <button href="#" class="btn
                                                                    btn-primary
                                                                    btn-block col-6" type="submit"
                                                                    style="margin-top: 0 !important; margin-bottom: 0 !important;">
                                                                    Donate
                                                                </button>
                                                            </div>
                                                            -->
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 ucp-card">
                                            <div class="card">
                                                <div class="card-header d-flex
                                                        justify-content-between">
                                                    <h3>YOUR INFORMATION</h3>
                                                    <div class="d-flex
                                                            link-container">
                                                        <a href="#" class="card-link">ACCOUNT
                                                            DETAILS</a>
                                                        <i class="fa
                                                                fa-chevron-right" aria-hidden="true"></i>
                                                    </div>
                                                </div>

                                                <div class="card-body d-flex
                                                        h-100">
                                                    <form class="align-items-center w-100 col-12">
                                                        <div class="form-group
                                                                row info-card">
                                                            <label for="inputUser" class="col-lg-3 col-12
                                                                    col-form-label info-label">Username</label>
                                                            <div class="col-lg-9 col-12">
                                                                <div id="inputUser" class="form-control info-value">
                                                                    DefaultUser
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group
                                                                row info-card">
                                                            <label for="inputEmail" class="col-lg-3 col-12
                                                                    col-form-label info-label">Email</label>
                                                            <div class="col-lg-9 col-12">
                                                                <div id="inputEmail" class="form-control info-value">
                                                                    DefaultUser@email.com
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group
                                                            row info-card">
                                                            <label for="inputDiscord" class="col-lg-3 col-12
                                                                col-form-label info-label">Discord</label>
                                                            <div class="col-lg-9 col-12">
                                                                <div id="inputDiscord"
                                                                    class="form-control info-value info-link">
                                                                    <button href="#" class="btn
                                                                        btn-primary
                                                                        btn-block" type="submit">
                                                                        Add Discord Account
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 ucp-card">
                                            <div class="card">
                                                <div class="card-header d-flex
                                                            justify-content-between">
                                                    <h3>ACCOUNT SECURITY</h3>
                                                    <div class="d-flex
                                                                link-container">
                                                        <a href="#" class="card-link">SECURITY</a>
                                                        <i class="fa
                                                                    fa-chevron-right" aria-hidden="true"></i>
                                                    </div>
                                                </div>

                                                <div class="card-body d-flex h-100">
                                                    <div class="row d-flex h-100 security-row">
                                                        <div class="col-md-5 col-12">
                                                            <div class="security-progress">
                                                                <div class="progress mx-auto" data-value='33'>
                                                                    <span class="progress-left">
                                                                        <span
                                                                            class="progress-bar border-primary"></span>
                                                                    </span>
                                                                    <span class="progress-right">
                                                                        <span
                                                                            class="progress-bar border-primary"></span>
                                                                    </span>
                                                                    <div
                                                                        class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                                                        <div>
                                                                            <div
                                                                                class="h2 font-weight-bold percentage-text">
                                                                                33%</div>
                                                                            <span
                                                                                class="percentage-subtext">COMPLETE</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-7 col-12">
                                                            <div class="security-checklist">
                                                                <ul>
                                                                    <li class="checklist-item d-flex completed">
                                                                        <!--justify-content-between-->
                                                                        <i class="fa fa-check-circle"
                                                                            aria-hidden="true"></i>
                                                                        <button href="#" class="btn
                                                                                    btn-primary
                                                                                    btn-block" type="submit">
                                                                            Email Verified
                                                                        </button>
                                                                    </li>

                                                                    <li class="checklist-item d-flex ">
                                                                        <i class="fa fa-circle-thin"
                                                                            aria-hidden="true"></i>
                                                                        <!--
                                                                                    <span class="checklist-text">Enable 2FA
                                                                                        Authentication</span>
                                                                                    -->
                                                                        <button href="#" class="btn
                                                                                    btn-primary
                                                                                    btn-block" type="submit">
                                                                            Enable 2FA Auth
                                                                        </button>
                                                                    </li>

                                                                    <li class="checklist-item d-flex ">
                                                                        <i class="fa fa-circle-thin"
                                                                            aria-hidden="true"></i>
                                                                        <!--
                                                                                        <span class="checklist-text">Add Discord Account</span>
                                                                                    -->

                                                                        <button href="#" class="btn
                                                                                        btn-primary
                                                                                        btn-block" type="submit">
                                                                            Add Discord Account
                                                                        </button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 ucp-card">
                                            <div class="card">
                                                <div class="card-header d-flex
                                                                justify-content-between">
                                                    <h3>RECENT CONNECTIONS</h3>
                                                    <div class="d-flex
                                                                    link-container">
                                                        <a href="#" class="card-link">CONNECTION HISTORY</a>
                                                        <i class="fa
                                                                        fa-chevron-right" aria-hidden="true"></i>
                                                    </div>
                                                </div>

                                                <div class="card-body d-flex
                                                                h-100">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">IP Address</th>
                                                                <th scope="col" class="table-country">Country</th>
                                                                <th scope="col">Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td scope="row">127.0.0.1</td>
                                                                <td class="table-country">NON-CLOUD-FLARE</td>
                                                                <td>6 hours ago</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">212.112.150.44</td>
                                                                <td class="table-country">NON-CLOUD-FLARE</td>
                                                                <td>1 day ago</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">99.54.141.250</td>
                                                                <td class="table-country">NON-CLOUD-FLARE</td>
                                                                <td>1 day ago</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">::1</td>
                                                                <td class="table-country">NON-CLOUD-FLARE</td>
                                                                <td>2 days ago</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">104.222.154.114</td>
                                                                <td class="table-country">NON-CLOUD-FLARE</td>
                                                                <td>2 days ago</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">212.112.150.44</td>
                                                                <td class="table-country">NON-CLOUD-FLARE</td>
                                                                <td>2 days ago</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">127.0.0.1</td>
                                                                <td class="table-country">NON-CLOUD-FLARE</td>
                                                                <td>2 days ago</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">104.222.154.114</td>
                                                                <td class="table-country">NON-CLOUD-FLARE</td>
                                                                <td>2 days ago</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">99.54.141.250</td>
                                                                <td class="table-country">NON-CLOUD-FLARE</td>
                                                                <td>2 days ago</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">127.0.0.1</td>
                                                                <td class="table-country">NON-CLOUD-FLARE</td>
                                                                <td>2 days ago</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab3" role="tabpanel" aria-labelledby="tab3">
                            <div class="accordion" id="accordion-tab-3">
                                <h1 class="page-title">Account Details</h1>
                                <div class="container con-test">

                                    <div class="row">
                                        <div class="col-lg-12 ucp-card">
                                            <div class="card">
                                                <div class="card-header d-flex
                                                        justify-content-between">
                                                    <h3>PERSONAL INFORMATION</h3>
                                                    <div class="d-flex
                                                            link-container">
                                                        <i class="fa
                                                            fa-pencil" aria-hidden="true"></i>
                                                        <a href="#" class="card-link">UPDATE</a>
                                                    </div>
                                                </div>

                                                <div class="card-body d-flex
                                                        h-100">
                                                    <form class="align-items-center w-100 col-12">
                                                        <div class="form-group
                                                                row info-card mb-0">
                                                            <label for="inputUser" class="col-lg-2 col-12
                                                                    col-form-label info-label">Username</label>
                                                            <div class="col-lg-10 col-12">
                                                                <div id="inputUser" class="form-control info-value">
                                                                    @if (Auth::check())
                                                                    {{Auth::User()->username}}
                                                                    @else
                                                                    NOT LOGGED IN
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 ucp-card">
                                            <div class="card">
                                                <div class="card-header d-flex
                                                        justify-content-between">
                                                    <h3>DISCORD ACCOUNT</h3>
                                                    <div class="d-flex
                                                            link-container">
                                                        <i class="fa
                                                            fa-plus" aria-hidden="true"></i>
                                                        <a href="#" class="card-link">ADD DISCORD ACCOUNT</a>
                                                    </div>
                                                </div>

                                                <div class="card-body d-flex
                                                        h-100">
                                                    <form class="align-items-center w-100 col-12">
                                                        <div class="form-group
                                                                row info-card mb-0">
                                                            <label for="inputEmail" class="col-lg-2 col-12
                                                                    col-form-label info-label">Discord</label>
                                                            <div class="col-lg-10 col-12">
                                                                <div id="inputEmail" class="form-control info-value">
                                                                    Not Linked
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 ucp-card">
                                            <div class="card">
                                                <div class="card-header d-flex
                                                        justify-content-between">
                                                    <h3>EMAIL ADDRESS</h3>
                                                    <div class="d-flex
                                                            link-container">
                                                        <i class="fa
                                                            fa-pencil" aria-hidden="true"></i>
                                                        <a href="#" class="card-link">UPDATE</a>
                                                    </div>
                                                </div>

                                                <div class="card-body d-flex
                                                        h-100">
                                                    <form class="align-items-center w-100 col-12">
                                                        <div class="form-group
                                                                row info-card mb-0">
                                                            <label for="inputEmail" class="col-lg-2 col-12
                                                                    col-form-label info-label">Email</label>
                                                            <div class="col-lg-10 col-12">
                                                                <div id="inputEmail" class="form-control info-value">
                                                                    @if (Auth::check())
                                                                    {{Auth::User()->email}}
                                                                    @else
                                                                    NOT LOGGED IN
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab4" role="tabpanel" aria-labelledby="tab4">
                            <div class="accordion" id="accordion-tab-3">
                                <h1 class="page-title">Account Security</h1>
                                <div class="container con-test">

                                    <div class="row">
                                        <div class="col-lg-12 ucp-card">
                                            <div class="card">
                                                <div class="card-header d-flex
                                                        justify-content-between">
                                                    <h3>PASSWORD</h3>
                                                    <div class="d-flex
                                                            link-container">
                                                        <i class="fa
                                                            fa-pencil" aria-hidden="true"></i>
                                                        <a href="#" class="card-link">UPDATE</a>
                                                    </div>
                                                </div>

                                                <div class="card-body d-flex
                                                        h-100">
                                                    <form class="align-items-center w-100 col-12">
                                                        <div class="form-group
                                                                row info-card mb-0">
                                                            <label for="inputUser" class="col-lg-2 col-12
                                                                    col-form-label info-label">Password</label>
                                                            <div class="col-lg-10 col-12">
                                                                <div id="inputUser" class="form-control info-value">
                                                                    @if (Auth::check())
                                                                    Last updated 8 Aug 2019
                                                                    @else
                                                                    NOT LOGGED IN
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 ucp-card">
                                            <div class="card">
                                                <div class="card-header d-flex
                                                        justify-content-between">
                                                    <h3>Two-Factor Authentication</h3>
                                                    <div class="d-flex
                                                            link-container">
                                                        <a href="#" class="card-link">SET up 2FA Authentication</a>
                                                        <i class="fa
                                                        fa-chevron-right" aria-hidden="true"></i>
                                                    </div>
                                                </div>

                                                <div class="card-body d-flex
                                                        h-100">
                                                    <form class="align-items-center w-100 col-12">
                                                        <div class="form-group
                                                                row info-card mb-0">
                                                            <label for="inputEmail" class="col-lg-2 col-12
                                                                    col-form-label info-label">Status</label>
                                                            <div class="col-lg-10 col-12">
                                                                <div id="inputEmail" class="form-control info-value">
                                                                    Inactive
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 ucp-card">
                                            <div class="card">
                                                <div class="card-header d-flex
                                                            justify-content-between">
                                                    <h3>RECENT CONNECTIONS</h3>
                                                    <div class="d-flex
                                                                link-container">
                                                        <a href="#" class="card-link">CONNECTION HISTORY</a>
                                                        <i class="fa
                                                                    fa-chevron-right" aria-hidden="true"></i>
                                                    </div>
                                                </div>

                                                <div class="card-body d-flex
                                                            h-100">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">IP Address</th>
                                                                <th scope="col" class="table-country">Country</th>
                                                                <th scope="col">Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td scope="row">127.0.0.1</td>
                                                                <td class="table-country">NON-CLOUD-FLARE</td>
                                                                <td>6 hours ago</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">212.112.150.44</td>
                                                                <td class="table-country">NON-CLOUD-FLARE</td>
                                                                <td>1 day ago</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">99.54.141.250</td>
                                                                <td class="table-country">NON-CLOUD-FLARE</td>
                                                                <td>1 day ago</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">::1</td>
                                                                <td class="table-country">NON-CLOUD-FLARE</td>
                                                                <td>2 days ago</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">104.222.154.114</td>
                                                                <td class="table-country">NON-CLOUD-FLARE</td>
                                                                <td>2 days ago</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">212.112.150.44</td>
                                                                <td class="table-country">NON-CLOUD-FLARE</td>
                                                                <td>2 days ago</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">127.0.0.1</td>
                                                                <td class="table-country">NON-CLOUD-FLARE</td>
                                                                <td>2 days ago</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">104.222.154.114</td>
                                                                <td class="table-country">NON-CLOUD-FLARE</td>
                                                                <td>2 days ago</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">99.54.141.250</td>
                                                                <td class="table-country">NON-CLOUD-FLARE</td>
                                                                <td>2 days ago</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">127.0.0.1</td>
                                                                <td class="table-country">NON-CLOUD-FLARE</td>
                                                                <td>2 days ago</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('additional_scripts')
<script>
    $(function () {

        $(".progress").each(function () {

            var value = $(this).attr('data-value');
            var left = $(this).find('.progress-left .progress-bar');
            var right = $(this).find('.progress-right .progress-bar');

            if (value > 0) {
                if (value <= 50) {
                    right.css('transform', 'rotate(' + percentageToDegrees(value) + 'deg)')
                } else {
                    right.css('transform', 'rotate(180deg)')
                    left.css('transform', 'rotate(' + percentageToDegrees(value - 50) + 'deg)')
                }
            }

        })

        function percentageToDegrees(percentage) {

            return percentage / 100 * 360

        }

    });
</script>
@endsection