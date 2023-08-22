<header>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <div class="header-image">
                <img src="/images/logo.png" width="230px">
                <a href="#" id="mobile-toggle">
                    <i class="material-icons">menu</i>
                </a>
            </div>
            <div class="header-content">
                <ul id="header-list">
                    <li class="list-item">
                        <a href="#">
                            <i class="material-icons outline-account_circle"></i>
                            <i class="material-icons">home</i>
                        </a>
                    </li>
                    <li class="list-item">
                        <a href="#">
                            <i class="material-icons">shopping_cart</i>
                        </a>
                    </li>
                    <!--<li class="list-item">
                        <span class="badge-red">1</span>
                        <a href="#">
                            <i class="material-icons">mail</i>
                        </a>

                    </li>-->
                    <li class="list-item">
                        <a href="#">
                            <i class="material-icons">settings</i>
                        </a>
                    </li>

                    <li class="list-item list-divider">
                        |
                    </li>

                    <li class="list-item">
                        <a href="#">
                            <i class="material-icons">language</i>
                            <span>English</span>
                            <i class="material-icons dropdown-arrow language-dropdown">arrow_drop_down</i>
                        </a>

                        <a href="{{ route('logout') }}">
                            <span>Logout</span>
                            <i class="material-icons">exit_to_app</i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
