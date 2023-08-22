@extends('templates.app')

@section('pageTitle', $targetedMenu . ' - ')

@section('additional_headers')
    <!-- jquery autocomplete assets for auto complete -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('content')
    @include('templates.store_header')
    <input type="hidden" id="item_info" realm="{{$current_realm->realm_name}}" realm-id="{{$current_realm->id}}"
           group="{{$current_group->title}}" group_id="{{$current_group->id}}">
    <div id="LoadingImage"
         style="display: none; z-index: 99998; left:0; top:0; overflow: hidden; width: 100%; height: 100% ; background-color: #000000CC; position:fixed;">
        <img style="margin-left:-50px; margin-top:-50px; z-index: 99999; left:50%; top: 50%; position:absolute; border: 2px solid #c9aa71; border-radius:50%; padding: 5px;"
             src="{{url('/media/image/shop/ajax-loader.gif')}}"/>
    </div>
    <div class="modal fade" id="item-editor" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Item Editor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="item-editor-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-asc p-fix" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn-asc p-fix" id="preview">Preview</button>
                    <button type="button" class="btn-asc p-fix" add-new="" id="item-update">Update</button>
                </div>
            </div>
        </div>
    </div>
    <section id="shop">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="container animated fadeInUp faster">
                @if (Auth::user()->canModerateItems())
                    <div class="row">
                        <div class="col-10 shop-header">
                            <h1 id="shop-type" realm="{{$current_realm->id}}">{{$targetedMenu}}</h1>
                        </div>
                        <div class="col-2 mt-1">
                            <button type="button" class="btn-asc p-fix float-right item-add">Add New</button>
                        </div>
                    </div>
                @endif
                <div class="shop-intro">
                    <div class="infinite-scroll row">
                        @if(count($items) == 0)
                            <div class="noitems"><a href="javascript:window.history.back()"><u>This Store seems to be empty!</u></a></div>
                        @endif

                        <!--TODO RE-ADD ANIMATIONS-->
                        @foreach($items as $item)
                            <div class="shop-item col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="img-container">

                                    @if (Auth::user()->canModerateItems())
                                    <div class="dropdown item-action-dropdown">
                                      <button class="btn drop-item-btn dropdown-toggle" type="button" id="track{{$item->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                      </button>
                                      <div class="dropdown-menu drop-item" aria-labelledby="track{{$item->id}}" u-id="{{$item->id}}">
                                        <a class="dropdown-item item-edit">Edit</a>
                                        <a class="dropdown-item item-duplicate">Duplicate</a>
                                        <a class="dropdown-item item-featured">Add to Featured</a>
                                        <a class="dropdown-item item-limited">Add to Limited</a>
                                        <a class="dropdown-item item-delete">Delete</a>
                                      </div>
                                    </div>
                                    @endif

                                    <a href="{{ url('store/'.$realm_slug.'/'.$menus_slug.'/'.$item->id)}}">
                                        <img class="img-fix" data-src="{{$item->featured_image}}" src="{{url('/media/image/shop/lazy-load.svg')}}">
                                    </a>
                                    <div class="shop-item-desc">
                                        <div class="shop-item-title justify-content-center d-flex">
                                            <h5>{{$item->name}}</h5>
                                        </div>

                                        <div class="shop-item-price justify-content-center d-flex">
                                            <img class="price-icon" src="{{url('/media/icon/dp.svg')}}">
                                            <span class="price-value">{{$item->dp_price}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{ $items->links() }}
                    </div>
                </div>
{{--                @include('templates.pagination')--}}
            </div>
        </div>
    </section>
    </div>
@endsection

@section('additional_scripts')
    <script src="{{ secure_asset('js/shop/scroll/jqscroll.min.js') }}"></script>
    <script src="{{ secure_asset('js/shop/shop-anim.js') }}"></script>
    <script src="{{ secure_asset('js/lazyload.js') }}"></script>
    <script src="{{ secure_asset('js/shop/shop-list-admin.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $('ul.pagination').hide();
        $(document).ready(function () {
            $("#txtinput").autocomplete({
                source: <?php echo $item_name_list; ?>,
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

            $('.infinite-scroll').jscroll({
                autoTrigger: true,
                loadingHtml: '<img class="center-block" src="https://'+window.location.hostname+'/media/image/shop/lazy-load.svg" alt="Loading..." />',
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.shop-item',
                callback: function() {
                    $('ul.pagination').remove();
                    var added_html = $(".jscroll-added").html();
                    $(".jscroll-inner").append(added_html);
                    $(".jscroll-added").remove();
                    let images = document.querySelectorAll("img[src='https://"+window.location.hostname+"/media/image/shop/lazy-load.svg']");
                    lazyload(images);
                }
            });
        });
    </script>

@endsection
