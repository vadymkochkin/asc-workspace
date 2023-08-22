<header class="">
    <nav class="navbar navbar-expand-lg fixed-top hidden-md-down d-flex
        justify-content-center">
        <div class="navbar-brand">
            <!---->
            <a class="brand-icon" href="{{ route('home') }}">
                <img src="{{ asset('media/logo/logo.png') }}" height="30px" />
            </a>

            <!--<img style="margin-left: 0.5rem;" src="{{ asset('media/logo/brand.png') }}" height="20px"/>-->
        </div>

        <div class="navbar-items hidden-md-down">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{Request::is('/') ? 'active' : ''}}"
                        href="{{ route('home') }}">HOME</a>
                </li>
                @include('templates.commonnav')
            </ul>
        </div>

        <div class="navbar-user">
            @if (Auth::check())
            <ul class="navbar-nav d-flex justify-content-end w-100">
                <li class="nav-item cartbtn">
                    <a href="{{ url('store/cart') }}" class="nav-link d-flex"
                        style="margin-right: 0">
                        <img src="{{url('/media/icon/Cart.svg')}}" height="20px"
                            style="margin-right: 10px;">
                        <p>View Cart</p>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link user-link" href="#">
                        <div class="d-flex">
                            <div class="user-info">
                                <div class="user-name">{{Auth::User()->username}}</div>
                                <div class="d-flex">
                                    <img class="user-price-icon"
                                        src="{{url('/media/icon/dp.svg')}}">
                                    <div class="user-dp">{{App\Models\Donation_point::UserCurrentDp(Auth::User()->id)}}</div>
                                </div>
                            </div>
                            <span>&#x25BC;</span>
                        </div>
                    </a>
                </li>
            </ul>
            <div id="hover-assistant"></div>
            <div id="user-dropdown" class="d-none">
                <div class="inner-drop">
                    <ul>
                        <li><a href="{{route('public.home')}}">Dashboard</a></li>
                        <li><a href="{{route('transaction.home')}}">Transactions</a></li>
                        <li><a href="{{route('store.cart')}}">View Cart</a></li>
                        <li><a href="#">Settings</a></li>
                        <li><a href="{{route('contact')}}">Contact Us</a></li>
                        <li><a href="{{route('public.download')}}">Download</a></li>
                        <li><a href="{{route('logout')}}">Logout</a></li>
                    </ul>
                </div>
            </div>
            @else
            <ul class="navbar-nav d-flex justify-content-end w-100">
                <li class="nav-item d-flex">
                    <a class="nav-link nav-link-icon-grp" href="{{
                        route('login') }}">SIGN IN</a>
                </li>
                <li class="nav-item d-flex">
                    <a class="nav-link nav-link-icon-grp" href="{{
                        route('register') }}">REGISTER</a>
                </li>
            </ul>
            @endif
        </div>
    </nav>

    <nav class="navbar navbar-dark fixed-top hidden-lg-up">
        @if (Auth::check())
        <button class="navbar-toggler" type="button" data-toggle="modal"
            data-target="#exampleModal1">
            <img src="{{ asset('media/icon/Menu.svg') }}" height="30px">
        </button>
        @endif
        <a class="navbar-brand" href="#"><img src="{{
                asset('media/logo/logo.png') }}" height="30px"></a>
        <div>
            <a class="navbar-brand" href="#" data-toggle="modal"
                data-target="#exampleModal">
                <img src="{{ asset('media/icon/User.svg') }}" height="30px">
            </a>
            <a href="{{ url('store/cart') }}" class="navbar-brand"
                style="margin-right: 0">
                <img src="{{url('/media/icon/Cart.svg')}}" height="20px">
            </a>
        </div>
    </nav>

</header>

<!-- This is Static Header Modal -->
<div class="modal fade sidemodal" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    @include('templates.mobile_nav', ["type" => "usermenu"])
</div>

<!-- This is Sidebar Modal -->
<div class="modal fade sidemodal" id="exampleModal1" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabe2" aria-hidden="true">
    @include('templates.mobile_nav', ["type" => "userpanel"])
</div>
