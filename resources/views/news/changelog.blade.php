@extends('templates.app')

@section('pageTitle', "ChangeLog - ")

@section('content')
<div id="page-img-container">
    <img id="page-background" src="{{ asset('media/image/backgrounds/background_2.png')}}">
</div>
    <div class="changelog">
        <div class="container py-5">
            <div class="row text-center page-title">
                <div class="col-lg-8 mx-auto">
                    <h2 class="display-4">Ascension Changelog</h2>
                    <p class="lead mb-0">View all of our changes in a minimal format.</p>
                    <p class="lead">Sorted in chronological order.</p>
                </div>
            </div>

            <?php if(sizeof($changelog_items) != 0):?>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <ul class="timeline">
                        <?php foreach ($changelog_items as $key => $changelog): ?>
                        <li class="timeline-item rounded ml-3 p-4 shadow">
                            <h1 class="h5">Change(s) made on {{$key}} </h1>
                            <div class="timeline-arrow"></div>
                        <?php foreach ($changelog as $changetype => $changes): ?>
                            <h2 class="h5 mt-4">{{$changetype}}</h2>
                            <?php foreach ($changes as $change): ?>
                            <div class="changelog-des">
                              <i class="fa fa-clock-o mr-1"></i>
                              <span class="small">{{date("H:i:s", $change['time'])}}</span>
                              <p class="text-small mt-2 font-weight-light">{{$change['changelog']}}</p>
                            </div>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    @if($next_interval)
                    <div class="load-container">
                        <div id="load-button" interval = "{{$next_interval}}">
                            LOAD MORE CHANGES
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <?php endif?>
        </div>
    </div>
@endsection

@section('additional_scripts')
<script src="{{secure_asset('js/changelog.js')}}"></script>
@endsection
