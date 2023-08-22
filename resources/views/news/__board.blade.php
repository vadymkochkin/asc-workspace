@extends('templates.app')

@section('pageTitle', 'News - ')

@section('additional_headers')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection

@section('content')
    <div class="newsboard">
    <section class="main">
        <div class="container">
            <div class="row">
                <div class="wrapper d-flex hidden-lg-down">
                    <div class="col-6 left-container">
                        <div class="row d-flex">
                            <div class="col-6 news-item">
                                <a href="{{ route('article') }}">
                                    <div class="item-container">
                                        <img class="item-img"
                                             src="https://bnetcmsus-a.akamaihd.net/cms/blog_header/zx/ZXO3O59N4MO11552938269816.jpg">
                                        <div class="description-container">
                                            <div class="item-description">
                                                <span class="item-type">NEWS ARTICLE</span>
                                                <br>
                                                <h3 class="item-title">TEMPLATE ARTICLE TITLE</h3>
                                            </div>
                                            <div class="item-fold">
                                                READ NOW
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 news-item">
                                <a href="{{ route('article') }}">
                                    <div class="item-container">
                                        <img class="item-img"
                                             src="https://bnetcmsus-a.akamaihd.net/cms/blog_header/ax/AXOMFQHMDMTE1558474329961.jpg">
                                        <div class="description-container">
                                            <div class="item-description">
                                                <span class="item-type">NEWS ARTICLE</span>
                                                <br>
                                                <h3 class="item-title">TEMPLATE ARTICLE TITLE</h3>
                                            </div>
                                            <div class="item-fold">
                                                READ NOW
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 news-item">
                                <a href="{{ route('article') }}">
                                    <div class="item-container">
                                        <img class="item-img"
                                             src="https://bnetcmsus-a.akamaihd.net/cms/carousel_header/3i/3IM700MHJ6H71472657259360.jpg">
                                        <div class="description-container">
                                            <div class="item-description">
                                                <span class="item-type">NEWS ARTICLE</span>
                                                <br>
                                                <h3 class="item-title">TEMPLATE ARTICLE TITLE</h3>
                                            </div>
                                            <div class="item-fold">
                                                READ NOW
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 news-item">
                                <a href="{{ route('article') }}">
                                    <div class="item-container">
                                        <img class="item-img"
                                             src="https://bnetcmsus-a.akamaihd.net/cms/blog_header/82/82D219CRWJQ41554752981834.jpg">
                                        <div class="description-container">
                                            <div class="item-description">
                                                <span class="item-type">NEWS ARTICLE</span>
                                                <br>
                                                <h3 class="item-title">TEMPLATE ARTICLE TITLE</h3>
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

                    <div class="col-6 right-container">
                        <div class="row d-flex">
                            <div class="col-12 news-item">
                                <a href="{{ route('article') }}">
                                    <div class="item-container">
                                        <img class="item-img"
                                             src="https://bnetcmsus-a.akamaihd.net/cms/blog_header/l6/L6HVAYFC3G5F1557790551649.jpg">
                                        <div class="description-container">
                                            <div class="item-description">
                                                <span class="item-type">NEWS ARTICLE</span>
                                                <br>
                                                <h3 class="item-title">TEMPLATE ARTICLE TITLE</h3>
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
                </div>

                <div class="col-12 mobile-wrapper hidden-md-up">
                    <div class="col-12 news-item">
                        <a href="{{ route('article') }}">
                            <div class="item-container"
                                 style="background-image: url('https://bnetcmsus-a.akamaihd.net/cms/blog_header/l6/L6HVAYFC3G5F1557790551649.jpg')">
                                <div class="description-container">
                                    <div class="item-description">
                                        <span class="item-type">NEWS ARTICLE</span>
                                        <br>
                                        <h3 class="item-title">TEMPLATE ARTICLE TITLE</h3>
                                    </div>
                                    <div class="item-fold">
                                        READ NOW
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-12 news-item">
                        <a href="{{ route('article') }}">
                            <div class="item-container"
                                 style="background-image: url('https://bnetcmsus-a.akamaihd.net/cms/blog_header/zx/ZXO3O59N4MO11552938269816.jpg')">
                                <div class="description-container">
                                    <div class="item-description">
                                        <span class="item-type">NEWS ARTICLE</span>
                                        <br>
                                        <h3 class="item-title">TEMPLATE ARTICLE TITLE</h3>
                                    </div>
                                    <div class="item-fold">
                                        READ NOW
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-12 news-item">
                        <a href="{{ route('article') }}">
                            <div class="item-container"
                                 style="background-image: url('https://bnetcmsus-a.akamaihd.net/cms/blog_header/ax/AXOMFQHMDMTE1558474329961.jpg')">
                                <div class="description-container">
                                    <div class="item-description">
                                        <span class="item-type">NEWS ARTICLE</span>
                                        <br>
                                        <h3 class="item-title">TEMPLATE ARTICLE TITLE</h3>
                                    </div>
                                    <div class="item-fold">
                                        READ NOW
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-12 news-item">
                        <a href="{{ route('article') }}">
                            <div class="item-container"
                                 style="background-image: url('https://bnetcmsus-a.akamaihd.net/cms/carousel_header/3i/3IM700MHJ6H71472657259360.jpg')">
                                <div class="description-container">
                                    <div class="item-description">
                                        <span class="item-type">NEWS ARTICLE</span>
                                        <br>
                                        <h3 class="item-title">TEMPLATE ARTICLE TITLE</h3>
                                    </div>
                                    <div class="item-fold">
                                        READ NOW
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-12 news-item">
                        <a href="{{ route('article') }}">
                            <div class="item-container"
                                 style="background-image: url('https://bnetcmsus-a.akamaihd.net/cms/blog_header/82/82D219CRWJQ41554752981834.jpg')">
                                <div class="description-container">
                                    <div class="item-description">
                                        <span class="item-type">NEWS ARTICLE</span>
                                        <br>
                                        <h3 class="item-title">TEMPLATE ARTICLE TITLE</h3>
                                    </div>
                                    <div class="item-fold">
                                        READ NOW
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="sub-articles">
                    <ul class="article-list">
                        <li class="article">
                            <a href="{{ route('article') }}" class="d-flex">
                                <div class="thumbnail"
                                     style="background-image: url('https://bnetcmsus-a.akamaihd.net/cms/blog_thumbnail/hm/HMTPLAJHFQ7V1559870478841.jpg')">
                                </div>
                                <div class="article-content">
                                    <h3 class="article-title">Postcard from the MDI Spring Finals: East meets West</h3>
                                    <p class="article-description">The teams have landed in Sydney and are preparing for
                                        the
                                        first day of competition. </p>
                                    <span class="article-date">15 hours ago</span>
                                </div>
                            </a>
                        </li>

                        <li class="article">
                            <a href="{{ route('article') }}" class="d-flex">
                                <div class="thumbnail"
                                     style="background-image: url('https://bnetcmsus-a.akamaihd.net/cms/blog_thumbnail/v8/V8JQG32GQ4J51559771840422.jpg')">
                                </div>
                                <div class="article-content">
                                    <h3 class="article-title">Many New Treasures Await in Rise of Azshara</h3>
                                    <p class="article-description">Rise of Azshara introduces a treasure trove of new
                                        mounts,
                                        pets, toys, and gear to earn and collect. We’ve rounded up a selection of what’s
                                        waiting
                                        to be discovered. </p>
                                    <span class="article-date">a day ago</span>
                                </div>
                            </a>
                        </li>

                        <li class="article">
                            <a href="{{ route('article') }}" class="d-flex">
                                <div class="thumbnail"
                                     style="background-image: url('https://bnetcmsus-a.akamaihd.net/cms/blog_thumbnail/4g/4GFXH0FXYJ7I1496692891720.jpg')">
                                </div>
                                <div class="article-content">
                                    <h3 class="article-title">The Thousand Boat Bash Micro Holiday Arrives June
                                        6-8!</h3>
                                    <p class="article-description">Micro-holidays provide a variety of in-game
                                        experiences
                                        simply for the fun of taking part in them. Read on to learn about more. </p>
                                    <span class="article-date">2 days ago</span>
                                </div>
                            </a>
                        </li>

                        <li class="article">
                            <a href="{{ route('article') }}" class="d-flex">
                                <div class="thumbnail"
                                     style="background-image: url('https://bnetcmsus-a.akamaihd.net/cms/blog_thumbnail/nl/NL2PXTJ5ONJP1556848347119.jpg')">
                                </div>
                                <div class="article-content">
                                    <h3 class="article-title"> 2019 Commemorative Collectible – Presale Extended to June
                                        19!
                                    </h3>
                                    <p class="article-description">We’ve extended the deadline to pre-purchase an Orc
                                        Grunt
                                        or
                                        Human Footman statue to June 19. Learn more about this limited run, and check
                                        out a
                                        new
                                        video that gives you a closer look at the statues. </p>
                                    <span class="article-date">3 days ago</span>
                                </div>
                            </a>
                        </li>
                    </ul>

                    <div class="load-container">
                        <div id="load-button">
                            LOAD MORE ARTICLES
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    </div>
@endsection

@section('additional_scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
@endsection
