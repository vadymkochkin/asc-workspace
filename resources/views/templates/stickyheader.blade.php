<header class="d-flex" style="height: 150px;">
    <div class="container">
        <div class="row">
            <div class="w-100">
                <nav class="navbar navbar-expand-lg fixed-top hidden-md-down d-flex
                    justify-content-between">
                    <div class="navbar-brand align-start">
                        <a class="brand-icon" href="{{ route('home') }}">
                            <img src="{{url('/media/logo/brand_new_header.png')}}" height="150px" class="brand-small" />

                            <img src="{{url('/media/logo/brand_new.png')}}" height="150px" class="brand-large" />
                        </a>
                    </div>

                    <div class="navbar-items hidden-md-down">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link {{Request::is('/') ? 'active' : ''}}"
                                    href="{{ route('home') }}">HOME</a>
                            </li>
                            @include('templates.commonnav')
                        </ul>

                        <div class="dropdown-menu megamenu" aria-labelledby="dropdown01" id="game-dropdown" is-toggled="false">
                            <div class="row d-flex justify-content-around menu-container">
                                <div class="col-sm-6 col-lg-2 menu-list">
                                    <h5 class="row-header">Gameplay</h5>
                                    <a class="dropdown-item" href="#">Faction Balance</a>
                                    <a class="dropdown-item" href="#">Experience Classless</a>
                                    <a class="dropdown-item" href="#">Recruit a Friend</a>
                                    <a class="dropdown-item" href="#">Ironman Mode</a>
                                </div>
                                <div class="col-sm-6 col-lg-2 menu-list">
                                    <h5 class="row-header">News</h5>
                                    <a class="dropdown-item {{Request::is('news') || Request::is('article') ? 'active'
                                    : ''}}" href="{{ route('news') }}">News Articles</a>
                                    <a class="dropdown-item {{Request::is('changelog') ? 'active' : ''}}"
                                        href="{{ route('changelog.view') }}">Changelog</a>
                                    <a class="dropdown-item {{Request::is('bugtracker') ? 'active' : ''}}"
                                        href="{{ route('bugtracker.index') }}">Bugtracker</a>
                                    <a class="dropdown-item" href="https://twitter.com/ascensionfeed">Twitter Feed</a>
                                </div>
                                <div class="col-sm-6 col-lg-2 menu-list">
                                    <h5 class="row-header">Guides & Information</h5>
                                    <a class="dropdown-item" href="#">New Player's Guide</a>
                                    <a class="dropdown-item" href="#">Connection Guide</a>
                                    <a class="dropdown-item" href="#">Realm Status</a>
                                    <a class="dropdown-item" href="#">Download Client</a>
                                </div>
                                <div class="col-sm-6 col-lg-2 menu-list">
                                    <h5 class="row-header">Competitive</h5>
                                    <a class="dropdown-item" href="#">Ironman Ranking</a>
                                    <a class="dropdown-item" href="#">Achievment Ranking</a>
                                    <a class="dropdown-item" href="#">PvP Ranking</a>
                                    <a class="dropdown-item" href="#">Guild Ranking</a>
                                </div>
                                <div class="col-sm-6 col-lg-2 menu-list">
                                    <h5 class="row-header">Seasons</h5>
                                    <a class="dropdown-item" href="#">Season I</a>
                                    <a class="dropdown-item" href="#">Season II</a>
                                    <a class="dropdown-item" href="#">Season III</a>
                                    <a class="dropdown-item" href="#">Season IV</a>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown-menu megamenu" aria-labelledby="dropdown02" id="support-dropdown" is-toggled="false">
                            <div class="row d-flex menu-container" style="padding: 1rem 1.5rem">
                                <div class="col-sm-6 col-lg-2 menu-list">
                                    <h5 class="row-header">Support</h5>
                                    <a class="dropdown-item {{Request::is('faq') ? 'active' : ''}}" href="{{
                                        route('faq.index') }}">Frequently Asked Questions</a>
                                    <a class="dropdown-item {{Request::is('contact') ? 'active' : ''}}" href="{{
                                        route('contact') }}">Contact Us</a>
                                    <a class="dropdown-item" href="https://twitter.com/ascensionfeed">Tweet at us!</a>
                                    <a class="dropdown-item" href="https://discord.gg/bEfV3M5">Join our Discord!</a>
                                                             </div>
                                <div class="col-sm-6 col-lg-2 menu-list">
                                    <h5 class="row-header">Bugtracker</h5>
                                    <a class="dropdown-item" href="{{route('bugtracker.index')}}">View Bugtracker</a>
                                    <a class="dropdown-item" href="{{route('bugtracker.add_new')}}">Submit Bug</a>
                                    <a class="dropdown-item" href="#">My Reports</a>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown-menu megamenu" aria-labelledby="dropdown03" id="account-dropdown" is-toggled="false">
                            <div class="row d-flex menu-container justify-content-end" style="padding: 1rem 1.5rem">
                                <div class="col-sm-6 col-lg-2 menu-list">
                                    <h5 class="row-header">My Account</h5>
                                    <a class="dropdown-item" href="{{route('public.home')}}">Dashboard</a>
                                    <a class="dropdown-item" href="{{route('transaction.home')}}">Transactions</a>
                                    <a class="dropdown-item" href="{{route('public.download')}}">Download</a>
                                    <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                               </div>
                            </div>
                        </div>
                    </div>

                    <div class="navbar-user align-end">
                        @if (Auth::check())
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('donate')}}">
                                    <div class="d-flex">
                                        <div class="user-dp" style="margin-right: 5px">
                                            {{App\Models\Donation_point::UserCurrentDp(Auth::User()->id)}}</div>
                                        <img class="user-price-icon" src="{{url('/media/icon/dp.svg')}}">
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('store/cart') }}">View
                                    Cart <img src="{{url('/media/icon/Cart.svg')}}" height="20px">
                                </a>
                            </li>
                            <li class="nav-item dropdown account-tab">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary sticky-toggle" id="dropdown03" data-toggle="account-dropdown"
                                    aria-haspopup="true" aria-expanded="false" onclick="">{{Auth::User()->username}}</button>
                                </div>
                            </li>
                        </ul>
                        @else
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{
                                    route('login') }}">SIGN IN</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{
                                    route('register') }}">REGISTER</a>
                            </li>
                        </ul>
                        @endif
                    </div>
                </nav>
            </div>
        </div>

    </div>
</header>
<!--https://project-ascension.com/application/themes/avalon/images/logo-hover.png-->
<!--https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/i/a4ae229f-c3c4-4a1f-ac52-16fcddb1ffa3/d2dh6a5-7a25af75-ade3-4b15-b662-05f65933aad8.png-->
<!--{{ asset('media/logo/logo.png') }}-->
