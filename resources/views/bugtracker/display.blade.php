@extends('templates.app') @section('pageTitle', "Bugtracker - ")
@section('additional_headers')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
@endsection @section('content')
<div class="container py-5 bugtracker-display">
	<div class="row text-center page-title mb-5">
		<div class="col-lg-8 mx-auto">
			<h2 class="display-4">Ascension Bugtracker</h2>
			<h3>{{$title}}</h3>
		</div>
	</div>
	<div class="row bugtracker">
		<div class="form-group col-md-4 col-xs-12">
			<label for="title">Title</label>
			<select class="form-control" name="title" disabled>
				<option>{{ $report->title }}</option>
			</select>
		</div>

		<div class="form-group col-md-4 col-xs-12">
			<label for="realm">Realm</label>
			<select class="form-control" name="realm" id="realm" disabled>
				<option value="$report->Realm->realm_name ?? ''">
					{{$report->Realm->realm_name ?? ""}}
				</option>
			</select>
    </div>

        <div class="form-group col-md-4 col-xs-6">
                <label for="status">Status</label>
                <select class="form-control" name="status" disabled>
                    <option>{{$report->status == 0 ? 'Open' : 'Closed'}}</option>
                </select>
            </div>

		<div class="form-group col-md-3 col-xs-6">
			<label for="group">Group</label>
			<select class="form-control" name="group" disabled>
				<option>{{ $master_tags }}</option>
			</select>
		</div>

		<div class="form-group col-md-3 col-xs-6">
			<label for="category">Category</label>
			<select class="form-control" name="category" disabled>
				<option>{{$report->Category->name ?? ""}}</option>
			</select>
		</div>

		<div class="form-group col-md-3 col-xs-6">
			<label for="expansion">Expansion</label>
			<select class="form-control" name="expansion" disabled>
				<option>{{$report->Expansion->name ?? "Optional"}}</option>
			</select>
		</div>

	@if($report->Subcategory)
		<div class="form-group col-md-3 col-xs-4">
			<label for="subcategory">Subcategory</label>
			<select class="form-control" name="subcategory" disabled>
				<option>{{$report->Subcategory->name ?? ""}}</option>
			</select>
		</div>
	@endif

	@if($report->Area)
		<div class="form-group col-md-6 col-xs-6">
			<label for="area">Area</label>
			<select class="form-control" name="area" disabled>
				<option>{{$report->Area->name ?? ""}}</option>
			</select>
		</div>
	@endif

	@if($report->Zone)
		<div class="form-group col-md-6 col-xs-6">
			<label for="zone">Zone</label>
			<select class="form-control" name="zone" disabled>
				<option>{{$report->Zone->name ?? ""}}</option>
			</select>
		</div>
	@endif

		<div class="form-group col-md-12 col-xs-12" disabled>
			<label for="description">Description</label>
			<textarea
				class="form-control"
				required
				name="description"
				style="resize:none;"
				id="description"
				readonly
				rows="5"
				>{{$report->description}}
			</textarea
			>
		</div>

		<!--
		<div class="col-md-3 col-xs-4">
			<label for="status">Status</label>
			<p>{{$report->status == 0 ? 'Open' : 'Closed'}}</p>
        </div>
        -->

		<!--
		<div class="col-md-3 col-xs-4">
			<label for="priority">Priority</label>
			<p>{{ $priority }}</p>
        </div>
        -->
	@if(count($links))
			<div class="form-group col-md-6 col-xs-12">
					<label for="link[]">(Optional) Wowhead </label>
						@foreach($links as $link)
							<input class="form-control mt-1" type="text" name="link[]" readonly="readonly" placeholder="https://www.wowhead.com/item=49623" value="{{$link}}">
						@endforeach
			</div>
	 @endif

	 @if(count($links))
			<div class="form-group col-md-6 col-xs-12">
					<label for="img[]">(Optional) Image only https://imgur.com allowed </label>
						@foreach($imges as $img)
							<input class="form-control image-upload mt-1" type="text" readonly="readonly" name="img[]" placeholder="https://i.imgur.com/Dokbyyd.jpg" value="{{$img}}">
						@endforeach
			</div>
	@endif

	</div>
	@if($report->user_id == Auth::user()->id ||
	Auth::user()->canModerateBugtrackers())
	<div class="row">
		<div class="col-md-2 col-4 ">
			<a
				href="{{ route('bugtracker.edit',$report->id)}}"
				class="btn btn-default"
				>Edit</a
			>
		</div>
	</div>
	@endif
	<div class="comment-section-title mt-5">
		<h5>Comment</h5>
	</div>
	<div class="" style="margin-bottom:20px">
		<form method="POST" action="{{ route('bugtracker.save_comment') }}">
			{{ csrf_field() }}
			<div class="row no-margin-left">
				<div class="col-12">
					<div class="row d-flex">
						<div class="col-12 no-padding-lr">
							<div class="d-flex">
								<textarea
									class="col-12 {{ $errors->has('response')? 'error-input':'' }}"
									placeholder="Write a comment..."
									name="response"
									>{{ old("response") }}</textarea
								>
							</div>
						</div>
					</div>

					<div class="row d-flex mt-2">
						<div class="col-12 d-flex justify-content-end">
							<div class="form-group">
								<input
									type="hidden"
									name="bug_report_id"
									value="{{$report->id}}"
									class="btn btn-primary"
								/>
								<input type="submit" value="Submit" class="btn btn-primary" />
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>

	<div class="content-comments">
		<div class="row d-flex">
			<div class="infinite-scroll">
				@foreach($comments as $comment)
				<div class="col-12 no-padding-lr mb-2">
					<h5>
						{{$comment->User->username}}
						({{Auth::user()->getAccessLevelDisplayString($comment->User->access_level)}})
					</h5>

					<div class="changelog-des border">
						<i class="fa fa-clock-o mr-1"></i>
						@if($comment->User->id == Auth::user()->id)
						<button class="float-right btn btn-asc bug-comment" comment-id="{{$comment->id}}">
							<i class="material-icons mr-1 ">edit</i>
						</button>
						@endif
						<span class="small">
							@if($comment->updated_at)
								*Edited* {{ (new \Carbon\Carbon($comment->updated_at))->diffForHumans() }}
							@else
								{{ (new \Carbon\Carbon($comment->created_at))->diffForHumans() }}
							@endif
						</span>
						<p class="text-small mt-2 font-weight-light comment-p">
							{{$comment->comment}}
						</p>
					</div>
				</div>
				@endforeach
				{{ $comments->links() }}
			</div>
		</div>
	</div>
