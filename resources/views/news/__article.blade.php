@extends('templates.app')

@section('additional_headers')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection

@section('content')
    <div class="news-article">
        <section class="intro">
            <div class="article-bg">
                <img class="article-background" src="{{ secure_asset('media/image/news/temp.jpg') }}">
                <div class="article-splash"></div>
            </div>
            <div class="hero">
                <h1 class="hero-title">TEMPLATE ARTICLE TITLE</h1>
                <span class="hero-author">BY AUTHOR HERE</span>
            </div>

            <a href="#article-anchor" class="mousey">
                <div class="scroller"></div>
            </a>

        </section>

        <section class="article-widget">
            <p class="widget-type">NEWS ARTICLE</p>
            <p class="widget-title">TEMPLATE ARTICLE TITLE HERE</p>
            <p class="widget-author">BY AUTHOR HERE</p>
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
        </section>

        <div class="mobile-progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            </div>
        </div>

        <article>
            <div class="article-container" id="article-anchor">
                <div class="article-header">
                    <div class="container">
                        <h3 class="article-title">TEMPLATE ARTICLE TITLE HERE</h3>
                        <span class="article-author">BY AUTHOR</span>
                    </div>
                </div>

                <div class="article-body">
                    <div class="container">
                        <p>Mark your calendars: WoW Classic goes live worldwide August 27! Whether your battle cry is
                            “For
                            the
                            Horde!” or “For the Alliance!”, there’s no shortage of adventure awaiting you in the vast
                            continents
                            of Kalimdor and the Eastern Kingdoms.</p>
                        <p>See below for details on the exact time you can log in and experience the origins of World of
                            Warcraft.</p>
                        <div class="table-container">
                            <table class="table text-center">
                                <thead>
                                <tr>
                                    <th scope="col">Americas (PDT)</th>
                                    <th scope="col">Europe (CEST)</th>
                                    <th scope="col">Taiwan (CST)</th>
                                    <th scope="col">Korea (KST)</th>
                                    <th scope="col">ANZ (AEST)</th>
                                    <th scope="col">UTC</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>3:00 p.m.</td>
                                    <td>12:00 a.m.</td>
                                    <td>6:00 a.m.</td>
                                    <td>7:00 a.m.</td>
                                    <td>8:00 a.m.</td>
                                    <td>10:00 p.m.</td>
                                </tr>
                                <tr>
                                    <td>August 26*</td>
                                    <td>August 27</td>
                                    <td>August 27</td>
                                    <td>August 27</td>
                                    <td>August 27</td>
                                    <td>August 26</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <img src="https://bnetcmsus-a.akamaihd.net/cms/content_entry_media/ui/UI5GHS0013QD1557845843113.jpg">
                        <hr>
                        <h3>Classic WoW Testing Schedule</h3>
                        <p>
                            Beginning May 15, select WoW players will be invited to participate in a small-scale,
                            focused
                            closed
                            beta test. Players will also get a chance to help put our servers and technology through
                            their
                            paces
                            in a series of stress tests running from May through July—you can opt in now through
                            <a href="#">Account Management</a>
                            and select the WoW Classic beta. Subsequent stress tests will extend the
                            opportunity to
                            even more players. Level caps will also be in place to ensure we’re emphasizing the “stress”
                            in
                            “stress test”
                        </p>
                        <p>
                            —we want to push our tech to the limit, and that means a critical mass of players in close
                            proximity.
                        </p>
                        <h5>STRESS TEST SCHEDULE*</h5>
                        <ul>
                            <li>Stress Test 1: Wed May 22–Thurs May 23</li>
                            <li>Stress Test 2: Wed Jun 19– Thurs Jun 20</li>
                            <li>Stress Test 3: Thurs Jul 18– Fri July 19</li>
                        </ul>
                        <p>*Dates of each stress test are subject to change.</p>
                        <p>
                            To fill our pool of beta and stress test participants, we’ll be choosing dedicated players
                            who
                            meet
                            select criteria from both the WoW Classic beta opt-in and the standard Warcraft beta opt-in.
                            Participants will also need to have an active subscription or active game time on their
                            Battle.net
                            Account. While opting-in to the beta is the primary way to make sure you’re in the running
                            to
                            join
                            the test it doesn’t guarantee an invitation to the closed beta test. We may also consider
                            additional
                            factors such as how long a player has been subscribed to the game so that we have the right
                            mix
                            of
                            players to ensure great feedback toward making WoW Classic the very best experience for the
                            community.
                        </p>
                        <hr>
                        <h3>Create Your Character</h3>
                        <p>If you’re eager to claim your character name in WoW Classic, take note: we’ll be opening
                            character
                            creation on Tuesday, August 13.** Players with an active subscription or game time on their
                            account
                            will be able to create up to three characters per World of Warcraft account. We’ll have more
                            information on realm names closer to launch, but rest assured—you’ll have plenty of time to
                            figure
                            out your plans for realm domination!</p>
                        <hr>
                        <p>
                            *To align with other regions, the Americas will launch slightly ahead of August 27 in local
                            time.
                            <br>
                            ** To align with other regions, the Americas character creation will occur slightly ahead of
                            August
                            13.
                        </p>
                    </div>
                </div>

                <div class="article-footer">
                    <div class="container">
                        <p>TAGS</p>
                        <ul>
                            <li>
                                <a href="#">WOW CLASSIC</a>
                            </li>

                            <li>
                                <a href="#">AUGUST 27</a>
                            </li>

                            <li>
                                <a href="#">TESTING</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="article-comments">
                    <div class="container">
                        <h3>Comments (1200)</h3>
                        <hr>
                        <ul class="comment-container">
                            <li class="comment">
                                <div class="comment-wrapper">

                                    <div class="comment-head">
                                        <img class="comment-img"
                                             src="https://cdn.discordapp.com/icons/215946029277642752/83be2a0e21431b2b76a832edfa1b1f5f.png?size=128">
                                        <div class="comment-info">
                                            <ul>
                                                <li class="comment-author">Username</li>
                                                <li class="comment-character">Member</li>
                                                <li class="comment-date">June 6th</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="comment-body">
                                        <p>If you’re eager to claim your character name in WoW Classic, take note: we’ll
                                            be
                                            opening character
                                            creation on Tuesday, August 13.** Players with an active subscription or
                                            game
                                            time
                                            on their account
                                            will be able to create up to three characters per World of Warcraft account.
                                            We’ll
                                            have more
                                            information on realm names closer to launch, but rest assured—you’ll have
                                            plenty
                                            of
                                            time to figure
                                            out your plans for realm domination!</p>
                                    </div>
                                </div>

                                <hr>
                            </li>

                            <li class="comment">
                                <div class="comment-wrapper">

                                    <div class="comment-head">
                                        <img class="comment-img"
                                             src="https://cdn.discordapp.com/icons/215946029277642752/83be2a0e21431b2b76a832edfa1b1f5f.png?size=128">
                                        <div class="comment-info">
                                            <ul>
                                                <li class="comment-author">Username</li>
                                                <li class="comment-character">Member</li>
                                                <li class="comment-date">June 6th</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="comment-body">
                                        <p>If you’re eager to claim your character name in WoW Classic, take note: we’ll
                                            be
                                            opening character
                                            creation on Tuesday, August 13.** Players with an active subscription or
                                            game
                                            time
                                            on their account
                                            will be able to create up to three characters per World of Warcraft account.
                                            We’ll
                                            have more
                                            information on realm names closer to launch, but rest assured—you’ll have
                                            plenty
                                            of
                                            time to figure
                                            out your plans for realm domination!</p>
                                    </div>
                                </div>

                                <hr>
                            </li>

                            <li class="comment">
                                <div class="comment-wrapper">

                                    <div class="comment-head">
                                        <img class="comment-img"
                                             src="https://cdn.discordapp.com/icons/215946029277642752/83be2a0e21431b2b76a832edfa1b1f5f.png?size=128">
                                        <div class="comment-info">
                                            <ul>
                                                <li class="comment-author">Username</li>
                                                <li class="comment-character">Member</li>
                                                <li class="comment-date">June 6th</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="comment-body">
                                        <p>If you’re eager to claim your character name in WoW Classic, take note: we’ll
                                            be
                                            opening character
                                            creation on Tuesday, August 13.** Players with an active subscription or
                                            game
                                            time
                                            on their account
                                            will be able to create up to three characters per World of Warcraft account.
                                            We’ll
                                            have more
                                            information on realm names closer to launch, but rest assured—you’ll have
                                            plenty
                                            of
                                            time to figure
                                            out your plans for realm domination!</p>
                                    </div>
                                </div>

                                <hr>
                            </li>

                            <li class="comment">
                                <div class="comment-wrapper">

                                    <div class="comment-head">
                                        <img class="comment-img"
                                             src="https://cdn.discordapp.com/icons/215946029277642752/83be2a0e21431b2b76a832edfa1b1f5f.png?size=128">
                                        <div class="comment-info">
                                            <ul>
                                                <li class="comment-author">Username</li>
                                                <li class="comment-character">Member</li>
                                                <li class="comment-date">June 6th</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="comment-body">
                                        <p>If you’re eager to claim your character name in WoW Classic, take note: we’ll
                                            be
                                            opening character
                                            creation on Tuesday, August 13.** Players with an active subscription or
                                            game
                                            time
                                            on their account
                                            will be able to create up to three characters per World of Warcraft account.
                                            We’ll
                                            have more
                                            information on realm names closer to launch, but rest assured—you’ll have
                                            plenty
                                            of
                                            time to figure
                                            out your plans for realm domination!</p>
                                    </div>
                                </div>

                                <hr>
                            </li>
                        </ul>

                        <div class="load-container">
                            <div id="load-button">
                                LOAD MORE COMMENTS
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </article>
    </div>
@endsection

@section('additional_scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('js/news/news-scroll.js') }}"></script>
    <script>
        AOS.init();
    </script>
@endsection