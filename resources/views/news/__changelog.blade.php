@extends('templates.app')

@section('pageTitle', "ChangeLog - ")

@section('additional_headers')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection

@section('content')
    <div class="changelog">
        <div class="container py-5">
            <div class="row text-center mb-5 mt-5 changelog-header">
                <div class="col-lg-8 mx-auto">
                    <h2 class="display-4">Ascension Changelog</h2>
                    <p class="lead mb-0">View all of our changes in a minimal format.</p>
                    <p class="lead">Sorted in chronological order.</p>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-7 mx-auto">
                    <ul class="timeline">
                        <li class="timeline-item rounded ml-3 p-4 shadow">
                            <div class="timeline-arrow"></div>
                            <h2 class="h5 mb-0">Changelog Title</h2>
                            <i class="fa fa-clock-o mr-1"></i>
                            <span class="small">7th June, 2019</span>
                            <p class="text-small mt-2 font-weight-light">Lorem ipsum dolor sit amet, consectetur
                                adipiscing
                                elit. Quisque scelerisque diam non nisi semper, et elementum lorem ornare. Maecenas
                                placerat
                                facilisis mollis. Duis sagittis ligula in sodales vehicula....</p>
                        </li>

                        <li class="timeline-item rounded ml-3 p-4 shadow">
                            <div class="timeline-arrow"></div>
                            <h2 class="h5 mb-0">Changelog Title</h2>
                            <i class="fa fa-clock-o mr-1"></i>
                            <span class="small">7th June, 2019</span>
                            <p class="text-small mt-2 font-weight-light">Lorem ipsum dolor sit amet, consectetur
                                adipiscing
                                elit. Quisque scelerisque diam non nisi semper, et elementum lorem ornare. Maecenas
                                placerat
                                facilisis mollis. Duis sagittis ligula in sodales vehicula....</p>
                        </li>

                        <li class="timeline-item rounded ml-3 p-4 shadow">
                            <div class="timeline-arrow"></div>
                            <h2 class="h5 mb-0">Changelog Title</h2>
                            <i class="fa fa-clock-o mr-1"></i>
                            <span class="small">7th June, 2019</span>
                            <p class="text-small mt-2 font-weight-light">Lorem ipsum dolor sit amet, consectetur
                                adipiscing
                                elit. Quisque scelerisque diam non nisi semper, et elementum lorem ornare. Maecenas
                                placerat
                                facilisis mollis. Duis sagittis ligula in sodales vehicula....</p>
                        </li>

                        <li class="timeline-item rounded ml-3 p-4 shadow">
                            <div class="timeline-arrow"></div>
                            <h2 class="h5 mb-0">Changelog Title</h2>
                            <i class="fa fa-clock-o mr-1"></i>
                            <span class="small">7th June, 2019</span>
                            <p class="text-small mt-2 font-weight-light">Lorem ipsum dolor sit amet, consectetur
                                adipiscing
                                elit. Quisque scelerisque diam non nisi semper, et elementum lorem ornare. Maecenas
                                placerat
                                facilisis mollis. Duis sagittis ligula in sodales vehicula....</p>
                        </li>
                    </ul>

                    <div class="load-container">
                        <div id="load-button">
                            LOAD MORE CHANGES
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional_scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('js/news/news-scroll.js') }}"></script>
    <script>
        AOS.init();
    </script>
@endsection
