<nav class="shrinked sidebar">
    <!-- Shrink Here -->
    <ul class="sidebar-list">
        <!-- Account Section -->
        <li class="sidebar-section-header">Account</li>
        <li class="dropdown-list list-item">
            <a href="#" data-toggle="collapse" data-target="#side-menu" aria-expanded="false">
                <div class="shrink-item">
                    <div class="shrink-item-header">
                        <i class="material-icons">account_box</i>
                        <i class="material-icons dropdown-arrow">arrow_drop_down</i>
                    </div>
                    <span>My Account</span>
                </div>

                <div class="full-item">
                    <i class="material-icons">account_box</i>
                    <span>My Account</span>
                    <i class="material-icons dropdown-arrow">arrow_drop_down</i>
                </div>
            </a>
            <div class="sub-menu navbar-collapse collapse" id="side-menu">
                @if (Auth::check())
                    <ul class="navbar-nav">
                        <li>
                            <a href="{{ url('/profile/'.Auth::user()->username).'/view'}}">View Profile</a>
                        </li>
                        <li>
                            <a href="{{ url('/profile/'.Auth::user()->username).'/edit'}}">Edit Profile</a>
                        </li>
                        <li>
                            <a href="{{ url('/profile/'.Auth::user()->username).'/change-password'}}">Password</a>
                        </li>
                        <li>
                            <a href="{{ url('/profile/'.Auth::user()->username).'/delete-account'}}">Delete Account</a>
                        </li>
                        <li>
                            <a href="#">Request Data</a>
                        </li>
                    </ul>

            </div>
        </li>
        <li class="dropdown-list list-item">
            <a href="{{route('transaction.home')}}">
                <div class="shrink-item">
                    <i class="material-icons">receipt</i>
                    <span>Item History</span>
                </div>
                <div class="full-item">
                    <i class="material-icons">receipt</i>
                    <span>Item History</span>
                </div>
            </a>
        </li>
        <li class="dropdown-list list-item">
            <a href="{{route('cart.history')}}">
                <div class="shrink-item">
                    <i class="material-icons">apps</i>
                    <span>Cart History</span>
                </div>
                <div class="full-item">
                    <i class="material-icons">apps</i>
                    <span>Cart History</span>
                </div>
            </a>
        </li>
        @if(Auth::user()->canModerateNews() || Auth::user()->canAddNews())
            <li class="dropdown-list list-item">
                <a href="{{route('news.home')}}">
                    <div class="shrink-item">
                        <i class="material-icons">receipt</i>
                        <span>News</span>
                    </div>
                    <div class="full-item">
                        <i class="material-icons">receipt</i>
                        <span>News</span>
                    </div>
                </a>
            </li>
            <li class="dropdown-list list-item">
                <a href="{{route('faq.home')}}">
                    <div class="shrink-item">
                        <i class="material-icons">question_answer</i>
                        <span>FAQ</span>
                    </div>
                    <div class="full-item">
                        <i class="material-icons">question_answer</i>
                        <span>FAQ</span>
                    </div>
                </a>
            </li>
        @endif
        @if(Auth::user()->canModerateChangelogs())
        <li class="dropdown-list list-item">
            <a href="{{route('changelog.manage')}}">
                <div class="shrink-item">
                    <i class="material-icons">track_changes</i>
                    <span>Change Log</span>
                </div>
                <div class="full-item">
                    <i class="material-icons">track_changes</i>
                    <span>Change Log</span>
                </div>
            </a>
        </li>
        @endif
    @endif
        <!-- Support Section -->
        <li class="sidebar-section-header mt-4">Support</li>
        <li class="dropdown-list list-item">
            <a href="#" data-toggle="collapse" data-target="#ticket-menu" aria-expanded="false">
                <div class="shrink-item">
                    <div class="shrink-item-header">
                        <i class="material-icons">create</i>
                        <i class="material-icons dropdown-arrow">arrow_drop_down</i>
                    </div>
                    <span>Tickets</span>
                </div>

                <div class="full-item">
                    <i class="material-icons">create</i>
                    <span>Tickets</span>
                    <i class="material-icons dropdown-arrow">arrow_drop_down</i>
                </div>
            </a>
            <div class="sub-menu navbar-collapse collapse" id="ticket-menu">
                <ul class="navbar-nav">
                    <li>
                        <a href="#">Overview</a>
                    </li>
                    <li>
                        <a href="#">Create Ticket</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="dropdown-list list-item">
            <a href="#" data-toggle="collapse" data-target="#bug-tracker" aria-expanded="false">
                <div class="shrink-item">
                    <div class="shrink-item-header">
                        <i class="material-icons">bug_report</i>
                        <i class="material-icons dropdown-arrow">arrow_drop_down</i>
                    </div>
                    <span>Bug Tracker</span>
                </div>


                <div class="full-item">
                    <i class="material-icons">bug_report</i>
                    <span>Bug Tracker</span>
                    <i class="material-icons dropdown-arrow">arrow_drop_down</i>
                </div>
            </a>
            <div class="sub-menu navbar-collapse collapse" id="bug-tracker">
                <ul class="navbar-nav">
                    <li>
                        <a href="{{route('bugtracker.index')}}">Browse</a>
                    </li>
                    <li>
                        <a href="{{route('bugtracker.add_new')}}">Report Bug</a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Recruitment Section -->
        <li class="sidebar-section-header mt-4">Recruitment</li>
        <li class="dropdown-list list-item">
            <a href="#" data-toggle="collapse" data-target="#developer-menu" aria-expanded="false">
                <div class="shrink-item">
                    <div class="shrink-item-header">
                        <i class="material-icons">assignment_ind</i>
                        <i class="material-icons dropdown-arrow">arrow_drop_down</i>
                    </div>
                    <span>Applications</span>
                </div>

                <div class="full-item">
                    <i class="material-icons">assignment_ind</i>
                    <span>Applications</span>
                    <i class="material-icons dropdown-arrow">arrow_drop_down</i>
                </div>
            </a>
            <div class="sub-menu navbar-collapse collapse" id="developer-menu">
                <ul class="navbar-nav">
                    @if (Auth::check())
                        @if(Auth::user()->canModerateUsers())
                            <li>
                                <a href="{{route('user.list')}}">User List</a>
                            </li>
                        @endif
                    @endif

                    <li>
                        <a href="#">Overview</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="sidebar-section-header">Acknowledgement</li>
        <li class="dropdown-list list-item">
            <a href="{{route('privacy-policy')}}">
                <div class="shrink-item">
                    <i class="material-icons">assignment</i>
                    <span>Privacy Policy</span>
                </div>
                <div class="full-item">
                    <i class="material-icons">assignment</i>
                    <span>Privacy Policy</span>
                </div>
            </a>
        </li>
        <li class="dropdown-list list-item">
            <a href="{{route('refund-policy')}}">
                <div class="shrink-item">
                    <i class="material-icons">monetization_on</i>
                    <span>Refund Policy</span>
                </div>
                <div class="full-item">
                    <i class="material-icons">monetization_on</i>
                    <span>Refund Policy</span>
                </div>
            </a>
        </li>
        <li class="dropdown-list list-item">
            <a href="{{route('terms-of-service')}}">
                <div class="shrink-item">
                    <i class="material-icons">star_border</i>
                    <span>Terms of Service</span>
                </div>
                <div class="full-item">
                    <i class="material-icons">star_border</i>
                    <span>Terms of Service</span>
                </div>
            </a>
        </li>
    </ul>
</nav>
