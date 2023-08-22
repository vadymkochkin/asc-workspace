@extends('templates.app')

@section('additional_headers')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
          integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous"/>
@endsection

@section('content')
    <div class="news-article">
        <section class="intro">
            <div class="article-bg">
            <!--<img class="article-background" src="{{ secure_asset($news->image) }}">-->
                <div class="article-background" style="background-image: url('{{ secure_asset($news->image) }}');">
                    <div class="article-splash"></div>
                </div>
                <div class="hero">
                    <h1 class="hero-title">{{$news->title}}</h1>
                    <span class="hero-author">BY {{$news->User->username}}</span>
                </div>

                <a href="#article-anchor" class="mousey">
                    <div class="scroller"></div>
                </a>
            </div>
        </section>

        <section class="article-widget">
            <!--<p class="widget-type">NEWS ARTICLE</p>-->
            <p class="widget-title">{{$news->title}}</p>
            <p class="widget-author">BY {{$news->User->username}}</p>
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                    <div class="glow"></div>
                </div>
            </div>
            <div class="row social-links">
                <i class="fab fa-facebook facebook-link links" data-link-type="facebook"></i>
                <i class="fab fa-twitter-square twitter-link links" data-link-type="twitter"></i>
                <i class="fab fa-vk vk-link links" data-link-type="vk"></i>
                <i class="fab fa-reddit reddit-link links" data-link-type="reddit"></i>
            </div>
        </section>

        <div class="mobile-progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            </div>
            <div class="row social-links">
                <i class="fab fa-facebook facebook-link links" data-link-type="facebook"></i>
                <i class="fab fa-twitter-square twitter-link links" data-link-type="twitter"></i>
                <i class="fab fa-vk vk-link links" data-link-type="vk"></i>
                <i class="fab fa-reddit reddit-link links" data-link-type="reddit"></i>
            </div>
        </div>

        <article>
            <div class="article-container" id="article-anchor">
                <div class="article-header">
                    <div class="container">
                        <h3 class="article-title">{{$news->title}}</h3>
                        <span class="article-author">BY {{$news->User->username}}</span>
                    </div>
                </div>

                <div class="article-body">
                    <div class="container">
                        {!! $news->description !!}
                    </div>
                </div>

                <div class="article-footer">
                    <div class="container">
                        <p>TAGS</p>
                        <ul>
                            @foreach ($tags as $tag)
                                <li>
                                    <a href="#">{{ $tag }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="article-comments">
                    <div class="container">
                        <h3>Comments ({{$total}})</h3>
                        <hr>
                        <ul class="comment-container">
                            @if (Auth::check())
                                <li class="comment">
                                    <form method="POST" action="{{ route('respond_to_news', [ $news->id ]) }}">
                                        {{ csrf_field() }}
                                        <div class="comment-wrapper">

                                            <div class="comment-head">
                                                <img class="comment-img"
                                                     src="https://cdn.discordapp.com/icons/215946029277642752/83be2a0e21431b2b76a832edfa1b1f5f.png?size=128">
                                                <div class="comment-info">
                                                    <ul>
                                                        <li class="comment-author">{{Auth::user()->username}}</li>
                                                        <li class="comment-character">{{Auth::user()->getAccessLevelString()}}</li>
                                                    </ul>
                                                    @if($news->is_locked == 1)
                                                        <i class="fa fa-lock" title="This article was locked"></i>
                                                    @else
                                                        <i class="fa fa-unlock" title="This article was not locked"></i>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="comment-body">
                                                @if (!Auth::user()->isNotPlayer() && $news->is_locked == 1)
                                                    <span class="error-text">This article was locked. You can not leave comment about this article.</span>
                                                @endif
                                                <textarea class="{{ $errors->has('response')?'error-input':'' }}" style="width:100%;height:auto;"
                                                          placeholder="Write a response text to the news"
                                                          name="response" {{!Auth::user()->isNotPlayer() && $news->is_locked == 1 ? 'readonly' : ''}}>{{ old('response') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row d-flex">
                                            <div class="col-12 mt-2 d-flex justify-content-end">
                                                <div class="form-group">
                                                    <input type="submit" value="Submit Response"
                                                           class="btn btn-primary" {{!Auth::user()->isNotPlayer() && $news->is_locked == 1 ? 'disabled' : ''}}>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                    </form>
                                </li>
                            @endif
                            <div class="infinite-scroll row">
                                @foreach($comments as $comment)
                                    @php $like_users = explode('::', $comment->like_users); @endphp
                                    <li class="comment col-12 {{$comment->User->isStaff($comment->User->id) == true ? 'staff' : ''}}">
                                        <div class="comment-wrapper">
                                            <div class="d-flex justify-content-end align-items-center">
                                                <span class="comment-likes">{{$comment->likes_num > 0 ? $comment->likes_num . '  users liked this.' : ($comment->likes_num == 0 ? '' : $comment->likes_num)}} </span>
                                                <div class="lottie {{Auth::user() && in_array(Auth::user()->id, $like_users) ? 'is-active' : ''}}" id="lottie_{{$comment->id}}"
                                                     style="width: 60px;" data-uid="{{$comment->id}}" data-like-num="{{$comment->likes_num}}"></div>
                                            </div>
                                            <div class="comment-head">
                                                <img class="comment-img"
                                                     src="https://cdn.discordapp.com/icons/215946029277642752/83be2a0e21431b2b76a832edfa1b1f5f.png?size=128">
                                                <div class="comment-info">
                                                    <ul>
                                                        <li class="comment-author">{{$comment->User->username}}</li>
                                                        <li class="comment-character">{{$comment->User->getAccessLevelDisplayString($comment->User->access_level)}}</li>
                                                        <li class="comment-date">{{ (new \Carbon\Carbon($comment->created_at))->diffForHumans() }}</li>
                                                    </ul>

                                                    <!-- <ul class="d-flex">
                                                        <li>
                                                            <span class="comment-likes">83 users liked this</span>
                                                        </li>
                                                        <li>
                                                            <div class="lottie" onclick=""></div>
                                                        </li>
                                                    </ul> -->
                                                </div>
                                            </div>
                                            <div class="comment-body">
                                                <p>{{$comment->comment}}</p>
                                            </div>
                                        </div>

                                        <hr>
                                    </li>
                                @endforeach
                                {{ $comments->links() }}
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </article>
    </div>
@endsection

@section('additional_scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('js/news/news-scroll.js') }}"></script>
    <script src="{{ asset('js/lottie/heart-anim.js') }}"></script>
    <script src="{{ secure_asset('js/shop/scroll/jqscroll.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4&appId=241110544128";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <script>
        $(".lottie").each(function (i) {
            let elementId = $(this).attr('id');
            heartAnim(elementId);
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#content-wrapper').css('padding-top', 0);

            // Social Links Part
            $(document).on('click', '.links', function () {
                let link_type = $(this).data('link-type');
                // link_url = window.location.href;
                let link_url = 'http://YourPageLink.com/6/details';
                let full_url = '';
                if (link_type == 'facebook') {
                    full_url = 'https://www.facebook.com/sharer/sharer.php?u=' + link_url + '&display=popup';
                } else if (link_type == 'twitter') {
                    full_url = 'https://twitter.com/intent/tweet?text=' + $('meta[property="twitter:title"]').attr('content') + '\n\n' + $('meta[property="twitter:description"]').attr('content') + '&url=' + link_url;
                } else if (link_type == 'vk') {
                    full_url = 'http://vk.com/share.php?url=' + link_url;
                } else if (link_type == 'reddit') {
                    full_url = 'https://www.reddit.com/submit?url=' + link_url;
                }
                window.open(full_url, '_blank', 400, 300);
            });
        })
    </script>
    <script type="text/javascript">
        $("ul.pagination").hide();
        $(function () {
            $(".infinite-scroll").jscroll({
                autoTrigger: true,
                loadingHtml:
                    '<img class="center-block" src="/media/image/shop/lazy-load.svg" alt="Loading..." />',
                padding: 0,
                nextSelector: ".pagination li.active + li a",
                contentSelector: "div.infinite-scroll",
                callback: function () {
                    $("ul.pagination").remove();
                }
            });
        });
        $(document).on('click', '.lottie', function () {

        });
    </script>

@endsection
