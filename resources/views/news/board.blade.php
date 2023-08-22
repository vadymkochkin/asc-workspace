@extends('templates.app')

@section('pageTitle', 'News - ')

@section('additional_headers')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('content')
    <div class="newsboard">
        <div class="row searchrow">
            <input class="col-md-4 col-10 form-control searchinput" id="searchinput"
                   placeholder="Search for characters, pages, and more..." value="{{$q}}"/>
        </div>
        <section class="main">
            <div class="container">
                <div class="row">
                    <div class="wrapper row">

                        <div class="col-xl-6 col-lg-6 col-12 left-container">
                            <div class="row d-flex">
                                <?php $isFirst = true; ?>
                                @foreach($top_news as $news)
                                    <?php
                                    if ($isFirst) {
                                        $isFirst = false;
                                        continue;
                                    }
                                    ?>
                                    <div class="col-xl-6 col-lg-6 col-12 news-item">
                                        <a href="{{ route('detail', [ $news->id ]) }}">
                                            <div class="item-container">
                                                <img class="item-img"
                                                     src="{{$news->image}}">
                                                <div class="description-container">
                                                    <div class="item-description">
                                                        <span class="item-type">NEWS ARTICLE</span>
                                                        <br>
                                                        <h3 class="item-title">{{$news->title}}</h3>
                                                    </div>
                                                    <div class="item-fold">
                                                        READ NOW
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @isset($top_news[0])
                            <div class="col-xl-6 col-lg-6 col-12 right-container">
                                <div class="row d-flex">
                                    <div class="col-12 news-item">
                                        <a href="{{ route('detail', [ $top_news[0]->id ]) }}">
                                            <div class="item-container" style="background-image: url({{$top_news[0]->image}})">
                                                <div class="description-container">
                                                    <div class="item-description">
                                                        <span class="item-type">NEWS ARTICLE</span>
                                                        <br>
                                                        <h3 class="item-title">{{$top_news[0]->title}}</h3>
                                                    </div>
                                                    <div class="item-fold">
                                                        READ NOW
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                    @endisset

                    <!-- end of first grid -->

                    </div>

                    <div class="sub-articles">
                        <ul class="article-list">
                            @foreach($sub_articles as $article)
                                <li class="article">
                                    <a href="{{ route('detail', [ $article->id ]) }}" class="d-flex">
                                        <div class="thumbnail"
                                             style="background-image: url({{$article->image}})">
                                        </div>
                                        <div class="article-content">
                                            <h3 class="article-title">{{$article->title}}</h3>
                                            <p class="article-description">{{substr(strip_tags($article->description), 0, 300)}}</p>

                                            <span class="article-date">{{ (new \Carbon\Carbon($article->created_at))->diffForHumans() }}</span>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        @if (!$is_searched)
                            <div class="load-container">
                                <div id="load-button">
                                    LOAD MORE ARTICLES
                                </div>
                            </div>
                        @else
                            <div class="load-container">
                                <div id="back-button">
                                    VIEW ALL ARTICLES
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection

@section('additional_scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        AOS.init();
        // $(".searchinput").keyup(function (e) {
        //     var keyword = $(this).val();
        //     if (e.keyCode == 13) {
        //         window.location.replace("/news?q=" + keyword);
        //     }
        // });
        $("#back-button").click(function () {
            window.location.replace('/news');
        });

        $(document).ready(function() {
            $("#searchinput").autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "{{ route('news.news_search') }}",
                        type: "POST",
                        CrossDomain: true,
                        dataType: "json",
                        data: {
                            q: $("#searchinput").val(),
                            _token: '{{ csrf_token() }}'
                        },
                        success: response,
                        error: function (result) {
                            alert("Error");
                        }
                    });
                },
                focus: function (event, ui) {
                    $("#searchinput").val(ui.item.desc);
                    return true;
                },
                select: function (event, ui) {
                    $("#searchinput").val('');
                    return false;
                }
            }).autocomplete("instance")._renderItem = function (ul, item) {
                return $("<li>")
                    .data("item.autocomplete", item)
                    .append('<div>' + item.label + '</div>')
                    .appendTo(ul);
            };
        })

    </script>
@endsection
