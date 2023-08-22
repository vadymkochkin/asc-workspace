@extends('templates.app')

@section('pageTitle', $item_info->name . ' - ')

@section('additional_headers')
    <!-- jquery autocomplete assets for auto complete -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('content')
    @include('templates.store_header')
    <section id="shop-item" class="justify-content-center">
        <div class="row">
            <div class="col-12">
                <img src="{{$item_info->featured_image}}" class="single-bg">
            </div>
            <div class="col-12 pricing-row">
                <div class="pricing-container">
                    <div class="product-purchase justify-content-center d-flex">
                        <div class="product-purchase-window d-flex">
                            <div class="purchase-title justify-content-center align-items-center d-flex">
                                <div class="col-12">
                                    <div class="purchase-header d-flex justify-content-between row">
                                        <h2>{{$item_info->name}}</h2>
                                    </div>
                                    <div class="d-flex purchase-amount row">
                                        <h2>DP:</h2>
                                        <img class="ml-3" src="/media/icon/Coins.svg" height="45px">
                                        <h2>{{$item_info->dp_price}}</h2>
                                    </div>
                                    <div class="row">
                                        @if($isAdded)
                                            <a class="purchase-btn col-12 text-center" data-toggle="modal">Added</a>
                                        @else
                                            <a id="added" class="purchase-btn col-12 text-center" data-toggle="modal">Add
                                                to cart</a>
                                        @endif
                                        <a href="#" class="purchase-btn col-12 text-center" data-toggle="modal"
                                           data-target="#confirmModal">Gift</a>
                                        <a href="#" class="purchase-btn d-none" id="play"></a>
                                        <!-- Needed for 3d renderer -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container cn-bg">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <div class="product-text text-left">
                            <h1 id="product-title">{{$item_info->headline}}</h1>
                            <h5 id="product-flavor">{{$item_info->description}}</h5>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 justify-content-center align-items-center">
                        <!--An example of 3D asset loading-->
                        <div id="product-preview" class="mt-3">
                            <canvas id="gl" class="col-12 m-0"
                                    3D-asset="{{secure_asset('assets/Item/Objectcomponents/weapon/axe_1h_blacksmithing_d_01.m2')}}"></canvas>
                            <div class="col-12 justify-content-center d-flex pt-2">
                                <p>3D Render View</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 product-specs d-lg-flex align-items-justify justify-content-between">
                        <div class="row">
                            @foreach($additionalContents as $additionalContent)
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 product-desc justify-content-center d-flex">
                                    <div class="shop-test">
                                        <img src="{{$additionalContent['additional_images']}}">
                                        <h6 class="spec-title">{{$additionalContent['additional_headline']}}</h6>
                                        <p>{{$additionalContent['additional_text']}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include("templates.alertmodal", [
        "confirmTitle" => "Send Gift"
    ])
@endsection

@section('additional_scripts')
    <script src="{{ asset('js/shop/shop-anim.js') }}"></script>

    <!-- Binary Libs -->
    <script src="{{ asset('js/shop/3d/jdataview.js') }}"></script>
    <script src="{{ asset('js/shop/3d/jbinary.js') }}"></script>

    <!-- WEB GL Lib-->
    <script src="{{ asset('js/shop/3d/gl-matrix.js') }}"></script>

    <!-- M2 Renderer -->
    <script src="{{ asset('js/shop/3d/m2.js') }}"></script>
    <script src="{{ asset('js/shop/3d/modelviewer.js') }}"></script>
    <script src="{{ asset('js/shop/3d/launcher.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function () {
            $("#added").on("click", function () {
                $.ajax({
                    url: "https://" + window.location.hostname + "/add",
                    //url: {{url('add') }},
                    type: "POST",
                    CrossDomain: true,
                    data: {
                        itemId: {{$item_info->itemid}},
                        item_u_id: {{$item_info->id}},
                        realmID: {{$item_info->realm}},
                        _token: '{{ csrf_token() }}',
                    },
                    success: function (char_data) {
                        console.log(char_data);
                        $("#result").html(JSON.parse(char_data));
                        $("#added").text("Added");
                        $('#successModal').modal('show');
                    }
                });
            });

        });
    </script>
    <script id="shader-vs" type="x-shader/x-vertex">
		attribute vec3 aVertexPosition;
		attribute vec2 aTextureCoord;

		uniform mat4 uMVMatrix;
		uniform mat4 uPMatrix;

		varying vec3 vLightWeighting;
		varying vec2 vTextureCoord;

		void main(void) {
			gl_Position = uPMatrix * uMVMatrix * vec4(aVertexPosition, 1.0);

			vLightWeighting = aVertexPosition - vec3(-4, 0, 1);
			vTextureCoord = aTextureCoord;
		}

    </script>

    <script id="shader-fs" type="x-shader/x-fragment">
		#ifdef GL_ES
		precision highp float;
		#endif

		varying vec3 vLightWeighting;
		varying vec2 vTextureCoord;
		uniform sampler2D uSampler;

		void main(void) {
			vec4 textureColor = texture2D(uSampler, vec2(vTextureCoord.s, vTextureCoord.t));
			gl_FragColor = vec4(textureColor.rgb, 1);
		}

    </script>
@endsection