</div>

<div id="LoadingImage"
		 style="display: none; z-index: 99998; left:0; top:0; overflow: hidden; width: 100%; height: 100% ; background-color: #000000CC; position:fixed;">
		<img style="margin-left:-50px; margin-top:-50px; z-index: 99999; left:50%; top: 50%; position:absolute; border: 2px solid #c9aa71; border-radius:50%; padding: 5px;"
				 src="{{url('/media/image/shop/ajax-loader.gif')}}"/>
</div>
@endsection @section('additional_scripts')
<script src="{{ secure_asset('js/shop/scroll/jqscroll.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
	$("ul.pagination").hide();
	$(function() {
		$(".infinite-scroll").jscroll({
			autoTrigger: true,
			loadingHtml:
				'<img class="center-block" src="/media/image/shop/lazy-load.svg" alt="Loading..." />',
			padding: 0,
			nextSelector: ".pagination li.active + li a",
			contentSelector: "div.infinite-scroll",
			callback: function() {
				$("ul.pagination").remove();
			}
		});
	});

	$(".content-comments").on("click",".bug-comment",function(){
	//console.log($(this).parent('.changelog-des'));
	var comment_parent = $(this).parent('.changelog-des');
	var comment_id = $(this).attr('comment-id');
	var comment_text 	= comment_parent.find('.comment-p').text().trim();
	var html_output = `<div class= "remove"><textarea class= "col-12" name= "bug_comment" cid= "`+comment_id+`">`+comment_text+`</textarea>
										<div class= "col-12">
											<button class= "row btn btn-asc mt-2 float-right update-comment">Update</button>
										</div></div>`;
	comment_parent.replaceWith(html_output);
	//console.log(comment_id,comment_text);
	});
	$(".content-comments").on("click",".update-comment",function(){
		$('#LoadingImage').show();
			var target = $(this).parent('.col-12').siblings('textarea');
			var comment = target.val().trim();
			var comment_id = target.attr('cid');
			//console.log(comment,comment_id);

			$.ajax({
				url: "{{route('bugtracker.update_comment')}}",
				type: "POST",
				data: {
					'comment_id':comment_id,
					'comment'		:comment,
					'_token'    : '{{ csrf_token() }}'
				},
					success:function(response) {
						$('#LoadingImage').hide();
						response = JSON.parse(response);
            if( response != "Error" ){

							$content = `<div class="changelog-des border">
														<i class="fa fa-clock-o mr-1"></i>
														<button class="float-right btn btn-asc bug-comment" comment-id="`+comment_id+`">
															<i class="material-icons mr-1 ">edit</i>
														</button>
														<span class="small">
																`+response.date+`
														</span>
														<p class="text-small mt-2 font-weight-light comment-p">
															`+comment+`
														</p>
													</div>`;
							target.parent().replaceWith($content);
							$(this).remove();
							Swal.fire({
			          title: "Success!",
			          text: "Successfully updated",
			          type: "success",
			          });
						}else{
							Swal.fire({
			          title: "Error!",
			          text: "Something went wrong",
			          type: "error",
			          });
						}
					}
				});
	});
</script>
@endsection
