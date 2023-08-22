@extends('ucp.templates.app')
@section('pageTitle', 'Manage User')
@section('content')
    <div class="content-wrapper wrapper-default manage">
        <div class="manage-content-header">
            <div class="container-fluid">
                <p>{{$user_details->username}}'s Info</p>
            </div>
        </div>
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
                                        <p>{{$user_details->email}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="block-content">
                                <div class="block-inner">
                                    <div class="block-title">
                                        <i class="material-icons">lock</i>
                                        <h5>Password</h5>
                                    </div>

                                    <div class="block-body">
                                        <p>P*********</p>
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
                                        <p>{{$user_details->username}}</p>
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
                                        <p>{{$user_details->getAccessLevelString()}}</p>
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
                                        <p>{{$user_details->created_at}}</p>
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
                                        <p>{{$last_ip->connection_address ?? "" }}</p>
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
                        <div class="col-12">
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
        </section>

    </div>
    </div>
@endsection
