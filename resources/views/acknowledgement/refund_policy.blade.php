@extends('templates.app')

@section('pageTitle', "Refund Policy - ")

@section('additional_headers')
    <link rel="stylesheet" href="{{ secure_asset('css/acknowledgement.css') }}"/>
@endsection

@section('content')
    <section id="news">
        <div class="container-fluid">
            <div class="row h-100 justify-content-center align-items-center">
                <!--<h1 class="animated fadeIn">Did you notice the page transition?</h1>-->
                <div class="container animated fadeInUp faster">
                    <div class="news-header align-items-center d-flex">
                        <a href="#back" class="d-flex">
                            <i class="material-icons">keyboard_backspace</i>
                            <h5>Return</h5>
                        </a>
                    </div>

                    <div class="news-title justify-content-center">
                        <div class="col-12">
                            <h1>Refund Policy</h1>
                            <div class="news-info d-flex justify-content-center">
                                <h2>December 12th by </h2>
                                <h2 class="news-author">Ascension</h2>
                            </div>
                        </div>
                    </div>


                    <div class="news-content justify-content-center align-items-center">
                        <h4>Refund Policy</h4>

                        <p>IN THIS AGREEMENT THE FOLLOWING TERMS WILL HAVE THE FOLLOWING MEANINGS</p>

                        <p>"ACCOUNT" MEANS COLLECTIVELY THE PERSONAL INFORMATION AND CREDENTIALS USED BY USERS TO ACCESS
                            COINS, VIRTUAL ITEMS AND / OR ANY COMMUNICATIONS SYSTEMS ON THIS WEBSITE;</p>

                        <p>"LICENCE" MEANS THE TERMS AND CONDITIONS GOVERNING YOUR USE OF COINS, VIRTUAL ITEMS OR
                            SERVICES PURCHASED FROM THIS WEBSITE;</p>

                        <p>"VIRTUAL ITEMS" MEANS, IN-GAME VIRTUAL ITEMS THAT ASCENSION. DELIVERS THROUGH USE OF THE
                            WEBSITE STORE IN EXCHANGE OF COINS;</p>

                        <p>"UNUSED VIRTUAL ITEM" MEANS A VIRTUAL ITEM PURCHASED FROM A DESIGNATED VIRTUAL SHOP THAT IS
                            KEPT INSIDE OF IN-GAME MAILBOX AND NEVER WITHDRAWN OUT OF IT.</p>

                        <p>"COIN" MEANS VIRTUAL COINS THAT ASCENSION MAKES AVAILABLE FOR PURCHASE BY USERS SUBJECT TO
                            THE TERMS OF THE APPROPRIATE LICENSE. ALL OBTAINED COINS ARE VALID FOR 30 CALENDAR DAYS;</p>

                        <p>"SERVICE" MEANS COLLECTIVELY ANY ONLINE FACILITIES, TOOLS, SERVICES OR INFORMATION THAT
                            ASCENSION. MAKES AVAILABLE THROUGH THE WEBSITE EITHER NOW OR IN THE FUTURE;</p>

                        <p>"PAYMENT INFORMATION" MEANS ANY DETAILS REQUIRED FOR THE PURCHASE OF COINS FROM THIS WEBSITE.
                            THIS INCLUDES, BUT IS NOT LIMITED TO, NAMES, ADDRESSES, CREDIT / DEBIT CARD NUMBERS, BANK
                            ACCOUNT NUMBERS AND SORT CODES;</p>

                        <p>"PURCHASE INFORMATION" MEANS COLLECTIVELY ANY ORDERS, INVOICES, CONFIRMATION EMAILS, RECEIPTS
                            OR SIMILAR THAT MAY BE IN HARD COPY OR ELECTRONIC FORM;</p>

                        <p>"SYSTEM" MEANS ANY ONLINE COMMUNICATIONS INFRASTRUCTURE THAT ASCENSION. MAKES AVAILABLE
                            THROUGH THE WEBSITE EITHER NOW OR IN THE FUTURE. THIS INCLUDES, BUT IS NOT LIMITED TO,
                            WEB-BASED EMAIL, MESSAGE BOARDS, LIVE CHAT FACILITIES AND EMAIL LINKS;</p>

                        <p>"USER" / "USERS" MEANS ANY THIRD PARTY THAT ACCESSES THE WEBSITE AND IS NOT EMPLOYED BY
                            ASCENSION. AND ACTING IN THE COURSE OF THEIR EMPLOYMENT;</p>

                        <p>"WEBSITE" MEANS THE WEBSITE THAT YOU ARE CURRENTLY USING WWW.PROJECT-ASCENSION.COM AND ANY
                            SUB-DOMAINS OF THIS SITE (E.G. SUBDOMAIN FORUM.PROJECT-ASCENSION.COM) UNLESS EXPRESSLY
                            EXCLUDED BY THEIR OWN TERMS AND CONDITIONS.</p>

                        <p>PROJECT-ASCENSION AIMS TO ALWAYS PROVIDE HIGH QUALITY VIRTUAL ITEMS (OBTAINED IN EXCHANGE FOR
                            COINS) THAT IS FAULT FREE. FAULTS INCLUDE AND ARE NOT LIMITED TO DATA CORRUPTION.</p>

                        <p>THIS REFUND POLICY COVERS ONLY FAULTS THAT IMPAIR THE USE OF THE COINS.</p>

                        <p>THIS REFUND POLICY DOES NOT COVER USE DIFFICULTIES ARISING OUT OF ISSUES SUCH AS FILE
                            INCOMPATIBILITY OR MINOR MISTAKES IN VIRTUAL ITEMS ITSELF SUCH AS SPELLING ERRORS OR
                            GRAPHICAL FAULTS THAT DO NOT RESULT FROM DATA CORRUPTION.</p>

                        <p>COINS CANNOT BE EXCHANGED BACK INTO A CURRENCY. PURCHASES OF COINS SETS ARE NOT
                            REFUNDABLE.</p>

                        <p>IF A PURCHASED SET OF COINS IS NOT EXCHANGED INTO THE VIRTUAL ITEMS DURING 30 CALENDAR DAYS
                            IT THEN IS NO LONGER VALID AND CANNOT BE A SUBJECT OF REFUND. REFUND REQUESTS OF COINS
                            PURCHASES WITHIN 30 CALENDAR DAYS ARE AT THE EXCLUSIVE DISCRETION OF ASCENSION. MANAGEMENT.
                            IF A VIRTUAL ITEM WAS GIVEN TO A USER ON TERMS OF BONUS, GIFT OR PROMOTION THEN IT CANNOT BE
                            A SUBJECT OF REFUND INTO COINS.</p>

                        <p>IF A VIRTUAL ITEM CONTAINS FAULTS ON RECEIVING, YOU SHOULD INFORM ASCENSION. IMMEDIATELY AND
                            MUST INFORM US WITHIN 24 HOURS OF RECEIVING IN ORDER TO RECEIVE COINS BACK EQUAL TO THE
                            PURCHASE PRICE OF THE RELEVANT VIRTUAL ITEM. ANY NOTIFICATION RECEIVED OUTSIDE OF THIS TIME
                            PERIOD IS AT THE EXCLUSIVE DISCRETION OF ASCENSION. MANAGEMENT.</p>

                        <p>ACCIDENTAL PURCHASES OF COINS OCCURRED AS A RESULT OF TECHNICAL FAULT IN THE PAYMENT SYSTEM
                            YOU PAID THROUGH MUST BE DISPUTED WITH THE RESPECTIVE PAYMENT PROCESSOR. ASCENSION. IS NOT
                            RESPONSIBLE FOR ANY TECHNICAL FAULTS ARISING AT PAYMENT PROCESSORS. ASCENSION. IS NOT IN
                            CHARGE OF HANDLING CREDIT/DEBIT AND BANK TRANSACTIONS UNDERTAKEN TO PURCHASE COINS.</p>

                        <p>WHERE ANY REFUND IS ISSUED UNDER ANY CIRCUMSTANCES, ASCENSION. RESERVES THE RIGHT TO SUSPEND
                            OR TERMINATE THE RESPECTIVE ACCOUNT WITH THE WEBSITE.</p>

                        <h5>CONTACTING US</h5>
                        <p>FOR ALL ENQUIRIES ABOUT THE STATUS OF YOUR ORDERS, PLEASE CONTACT US:
                        <ul>
                            <li>donations@project-ascension.com</li>
                        </ul>
                        </p>
                    </div>

                    <div class="news-footer align-items-center d-flex justify-content-center">
                        <a href="#top"><h5>Back to top</h5></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('additional_scripts')
    <script src="{{ asset('js/preloader.js') }}"></script>
    <script src="{{ asset('js/news/news-anim.js') }}"></script>
@endsection
