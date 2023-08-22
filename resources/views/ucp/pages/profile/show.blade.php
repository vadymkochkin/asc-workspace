@extends('ucp.templates.app')

@section('pageTitle', $user->username . "'s Profile")

@section('template_title')
    {{ $user->name }}'s Profile
@endsection

@section('content')
    <div class="content-wrapper wrapper-default">
        <section>
            <div class="container-fluid">
                <div class="content-inner">
                    <div class="content-body">
                        <div class="content-title">
                            <h5>{{ trans('profile.showProfileTitle',['username' => $user->username]) }}</h5>
                        </div>
                        <div class="row">
                            <div class="col-12">

                                <dl class="user-info">

                                    <dt>
                                        {{ trans('profile.showProfileUsername') }}
                                    </dt>
                                    <dd>
                                        {{ $user->username }}
                                    </dd>

                                    <dt>
                                        {{ trans('profile.showProfileEmail') }}
                                    </dt>
                                    <dd>
                                        {{ $user->email }}
                                    </dd>

                                    @if ($user->profile)

                                        @if ($user->profile->bio)
                                            <dt>
                                                {{ trans('profile.showProfileBio') }}
                                            </dt>
                                            <dd>
                                                {{ $user->profile->bio }}
                                            </dd>
                                        @endif

                                        @if ($user->profile->twitter_username)
                                            <dt>
                                                {{ trans('profile.showProfileTwitterUsername') }}
                                            </dt>
                                            <dd>
                                                {!! HTML::link('https://twitter.com/'.$user->profile->twitter_username, $user->profile->twitter_username, array('class' => 'twitter-link', 'target' => '_blank')) !!}
                                            </dd>
                                        @endif

                                        @if ($user->profile->github_username)
                                            <dt>
                                                {{ trans('profile.showProfileGitHubUsername') }}
                                            </dt>
                                            <dd>
                                                {!! HTML::link('https://github.com/'.$user->profile->github_username, $user->profile->github_username, array('class' => 'github-link', 'target' => '_blank')) !!}
                                            </dd>
                                        @endif
                                    @endif

                                </dl>

                                @if ($user->profile)
                                    @if (Auth::user()->id == $user->id)

                                        {!! HTML::icon_link(URL::to('/profile/'.Auth::user()->username.'/edit'), 'fa fa-fw fa-cog', trans('titles.editProfile'), array('class' => 'btn btn-md btn-block')) !!}

                                    @endif
                                @else

                                    <p>{{ trans('profile.noProfileYet') }}</p>
                                    {!! HTML::icon_link(URL::to('/profile/'.Auth::user()->username.'/edit'), 'fa fa-fw fa-plus ', trans('titles.createProfile'), array('class' => 'btn btn-md btn-block')) !!}

                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
