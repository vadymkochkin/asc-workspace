@extends('templates.app')

@section('additional_headers')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('content')
<div id="page-img-container">
    <img id="page-background" src="{{ asset('media/image/backgrounds/background_15.png')}}">
</div>
    @include('templates.store_header')
    <div class="modal fade" id="manage-order" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="manage-order-modal modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="manange-order-header">Order Featured Items</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="manage-order-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-asc p-fix" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn-asc p-fix" id="update-order">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div id="LoadingImage" style="display: none; z-index: 99998; left:0; top:0; overflow: hidden; width: 100%; height: 100% ; background-color: #000000CC; position:fixed;">
        <img style="margin-left:-50px; margin-top:-50px; z-index: 99999; left:50%; top: 50%; position:absolute; border: 2px solid #c9aa71; border-radius:50%; padding: 5px;" src="{{url('/media/image/shop/ajax-loader.gif')}}"/>
    </div>
    <section id="shop">
        <div class="row justify-content-center align-items-center">
            <div class="container animated fadeInUp faster">

                <div class="row">
                    <div class="col-10 shop-header">
                        <h1 id="shop-type" realm-id="{{$realm_id}}">Featured</h1>
                    </div>
                    <div class="col-2 mt-1">
                        <button type="button" class="btn-asc p-fix float-right manage-featured">Manage</button>
                    </div>
                </div>
                <div class="shop-intro row col-12">
                    @if(isset($featured_items[0]))
                        <div class="shop-main col-xl-7 col-lg-12 col-12 asc-shop-hover"
                             onclick="window.location.href='{{ url('store/'.$featured_items[0]->StoreItem->Realm->slug.'/'.$featured_items[0]->StoreItem->Group->slug.'/'.$featured_items[0]->StoreItem->id)}}'">
                            <div class="shop-item-large">
                                <img src="{{url('/media/image/shop/lazy-load.svg')}}" data-src="{{$featured_items[0]->StoreItem->featured_image}}">
                                <div class="shop-item-large-desc justify-content-center">
                                    <div class="shop-item-title justify-content-center">
                                        <h4>NEW ITEM</h4>
                                        <h5>{{$featured_items[0]->StoreItem->name}}</h5>
                                        <p>{{$featured_items[0]->StoreItem->description}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="shop-side col-xl-5 col-lg-5 col-12">
                        <div class="shop-side-upper col-12 d-flex">
                            @if(isset($featured_items[1]))
                                <div class="shop-item-l col-6 asc-shop-hover">
                                    <a href="{{ url('store/'.$featured_items[1]->StoreItem->Realm->slug.'/'.$featured_items[1]->StoreItem->Group->slug.'/'.$featured_items[1]->StoreItem->id)}}">
                                        <img src="{{url('/media/image/shop/lazy-load.svg')}}" data-src="{{$featured_items[1]->StoreItem->featured_image}}">
                                        <div class="shop-item-desc">
                                            <div class="shop-item-title justify-content-center d-flex">
                                                <h5>{{$featured_items[1]->StoreItem->name}}</h5>
                                            </div>

                                            <div class="shop-item-price justify-content-center d-flex">
                                                <div class="row p-0">
                                                    <img class="price-icon" src="../media/icon/dp.svg">
                                                    <span class="price-value">{{$featured_items[1]->StoreItem->dp_price}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                            @if(isset($featured_items[2]))
                                <div class="shop-item-r col-6 asc-shop-hover">
                                    <a href="{{ url('store/'.$featured_items[2]->StoreItem->Realm->slug.'/'.$featured_items[2]->StoreItem->Group->slug.'/'.$featured_items[2]->StoreItem->id)}}">
                                        <img src="{{url('/media/image/shop/lazy-load.svg')}}" data-src="{{$featured_items[2]->StoreItem->featured_image}}">
                                        <div class="shop-item-desc justify-content-center">
                                            <div class="shop-item-title justify-content-center d-flex">
                                                <h5>{{$featured_items[2]->StoreItem->name}}</h5>
                                            </div>

                                            <div class="shop-item-price justify-content-center d-flex">
                                                <div class="row p-0">
                                                    <img class="price-icon" src="../media/icon/dp.svg">
                                                    <span class="price-value">{{$featured_items[2]->StoreItem->dp_price}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div class="shop-side-lower d-flex">
                            @if(isset($featured_items[3]))
                                <div class="shop-item-l col-6 asc-shop-hover">
                                    <a href="{{ url('store/'.$featured_items[3]->StoreItem->Realm->slug.'/'.$featured_items[3]->StoreItem->Group->slug.'/'.$featured_items[3]->StoreItem->id)}}">
                                        <img src="{{url('/media/image/shop/lazy-load.svg')}}" data-src="{{$featured_items[3]->StoreItem->featured_image}}">
                                        <div class="shop-item-desc">
                                            <div class="shop-item-title justify-content-center d-flex">
                                                <h5>{{$featured_items[3]->StoreItem->name}}</h5>
                                            </div>

                                            <div class="shop-iem-price justify-content-center d-flex">
                                                <div class="row p-0">
                                                    <img class="price-icon" src="../media/icon/dp.svg">
                                                    <span class="price-value">{{$featured_items[3]->StoreItem->dp_price}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                            @if(isset($featured_items[4]))
                                <div class="shop-item-r col-6 asc-shop-hover">
                                    <a href="{{ url('store/'.$featured_items[4]->StoreItem->Realm->slug.'/'.$featured_items[4]->StoreItem->Group->slug.'/'.$featured_items[4]->StoreItem->id)}}">
                                        <img src="{{url('/media/image/shop/lazy-load.svg')}}" data-src="{{$featured_items[4]->StoreItem->featured_image}}">
                                        <div class="shop-item-desc justify-content-center">
                                            <div class="shop-item-title justify-content-center d-flex">
                                                <h5>{{$featured_items[4]->StoreItem->name}}</h5>
                                            </div>

                                            <div class="shop-item-price justify-content-center d-flex">
                                                <div class="row p-0">
                                                    <img class="price-icon" src="../media/icon/dp.svg">
                                                    <span class="price-value">{{$featured_items[4]->StoreItem->dp_price}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="shop-bestSellers mt-3 px-2">
                    <div class="shop-side">
                        <div class="shop-side-upper row">
                          @foreach($more_featured as $item)
                            <div class="px-2 pb-2 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                                <a href="{{ url('store/'.$item->StoreItem->Realm->slug.'/'.$item->StoreItem->Group->slug.'/'.$item->StoreItem->id)}}">
                                    <div class="shop-item-seller asc-shop-hover" style="border: 1px solid #32281f">
                                        <img src="{{url('/media/image/shop/lazy-load.svg')}}" data-src="{{$item->StoreItem->featured_image}}">
                                        <div class="shop-item-desc justify-content-center" style="background:#111111E6 !important">
                                            <div class="shop-item-title justify-content-center d-flex">
                                                <h5>{{$item->StoreItem->name}}</h5>
                                            </div>

                                            <div class="shop-item-price justify-content-center d-flex">
                                                <img class="price-icon" src="../media/icon/dp.svg">
                                                <span class="price-value">{{$item->StoreItem->dp_price}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class = "row">
                    <div class="shop-sub-header col-12">
                        <h1 id="shop-type">BEST SELLERS</h1>
                    </div>
                    <div class="shop-bestSellers col-12 mx-2 d-flex">
                        <div class="shop-side col-12 d-flex">
                            <div class="shop-side-upper col-12 row">
                              @foreach($best_sellers as $best_seller)
                                <div class="px-2 pb-2 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                                    <a href="{{ url('store/'.$best_seller->store_items->Realm->slug.'/'.$best_seller->store_items->Group->slug.'/'.$best_seller->store_items->id)}}">
                                        <div class="shop-item-seller asc-shop-hover" style="border: 1px solid #32281f">
                                            <img src="{{url('/media/image/shop/lazy-load.svg')}}" data-src="{{$best_seller->store_items->featured_image}}">
                                            <div class="shop-item-desc justify-content-center">
                                                <div class="shop-item-title justify-content-center d-flex">
                                                    <h5>{{$best_seller->store_items->name}}</h5>
                                                </div>

                                                <div class="shop-item-price justify-content-center d-flex">
                                                    <img class="price-icon" src="../media/icon/dp.svg">
                                                    <span class="price-value">{{$best_seller->store_items->dp_price}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
@endsection

@section('additional_scripts')
    <script src="{{ asset('js/shop/shop-anim.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ secure_asset('js/lazyload.js') }}"></script>
    <script src="{{ asset('js/manage-order.js') }}"></script>
    <script>
        var items;
        {{--$.ajax({--}}
        {{--    url: "{{ route('manage_store.realms_item_search') }}",--}}
        {{--    type: "POST",--}}
        {{--    CrossDomain: true,--}}
        {{--    dataType: "json",--}}
        {{--    data: {--}}
        {{--        realm_id: {{$realm_id}},--}}
        {{--        _token: '{{ csrf_token() }}'--}}
        {{--    }--}}


        {{--}).done(function (datam) {--}}
        {{--    items = datam;--}}
        {{--    //console.log(datam);--}}
        {{--});--}}
        $(document).ready(function () {
            $("#txtinput").autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "{{ route('manage_store.realms_item_search') }}",
                        type: "POST",
                        CrossDomain: true,
                        dataType: "json",
                        data: {
                            realm_id: {{$realm_id}},
                            realm_txt: $("#txtinput").val(),
                            _token: '{{ csrf_token() }}'
                        },
                        success: response,
                        error: function (result) {
                            alert("Error");
                        }
                    });
                },
                focus: function (event, ui) {
                    $("#txtinput").val(ui.item.desc);
                    return true;
                },
                select: function (event, ui) {
                    $("#txtinput").val('');
                    return false;
                }
            }).autocomplete("instance")._renderItem = function (ul, item) {
                return $("<li>")
                    .data("item.autocomplete", item)
                    .append('<div>' + item.label + '</div>')
                    .appendTo(ul);
            };
        });
    </script>
@endsection
