<div class="modal-dialog" role="document">
    <div class="modal-content">

        <div class="modal-header">
            <div class="vertical-center">
                <a href="#">
                    <img src="{{ asset('media/logo/logo.png') }}" height="40px">
                </a>
            </div>
            <div class="closebtn" data-dismiss="modal" aria-label="Close">
                <span>&times;</span>
            </div>
        </div>

        <div class="modal-body {{$type == 'userpanel' ? 'modalnav' : ''}}">
            @if ($type == 'store')
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('store.realm',$realm_slug)}}">Featured</a>
                    </li>

                    @foreach($data as $key => $menu)
                        <li class="nav-item">
                            <a href="{{ url('store/'.$realm_slug.'/'.$menu->slug)}}" class="nav-link"
                                    {{isset($menu->items) && sizeof($menu->items) > 0 ?
                                    'data-toggle="collapse" data-target="#account-menu' . $key . '" aria-expanded="false"' : ''}}>
                                <div class="full-item">
                                    <span>{{$menu->title}}</span>
                                    @if (isset($menu->items) && sizeof($menu->items) > 0)
                                        <span class="dropdownarrow">&#x25BC;</span>
                                    @endif
                                </div>
                            </a>
                            @if (isset($menu->items) && sizeof($menu->items) > 0)
                                <div class="sub-menu navbar-collapse collapse" id="account-menu{{$key}}">
                                    <ul class="navbar-nav">
                                        @foreach($menu->items as $item)
                                            <li class="nav-item"><a
                                                        href="{{ url('store/'.$realm_slug.'/'.$item->slug)}}">{{$item->title}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </li>
                    @endforeach

                </ul>
            @elseif ($type == 'usermenu')
                <ul class="navbar-nav">
                    @if (Auth::check())
                        <li class="nav-item">
                            <a href="#" class="nav-link" data-toggle="collapse" data-target="#account-menu"
                               aria-expanded="false">
                                <div class="full-item">
                                    <img src="{{ asset('media/icon/User.svg') }}" height="21px">
                                    <span>{{Auth::User()->username}}</span>
                                    <span class="dropdownarrow">&#x25BC;</span>
                                    <div class="d-flex" style="padding: 10px;padding-left: 20px;">
                                        <img class="user-price-icon" src="{{url('/media/icon/dp.svg')}}" style="width: 20px;">
                                        <div class="user-dp">{{App\Models\Donation_point::UserCurrentDp(Auth::User()->id)}}</div>
                                    </div>
                                </div>
                            </a>
                            <div class="sub-menu navbar-collapse collapse" id="account-menu">
                                <ul class="navbar-nav">
                                    <li class="nav-item"><a href="{{route('public.home')}}">Dashboard</a></li>
                                    <li class="nav-item"><a href="{{route('transaction.home')}}">Transactions</a></li>
                                    <li class="nav-item"><a href="{{route('store.cart')}}">View Cart</a></li>
                                    <li class="nav-item"><a href="#">Settings</a></li>
                                    <li class="nav-item"><a href="{{route('contact')}}">Contact Us</a></li>
                                    <li class="nav-item"><a href="#">Download</a></li>
                                    <li class="nav-item"><a href="{{route('logout')}}">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link nav-link-icon-grp" href="{{ route('login') }}">SIGN IN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-icon-grp" href="{{ route('register') }}">REGISTER</a>
                        </li>
                    @endif
                    <li class="nav-item active">
                        <a class="nav-link" href="#">PLAY ASCENSION</a>
                    </li>

                    @include('templates.commonnav')

                </ul>
            @elseif ($type == 'userpanel')
                @include('ucp.templates.templatesidebar')
            @endif
        </div>
        @if ($type == 'usermenu' || $type == 'userpanel')
            <div class="modal-footer">
                <div class="vertical-center">
                    <p>DOWNLOAD</p>
                </div>
            </div>
        @endif
    </div>
</div>
