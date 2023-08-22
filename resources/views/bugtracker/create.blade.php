@extends('templates.app') @section('pageTitle', "Bugtracker - ")
@section('additional_headers') @endsection @section('content')
<div class="container py-5 bugtracker-create">
	<div class="row text-center page-title mb-5">
		<div class="col-lg-8 mx-auto">
			<h2 class="display-4">Ascension Bugtracker</h2>
			<p class="lead mb-0">Submit a bug report to our bugtracker!</p>
		</div>
	</div>
	<form action="{{ route('bugtracker.save') }}" method="POST">
		@csrf
		<div class="row bugtracker-new">
			<div class="form-group col-md-4 col-xs-12">
				<label for="title">Title</label>
				<input
					id="title"
					type="text"
					required
					class="form-control"
					name="title"
					placeholder="Title of the bug report"
				/>
			</div>

			<div class="form-group col-md-4 col-xs-12">
				<label for="realms">Realm</label>
				<select class="form-control" name="realm" id="realm">
					@foreach($realms as $realm)
					<option value="{{$realm->id}}">{{$realm->realm_name}}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group col-md-4 col-xs-4">
				<label for="private">Type</label>
				<select class="form-control" name="private" id="private">
					<option value="0">Public (Visible to everyone)</option>
					<option value="1">Private (Visible to staff and you only)</option>
				</select>
			</div>

			<div class="form-group col-md-4 col-xs-4">
				<label for="master_tag">Group</label>
				<select id="master_tag" name="master_tag" class="form-control">
					@foreach($master_tags as $key => $value)
					<option value="{{ $key }}">{{ $value }}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group col-md-4 col-xs-4">
				<label for="category">Category</label>
				<select class="form-control" name="category" id="category">
					@foreach($categories as $category)
					<option
						class="category-option"
						data-category="{{$category->id}}"
						value="{{$category->id}}"
						>{{$category->name}}</option
					>
					@endforeach
				</select>
			</div>

			<div class="form-group col-md-4 col-xs-4" style="display: none;">
				<label for="priority">Priority</label>
				<select class="form-control" name="priority" id="priority">
					@foreach($priorities as $key => $priority )
					<option value="{{ $key }}">{{ $priority }}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group col-md-4 col-xs-4">
				<label for="expansion">Expansion</label>
				<select class="form-control" name="expansion" id="expansion">
					<option value="0">Optional</option>
					@foreach($expansions as $expansion)
					<option
						data-expansion="{{$expansion->id}}"
						value="{{$expansion->id}}"
						>{{$expansion->name}}</option
					>
					@endforeach
				</select>
      </div>
      
      <div class="form-group col-md-12 col-xs-4" style="display: none;">
          <label for="subcategory">Subcategory</label>
          <select
            class="form-control"
            name="subcategory"
            id="subcategory"
            disabled="disabled"
          >
            @foreach($subcategories as $subcategory)
            <option
              data-category="{{$subcategory->category_id}}"
              value="{{$subcategory->id}}"
              >{{$subcategory->name}}</option
            >
            @endforeach
          </select>
        </div>

			<div class="form-group col-md-6 col-xs-12" style="display: none;">
				<label for="area">Area</label>
				<select class="form-control" name="area" id="area" disabled="disabled">
					@foreach($areas as $area)
					<option
						data-expansion="{{$area->expansion_id}}"
						value="{{$area->id}}"
						>{{$area->name}}</option
					>
					@endforeach
				</select>
			</div>
			<div class="form-group col-md-6 col-xs-12" style="display: none;">
				<label for="zone">Zone</label>
				<select class="form-control" name="zone" id="zone" disabled="disabled">
					@foreach($zones as $zone)
					<option
						data-area="{{$zone->area_id}}"
						value="{{$zone->id}}"
						>{{$zone->name}}</option
					>
					@endforeach
				</select>
			</div>
			<div class="form-group col-md-12 col-xs-12">
				<label for="description">Description</label>
				<textarea
					class="form-control"
					required
					name="description"
					style="resize:none;"
					id="description"
					rows="5"
					placeholder="Description of the problem or issue here.

Current behaviour:
Tell us what happens.
If this is a crash, post the crashlog (upload to https://gist.github.com/ or pastebin.com).

Expected behaviour:
Tell us what should happen instead.

Steps to reproduce the problem:
1.  Include entries of affected creatures / items / quests with a link to the relevant wowhead page.
2. ...
3. ..."
				></textarea>
			</div>
			<div class="form-group col-md-6 col-xs-12">
				<label for="link[]">(Optional) Wowhead </label>
				<input
					class="form-control"
					type="text"
					name="link[]"
					placeholder="https://www.wowhead.com/item=49623"
				/>
				<span id="add-link" class="btn btn-default mt-2" title="Add more links">
					<span class="glyphicon glyphicon-plus"></span> Add more</span
				>
			</div>
			<div class="form-group col-md-6 col-xs-12">
				<label for="img[]"
					>(Optional) Image only https://imgur.com allowed
				</label>
				<input
					class="form-control image-upload"
					type="text"
					name="img[]"
					placeholder="https://i.imgur.com/Dokbyyd.jpg"
				/>
				<span class="not-legit-explanation" style="display: none"
					>Make sure its imgur link and ends with valid image extension
					(jpg,png)</span
				>
				<span id="add-img" class="btn btn-default mt-2" title="Add more images"
					><span class="glyphicon glyphicon-plus"></span> Add more</span
				>
			</div>
			<div class="form-group col-md-12 col-xs-12 mt-5">
				<button
					type="submit"
					name="submit"
					class="asc-button bottom-button btn save-btn"
				>
					Save
				</button>
				<a
					href="{{ route('bugtracker.index') }}"
					class="btn bottom-button btn-default"
					>Back</a
				>
			</div>
		</div>
	</form>
</div>
@endsection @section('additional_scripts')
<script src="{{ asset('js/bugtracker.js') }}"></script>
@endsection
