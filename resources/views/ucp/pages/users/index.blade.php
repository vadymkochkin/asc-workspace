@extends('ucp.templates.app')
@section('pageTitle', 'Dashboard')
@section('content')
    <div class="content-wrapper wrapper-default">
        <section>
            <div class="container-fluid">
                <div class="content-body">
                    <div class="row">
                        <!-- Row 1-->
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="block-content">
                                <div class="block-inner">
                                    <div class="block-title">
                                        <i class="material-icons">email</i>
                                        <h5>Email Address</h5>
                                    </div>

                                    <div class="block-body">
                                        <p>{{Auth::user()->email}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="block-content">
                                <div class="block-inner">
                                    <div class="block-title">
                                        <i class="material-icons">group</i>
                                        <h5>Username</h5>
                                    </div>

                                    <div class="block-body">
                                        <p>{{Auth::user()->username}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="block-content">
                                <div class="block-inner">
                                    <div class="block-title">
                                        <i class="material-icons">assignment_ind</i>
                                        <h5>Access Level</h5>
                                    </div>

                                    <div class="block-body">
                                        <p>{{Auth::user()->getAccessLevelString()}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="block-content">
                                <div class="block-inner">
                                    <div class="block-title">
                                        <i class="material-icons">calendar_today</i>
                                        <h5>Member Since</h5>
                                    </div>

                                    <div class="block-body">
                                        <p>{{Auth::user()->created_at}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="block-content">
                                <div class="block-inner">
                                    <div class="block-title">
                                        <i class="material-icons">language</i>
                                        <h5>Location</h5>
                                    </div>

                                    <div class="block-body">
                                        <p>North Korea</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="block-content">
                                <div class="block-inner">
                                    <div class="block-title">
                                        <i class="material-icons">dvr</i>
                                        <h5>Last IP</h5>
                                    </div>

                                    <div class="block-body">
                                        <p>127.0.0.1</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="block-content">
                                <div class="block-inner">
                                    <div class="block-title">
                                        <i class="material-icons">monetization_on</i>
                                        <h5>Premium</h5>
                                    </div>
                                    <div class="block-body">
                                        <p>Active</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="block-content">
                                <div class="block-title">
                                    <i class="material-icons">history</i>
                                    <h5>Recent Connections</h5>
                                </div>

                                <div class="table-responsive mCustomScrollbar">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>IP Address</th>
                                            <th class="table-country">Country</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($recent_connections as $connection)
                                            <tr>
                                                <td scope="row">{{ $connection->connection_address }}</td>
                                                <td class="table-country">{{ $connection->connection_country }}</td>
                                                <td>{{ (new \Carbon\Carbon($connection->connected_at))->diffForHumans() }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="block-content">
                                <div class="block-inner">
                                    <div class="block-title">
                                        <i class="material-icons">access_time</i>
                                        <h5>Remaining Membership</h5>
                                    </div>
                                    <div class="block-body">
                                        <p>
                                            <span id="premium-days">22</span> days remaining.
                                        </p>
                                    </div>
                                </div>
                                <div class="progress">
                                    <div role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
