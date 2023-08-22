@extends('templates.app') @section('pageTitle', $item_info->name . ' - ')
@section('additional_headers')
<!-- jquery autocomplete assets for auto complete -->
<link
	rel="stylesheet"
	href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"
/>
@endsection @section('content')
<div id="page-full-img-container">
	<img
		id="page-background-full"
		src="{{ asset('media/image/backgrounds/large-bg/large-bg1.png') }}"
	/>
</div>
@include('templates.store_header')
<section id="shop-object">
	<div class="container h-100" style="max-width: 1300px !important;">
		<div class="row h-100 d-flex">
			<div class="col-6 h-100">
				<div class="row h-100 d-flex">
					<div class="item-info">
						<h1 class="item-header animated fadeInLeft delay-1s d-flex">
							{{$item_info->name}}
							<!--
							<a class="item-buy" id="added" href="#" data-toggle="modal">ADD TO CART</a>
							<div class="d-flex" style="margin-left: 2rem;margin-top: 1rem;">
								<img class="ml-3" src="/media/icon/Coins.svg" height="45px" />
								<h2 style="line-height: 40px !important;margin-left: .5rem;font-weight: bold;font-size: 3rem;">
									{{$item_info->dp_price}}
								</h2>
							</div>
							-->
						</h1>
						<p class="item-desc animated fadeIn delay-1s">
							{{$item_info->description}}
						</p>
						<div class="d-flex animated fadeInUp delay-1s">
							@if($isAdded)
							<a class="item-buy" href="#" data-toggle="modal">ADDED</a>
							@else
							<a class="item-buy" id="added" href="#" data-toggle="modal">ADD TO CART</a>
							<div class="d-flex" style="margin-left: 2rem; position: relative; top: 1rem;">
								<img class="ml-3" src="/media/icon/Coins.svg" height="45px" />
								<h2 style="line-height: 40px !important;margin-left: .5rem;font-weight: bold;font-size: 3rem;">
									{{$item_info->dp_price}}
								</h2>
							</div>
							@endif
						</div>
						<i id="play"></i>
					</div>
				</div>
			</div>
			<div class="col-6">
				<div id="product-preview" class="mt-3">
					<canvas
						id="gl"
						class="col-12 m-0 animated fadeIn delay-2s"
						3D-asset="{{
							secure_asset(
								'assets/Item/Objectcomponents/weapon/axe_1h_blacksmithing_d_01.m2'
							)
						}}"
					></canvas>
					<div class="item-gallery">
						@foreach($additionalContents as $additionalContent)
						<div class="gallery-item col-4  animated fadeInUp delay-1s">
							<!--<img class="gallery-image" src="{{$additionalContent['additional_images']}}">-->
							<div
								class="gallery-item-content"
								style="background-image:
                                url({{
									$additionalContent['additional_images']
								}})"
							></div>

							<p class="gallery-text">
								{{ $additionalContent["additional_text"] }}
							</p>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@include("templates.alertmodal", [ "confirmTitle" => "Send Gift" ]) @endsection
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
	$(document).ready(function() {
		$("#added").on("click", function() {
			$.ajax({
				url: "https://" + window.location.hostname + "/add",
				//url: {{url('add') }},
				type: "POST",
				CrossDomain: true,
				data: {
					itemId: "{{$item_info->itemid}}",
					item_u_id: "{{$item_info->id}}",
					realmID: "{{$item_info->realm}}",
					_token: "{{ csrf_token() }}"
				},
				success: function(char_data) {
					console.log(char_data);
					$("#result").html(JSON.parse(char_data));
					$("#added").text("Added");
					//$("#successModal").modal("show");

					if (JSON.parse(char_data) == "already exists in your cart.") {
						Swal.fire({
							title: "Item already exists!",
							text: "{{$item_info->name}}  " + JSON.parse(char_data),
							type: "warning",
							confirmButtonText: "BACK TO THE STORE"
						});
					} else {
						Swal.fire({
							title: "Success!",
							text: "{{$item_info->name}}  " + JSON.parse(char_data),
							type: "success",
							confirmButtonText: "BACK TO THE STORE"
						});
					}
				}
			});
		});
		$(document).ready(function() {
			$("#txtinput")
				.autocomplete({
					source: function(request, response) {
						$.ajax({
							url: "{{ route('manage_store.realms_item_search') }}",
							type: "POST",
							CrossDomain: true,
							dataType: "json",
							data: {
								realm_id: "{{$item_info->realm}}",
								realm_txt: $("#txtinput").val(),
								_token: "{{ csrf_token() }}"
							},
							success: response,
							error: function(result) {
								alert("Error");
							}
						});
					},
					focus: function(event, ui) {
						$("#txtinput").val(ui.item.desc);
						return true;
					},
					select: function(event, ui) {
						$("#txtinput").val("");
						return false;
					}
				})
				.autocomplete("instance")._renderItem = function(ul, item) {
				return $("<li>")
					.data("item.autocomplete", item)
					.append("<div>" + item.label + "</div>")
					.appendTo(ul);
			};
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
<script>
	$(window).on("load", function() {
		$("footer").remove();
	});
</script>
@endsection
