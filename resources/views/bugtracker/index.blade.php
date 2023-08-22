@extends('templates.app')

@section('pageTitle', "Bugtracker - ")

@section('additional_headers')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection

@section('content')
<div id="page-img-container">
    <img id="page-background" src="{{ asset('media/image/backgrounds/background_1.png')}}">
</div>
<div class="container py-5">
    <div class="row text-center mb-2 mt-2 ">
        <div class="col-lg-8 mx-auto">
            <h2 class="display-4">Ascension Bugtracker</h2>
        </div>
    </div>
    <form>
    <div class="row mb-2">
        <div class="col-md-3 col-6 realms">
            <label for="realm-name text-left mb-4">Realm</label>
            <select name="filter-realm" id="filter-realm" class="form-control">
                <option value="">All</option>
              @foreach($realms as $realm)
                <option value="{{$realm->id}}">{{$realm->realm_name}}</option>
              @endforeach
            </select>
        </div>
        <div class="col-md-3 col-6 categories">
            <label for="realm-name text-left mb-4">Category</label>
            <select name="filter-category" id="filter-category" class="form-control">
                <option value="">All</option>
              @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
              @endforeach
            </select>
        </div>
        <div class="col-md-3 col-6 status">
            <label for="realm-name text-left mb-4">Status</label>
            <select name="filter-status" id="filter-status" class="form-control">
                <option value="">All</option>
                <option value="0">Open</option>
                <option value="1">Closed</option>
            </select>
        </div>
        <div class="col-md-3 col-6 priority">
            <label for="realm-name text-left mb-4">Priority</label>
            <select name="filter-priority" id="filter-priority" class="form-control">
                <option value="">All</option>
                <option value="0">Low</option>
                <option value="1">Medium</option>
                <option value="2">High</option>
                <option value="3">Game breaking</option>
            </select>
        </div>
    </div>
    <div class="row text-center my-2">
        <div class="col-md-2 col-4 owned">
            <div  id="own_bug" class="btn btn-warning owned form-control">
                <span class="glyphicon glyphicon-user"></span> My Reports
            </div>
        </div>
        <div class="col-md-2 col-4 submit">
            <div id="apply" class="btn btn-warning submit form-control apply-filter">
                <span class="glyphicon glyphicon-play-circle"></span> Apply
            </div>
        </div>
        <div class="col-md-2 col-4 reset">
            <button id="reset" type="reset" class="btn btn-warning reset form-control">
                <span class="glyphicon glyphicon-remove"></span> Reset
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 col-4 ">
            <a href="{{route('bugtracker.add_new')}}" class="btn btn-default">New report </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-4">
            <div class="table-responsive">
                <table id="bugtracker_table" class="table datalist">
                    <thead>
                        <tr>
                            <th width="10%">Id</th>
                            <th width="30%">Title</th>
                            <th width="15%">Category</th>
                            <th width="5%">Status</th>
                            <th width="10%">Created</th>
                            <th width="15%">Priority</th>
                            <th width="15%">Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  </form>
</div>
@endsection

@section('additional_scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('js/news/news-scroll.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
    var dataTable;
    $(document).ready(function () {
      initiate();
      function initiate(myreport=""){
          dataTable = $('#bugtracker_table').DataTable({
              "serverSide": true,
              "processing": true,
               "pageLength": 25,
              "order": [],
              "ajax":
                  {
                      url: "{{ route('bugtracker.request_report') }}",
                      type: "POST",
                      data: {
                          'realm_id'   :$('#filter-realm').val(),
                          'category_id':$('#filter-category').val(),
                          'status'     :$('#filter-status').val(),
                          'priority'   :$('#filter-priority').val(),
                          'my_report'  : myreport,
                          '_token'     : '{{ csrf_token() }}'
                      },
                  },
              "language": {
                  "paginate": {
                      "previous": "&#706",
                      "next": "&#707"
                  }
              }
          });
        }

      $('#own_bug').click(function(){
        dataTable.destroy();
        initiate(1);
      });
      $('#apply').click(function(){
        dataTable.destroy();
        initiate();
      });
      $('#reset').click(function(){
        $('#filter-realm').val("");
        $('#filter-category').val("");
        $('#filter-status').val("");
        $('#filter-priority').val("");
        dataTable.destroy();
        initiate();
      });
      $('#bugtracker_table').on("click", ".l-like", function(){
        var target_obj = $(this).parent("div");
        var bug_report_id = $(this).parent("div").attr("track");
        var like_exists = $(this).hasClass("l-checked");
        var vote = like_exists ? 0 : 1;
        updateLstate(target_obj, bug_report_id, vote);
      });

      $('#bugtracker_table').on("click", ".l-dislike", function(){
        var target_obj = $(this).parent("div");
        var bug_report_id = $(this).parent("div").attr("track");
        var dislike_exists = $(this).hasClass("l-checked");
        var vote = dislike_exists ? 0 : -1;
        updateLstate(target_obj, bug_report_id, vote);
      });

      function updateLstate(target_obj, bug_report_id, vote){
        var _token = $('meta[name="_token"]').attr('content');
        $.ajax({
          url: "https://"+window.location.hostname+"/bugtracker/rating",
          type: "POST",
          data: {
            bug_report_id,
            vote,
            _token
          },
          success:function(response) {
            response = JSON.parse(response);
            if( response != "corruption" ){
              if(response.state == 1){
                target_obj.find(".l-checked").removeClass("l-checked");
                target_obj.find(".l-like").addClass("l-checked");
                target_obj.find("span.like").text(parseInt(response.like)-parseInt(response.dislike));
              }
              else if (response.state == -1) {
                target_obj.find(".l-checked").removeClass("l-checked", "");
                target_obj.find(".l-dislike").addClass("l-checked");
                target_obj.find("span.like").text(parseInt(response.like)- parseInt(response.dislike));
              }
              else{
                target_obj.find(".l-checked").removeClass("l-checked", "");
                target_obj.find("span.like").text(parseInt(response.like)- parseInt(response.dislike));
              }
            }
          }
        });
      }
    });
    </script>
@endsection
