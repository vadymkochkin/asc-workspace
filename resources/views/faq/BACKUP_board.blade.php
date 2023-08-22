@extends('templates.app')

@section('content')
    <section id="faqboard">
        <div class="row searchrow">
            <input class="col-md-4 col-sm-12 form-control searchinput"
                   placeholder="Search for characters, pages, and more..." value="{{$q}}"/>
        </div>
        <div class="container justify-content-center align-items-center">
            <div class="mb-3 mt-3">
                <h1 class="display-4 mb-4">FREQUENTLY ASKED QUESTIONS</h1>
                <p class="lead mb-0 mb-3">This FAQ is here to answer all the questions you may have regarding to how our
                    website works. If you haven't found an answer here, you are always welcome to send us an email
                    through our support page.</p>
                <p class="lead mb-0">Please make sure you read our Terms of Use & Conditions.</p>

                <div class="clear"></div>
            </div>
            <div class="accordion" id="faqlist">
                @if(count($faqs) > 0)
                    @foreach($faqs as $key => $faq)
                        <div class="card">
                            <div class="card-header" id="heading{{$key}}">
                                <h5 class="mb-0" data-toggle="collapse" data-target="#collapse{{$key}}"
                                    aria-expanded="true" aria-controls="collapse{{$key}}">
                                    {{$faq->content}}
                                </h5>
                            </div>

                            <div id="collapse{{$key}}" class="collapse {{$key == 0 ? 'show' : ''}}"
                                 aria-labelledby="heading{{$key}}" data-parent="#faqlist">
                                <div class="card-body">
                                    {!!$faq->answer!!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            @if ($is_searched)
                <div class="load-container">
                    <div id="back-button">
                        VIEW ALL QUESTIONS
                    </div>
                </div>
            @endif
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
            $("#back-button").click(function () {
                window.location.replace('/faq');
            });
        });
    </script>
@endsection
