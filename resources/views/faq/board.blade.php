@extends('templates.app')

@section('content')
    <div id="page-img-container">
        <img id="page-background" src="{{ asset('media/image/backgrounds/background_7.png')}}">
    </div>

    <section id="faqboard">
        <div class="row searchrow">
            <div class="row col-md-3 col-sm-12 searchinputrow">
                <input class="col-md-11 form-control searchinput"
                       placeholder="Search for characters, pages, and more..."
                       value="{{$q}}"/>
                @if($q)
                    <button class="btn col-md-1 rounded-circle clear_q"><i class="fa fa-times"></i></button>
                @endif
            </div>
        </div>
        <div class="container justify-content-center align-items-center">

            <div class="row">
                <div class="col-lg-4">
                    <h3>Categories</h3>
                    <div class="nav nav-pills faq-nav" id="faq-tabs" role="tablist"
                         aria-orientation="vertical">
                        @foreach($faq_category as $key => $f)
                            <a href="#tab{{ $f->id }}" class="nav-link {{$key == 0 ? 'active' : ''}}" data-toggle="pill"
                               role="tab" aria-controls="tab1" aria-selected="true">
                                <i class="mdi mdi-help-circle"></i>
                                {{ $f->category_name }}
                                <span class="ubadge">{{$q && count($faqs[$key]['data']) != 0 ? count($faqs[$key]['data']) : ''}}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="tab-content" id="faq-tab-content">
                        @foreach ($faqs as $key => $f)
                            <div class="tab-pane {{$key == 0 ? 'show active': ''}}" id="tab{{$f['id']}}" role="tabpanel"
                                 aria-labelledby="tab{{$f['id']}}">
                                <div class="accordion" id="accordion-tab-{{$f['id']}}">
                                    <h3>{{ $f['category_name'] }}</h3>
                                    @foreach($f['data'] as $k => $d)
                                        <div class="card">
                                            <div class="card-header"
                                                 id="accordion-tab-{{$f['id']}}-heading-1">
                                                <h5>
                                                    <button class="btn btn-link"
                                                            type="button" data-toggle="collapse"
                                                            data-target="#accordion-tab-{{$f['id']}}-content-{{$d->id}}"
                                                            aria-expanded="false"
                                                            aria-controls="accordion-tab-{{$f['id']}}-content-{{$d->id}}">{{$d->content}}</button>
                                                </h5>
                                            </div>
                                            <div class="collapse {{$k == 0 ? 'show' : ''}}"
                                                 id="accordion-tab-{{$f['id']}}-content-{{$d->id}}"
                                                 aria-labelledby="accordion-tab-{{$f['id']}}-heading-{{$d->id}}"
                                                 data-parent="#accordion-tab-{{$f['id']}}">
                                                <div class="card-body">
                                                    <p>
                                                        {!! $d->answer !!}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('additional_scripts')
    <script>
        $(document).ready(function () {
            $(".searchinput").keyup(function (e) {
                var keyword = $(this).val();
                if (e.keyCode == 13) {
                    window.location.replace('/faq?q=' + keyword);
                }
            });

            $(".clear_q").click(function () {
                window.location.replace('/faq');
            });
        });
    </script>
@endsection
