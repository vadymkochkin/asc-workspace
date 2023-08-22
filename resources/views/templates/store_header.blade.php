<nav class="asc-navbar asc-sticky-header">
    <div class="asc-navbar-lower">
        <div class="d-flex">
            <div class="asc-navbar-categories full">
                <a href="{{ route('store.realm',$realm_slug)}}" class="asc-navbar-item asc-navbar-selected">Featured</a>
                @foreach($menus as $menu)
                    <a href="{{ url('store/'.$realm_slug.'/'.$menu->slug)}}"
                       class="asc-navbar-item">{{$menu->title}}</a>
                @endforeach
            </div>
            <div class="asc-navbar-categories-mobile">
                <button class="navbar-toggler" type="button" data-toggle="modal" data-target="#itemModal" style="margin-top: 11px;margin-left: -10px;">
                    <img src="{{ asset('media/icon/Menu.svg') }}" height="30px">
                </button>
            </div>
            <div class="asc-navbar-actions d-flex ml-auto">
                <input type="text" id="txtinput" class="asc-navbar-item searchbar" placeholder="Search..." style="width: 270px;" />
            </div>
        </div>
    </div>
</nav>


<!-- This is Static Header Modal -->
<div class="modal fade sidemodal" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemModalLabel" aria-hidden="true">
    @include('templates.mobile_nav', ["type" => "store", "data" => $menus])
</div>
