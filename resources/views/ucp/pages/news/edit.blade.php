@extends('ucp.templates.app')
@section('pageTitle', 'Edit News')
@section('additional_headers')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
          integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{secure_asset('/css/bootstrap-tagsinput.css')}}">
@endsection
@section('additional_scripts')
    <script src="{{secure_asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script src="{{secure_asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
    <script src="{{secure_asset('/js/news/bootstrap-tagsinput.min.js')}}"></script>

    <script>
        var textareaNode;
        $(document).ready(function () {
            textareaNode = $('#contents').ckeditor({
                height: "300px"
            });

            var id = '{{request()->route()->parameters['id']}}';
            textareaNode.editor.setData(document.getElementById('des').value);

            $(document).on('click', '.savenews', function() {
                var content = textareaNode.editor.getData();
                var title = $("#title").val();
                var tags = $("#tags").val();
                var image_url = $("#image_url").val();
                var eid = id;

                var formData = new FormData();
                formData.append('title', title);
                formData.append('tags', tags);
                formData.append('image_url', image_url);
                formData.append('contents', content);
                formData.append('eid', eid);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: "{{ route('news.save_news') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                      checkState(res);
                    },
                    error: function(err) {

                    }
                })
            });

            function checkState(data){
              if ("message" in data){
                Swal.fire({
                  title: "Success",
                  text: "Article successfully posted",
                  type: "success"
                }).then(() => {
                    window.location.replace('/newsmanage');
                });
              }
              else{
                for (var key in data) {
                  let error_msg = "<div class='asc-error-tooltip'>"+data[key][0]+"</div>";
                  let num = $("id[name='"+key+"']").next().length;
                  if (num < 1){
                    $("input[id='"+key+"']").addClass("is-invalid").after(error_msg);
                  }
                  else{
                    $("input[id='"+key+"']").addClass("is-invalid").next().replaceWith(error_msg);
                  }
                }
              }
            }

            $("#news-main").on("input","input", function(){
              let error_check = $(this).next().length;
              if(error_check != 0){
                $(this).removeClass("is-invalid").next().remove();
              }
            });

            $(document).on('click', '.backnews', function() {
                 window.location.replace('/newsmanage');
            });
        });
    </script>
@endsection
@section('content')
    <div class="content-wrapper wrapper-default">
        <section>
            <div class="container-fluid">
                <div class="content-inner">
                    <div id="news-main" class="content-body">
                        <div class="content-title" style="position: relative;">
                            <h5>{{$page_name}}</h5>
                            <button class="btn btn-default pull-right savenews"> Save </button>
                            <button class="btn btn-default pull-right backnews"> Back </button>
                        </div>

                        <div class="row" style="margin-top: 20px;margin-bottom: 20px;">
                            <div class="col-md-12">
                                <label>Title</label>
                                <input type="text" id="title" class="form-control" value="{{isset($news->title)? $news->title:""}}" />
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px;margin-bottom: 20px;">
                            <div class="col-md-12">
                                <label style="display: block;">Tags</label>
                                <input type="text" id="tags" class="form-control"  value="{{isset($news->tags)? $news->tags : ""}}" data-role="tagsinput" />
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px;margin-bottom: 20px;">
                            <div class="col-md-12">
                                <label class="mb-1" >Image Url</label>
                                <input type="text" id="image_url" class="form-control" value="{{isset($news->image)? $news->image:""}}" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <textarea style="height: 100%;" id="contents" value=""></textarea>
                                <input type="hidden" value="{{html_entity_decode(isset($news->description)?$news->description:"")}}" id="des" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
