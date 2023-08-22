@extends('templates.app')

@section('pageTitle', "Bugtracker - ")

@section('additional_headers')
@endsection

@section('content')
<div class="container py-5">
    <div class="row text-center mb-2 mt-2 ">
        <div class="col-lg-8 mx-auto">
            <h2 class="">{{$heading}}</h2>
        </div>
    </div>
    <form  action="{{ route('bugtracker.update') }}" method="POST">
          @csrf
          <input type="hidden" name="bug_id" value="{{$bug_report->id}}">
        <div class="row bugtracker-new">
            <div class="form-group col-md-12 col-xs-12">
                <label for="title">Title</label>
                <input id="title" type="text" required class="form-control" name="title" placeholder="Title of the bug report" {{$admin_apply}} value="{{$bug_report->title}}">
            </div>
            <div class="form-group col-md-3 col-xs-4">
                <label for="master_tag">Group</label>
                <select id="master_tag" name="master_tag" {{$admin_apply}} class="form-control">
                  @foreach($master_tags as $key => $value)
                    @if($key == $bug_report->master_tag)
                      <option value="{{$key}}" selected>{{$value}}</option>
                    @else
                      <option value="{{$key}}">{{$value}}</option>
                    @endif
                  @endforeach
                </select>
            </div>
            <div class="form-group col-md-2 col-xs-4">
                <label for="realms">Realm</label>
                <select class="form-control" name="realm" {{$admin_apply}} id="realm">
                  @foreach($realms as $realm)
                    @if($realm->id == $bug_report->realm)
                      <option value="{{$realm->id}}" selected>{{$realm->realm_name}}</option>
                    @else
                      <option value="{{$realm->id}}">{{$realm->realm_name}}</option>
                    @endif
                  @endforeach
              </select>
            </div>
            <div class="form-group col-md-2 col-xs-4">
                <label for="priority">Priority</label>
                <select class="form-control" name="priority" {{$admin_apply}} id="priority">
                  @foreach($priorities as $key => $priority )
                    @if($key == $bug_report->priority)
                      <option value="{{$key}}" selected>{{$priority}}</option>
                    @else
                      <option value="{{$key}}">{{$priority}}</option>
                    @endif
                  @endforeach
                </select>
            </div>
            <div class="form-group col-md-2 col-xs-4">
                <label>Status</label>
                <select class="form-control" name="status">
                    @if($bug_report->status == 0)
                      <option value="0" selected>Open</option>
                      <option value="1">Closed</option>
                    @else
                      <option value="0" >Open</option>
                      <option value="1" selected>Closed</option>
                    @endif
                </select>
            </div>
            <div class="form-group col-md-3  col-xs-4">
                <label for="private">Type</label>
                <select class="form-control" name="private" {{$admin_apply}} id="private">
                  @if(0 == $bug_report->private)
                  <option value="0" selected>Public (Visible to everyone)</option>
                  <option value="1">Private (Visible to staff and you only)</option>
                  @else
                  <option value="0" >Public (Visible to everyone)</option>
                  <option value="1" selected>Private (Visible to staff and you only)</option>
                  @endif
                </select>
            </div>
            <div class="form-group col-md-3 col-xs-4">
                <label for="category">Category</label>
                <select class="form-control" name="category" {{$admin_apply}} id="category">
                  @foreach($categories as $category)
                    @if($category->id == $bug_report->bugtracker_category_id)
                        <option class="category-option" data-category="{{$category->id}}" value="{{$category->id}}" selected>{{$category->name}}</option>
                    @else
                      <option class="category-option" data-category="{{$category->id}}" value="{{$category->id}}">{{$category->name}}</option>
                    @endif
                  @endforeach
                </select>
            </div>
            <div class="form-group col-md-3 col-xs-4" style="{{$bug_report->subcategory_id == null ? 'display:none':''}}">
                <label for="subcategory">Subcategory</label>
                <select class="form-control" name="subcategory" {{$admin_apply}} id="subcategory" >
                  @foreach($subcategories as $subcategory)
                    @if($subcategory->id == $bug_report->subcategory_id)
                      <option data-category="{{$subcategory->category_id}}" value="{{$subcategory->id}}" selected>{{$subcategory->name}}</option>
                    @else
                      <option data-category="{{$subcategory->category_id}}" value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                    @endif
                  @endforeach
                </select>
            </div>
            <div class="form-group col-md-2 col-xs-4">
                <label for="expansion">Expansion</label>
                <select class="form-control" name="expansion" {{$admin_apply}} id="expansion">
                    <option value="0">Optional</option>
                  @foreach($expansions as $expansion)
                    @if($expansion->id == $bug_report->expansion_id)
                      <option data-expansion="{{$expansion->id}}" value="{{$expansion->id}}" selected>{{$expansion->name}}</option>
                    @else
                      <option data-expansion="{{$expansion->id}}" value="{{$expansion->id}}">{{$expansion->name}}</option>
                    @endif
                  @endforeach
                </select>
            </div>
            <div class="form-group col-md-2 col-xs-4" style="{{$bug_report->area_id == null ? 'display:none':''}}">
                <label for="area">Area</label>
                <select class="form-control" name="area" {{$admin_apply}} id="area">
                  @foreach($areas as $area)
                    @if($area->id == $bug_report->area_id)
                      <option data-expansion="{{$area->expansion_id}}" value="{{$area->id}}" selected>{{$area->name}}</option>
                    @else
                      <option data-expansion="{{$area->expansion_id}}" value="{{$area->id}}">{{$area->name}}</option>
                    @endif

                  @endforeach
                </select>
            </div>
            <div class="form-group col-md-2 col-xs-4" style="{{$bug_report->zone_id == null ? 'display:none':''}}">
                <label for="zone">Zone</label>
                <select class="form-control" name="zone" {{$admin_apply}} id="zone">
                  @foreach($zones as $zone)
                    @if($zone->id == $bug_report->zone_id)
                      <option data-area="{{$zone->area_id}}" value="{{$zone->id}}" selected>{{$zone->name}}</option>
                    @else
                      <option data-area="{{$zone->area_id}}" value="{{$zone->id}}">{{$zone->name}}</option>
                    @endif
                  @endforeach
                </select>
            </div>
            <div class="form-group col-md-12 col-xs-12">
                <label for="description">Description</label>
                <textarea class="form-control" required name="description" style="resize:none;" {{$admin_apply}} id="description" rows="5" placeholder="Detailed description...">{{$bug_report->description}}</textarea>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="link[]">(Optional) Wowhead </label>
                @if(count($links))
                  @foreach($links as $link)
                    <input class="form-control" type="text" {{$admin_apply}} name="link[]" placeholder="https://www.wowhead.com/item=49623" value="{{$link}}">
                  @endforeach
                @else
                  <input class="form-control" type="text" {{$admin_apply}} name="link[]" placeholder="https://www.wowhead.com/item=49623">
                @endif
                @if($admin_apply != "disabled")
                <span id="add-link" {{$admin_apply}} class="btn btn-warning mt-2" title="Add more links"> <span class="glyphicon glyphicon-plus"></span> Add more</span>
                @endif
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="img[]">(Optional) Image only https://imgur.com allowed </label>
                @if(count($imges))
                  @foreach($imges as $img)
                    <input class="form-control image-upload" type="text" {{$admin_apply}} name="img[]" placeholder="https://i.imgur.com/Dokbyyd.jpg" value="{{$img}}">
                  @endforeach
                @else
                  <input class="form-control image-upload" type="text" {{$admin_apply}} name="img[]" placeholder="https://i.imgur.com/Dokbyyd.jpg">
                @endif
                @if($admin_apply != "disabled")
                <span class="not-legit-explanation" style="display: none">Make sure its imgur link and ends with valid image extension (jpg,png)</span>
                <span id="add-img" class="btn btn-warning mt-2" title="Add more images"><span class="glyphicon glyphicon-plus"></span> Add more</span>
                @endif
            </div>
            <div class="form-group col-md-12 col-xs-12">
                <button type="submit" name="submit" class="btn btn-warning save-btn">Save</button>
                <a href="{{route('bugtracker.display',$bug_report->id)}}" class="btn btn-default">Back</a>
            </div>
        </div>
    </form>
</div>
@endsection

@section('additional_scripts')
<script src="{{ asset('js/bugtracker.js') }}"></script>
@endsection
