@extends('ucp.templates.app')
@section('pageTitle', 'Edit FAQ')
@section('additional_headers')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
          integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
@endsection
@section('additional_scripts')
    <script src="{{secure_asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script src="{{secure_asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>

    <script>
        var textareaNode;
        let isSaving = 0;
        $(document).ready(function () {
            textareaNode = $('#editcont').ckeditor({
                height: "500px"
            });

            var id = '{{request()->route()->parameters['id']}}';

            textareaNode.editor.setData(document.getElementById('des').value);

            $(document).on('click', '.savenews', function () {
                if(isSaving) {
                    return true;
                }
                isSaving = 1;
                $(this).text('Saving..');
                $(this).attr('readonly', true);

                var content = textareaNode.editor.getData();
                var title = $("#title").val();
                let cat_id = $("#category").val();
                var image_url = $("#image_url").val();

                var eid = id;
                var formData = new FormData();
                formData.append('content', title);
                formData.append('answer', content);
                formData.append('cat_id', cat_id);
                formData.append('eid', eid);

                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: "{{ route('faq.save_faq') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        $('.savenews').text('Save');
                        $('.savenews').removeAttr('readonly');

                        isSaving = 0;

                        if (!confirm("Success! Do you want to type continue?")) {
                            $('.backnews').click();
                        }
                    },
                    error: function (err) {

                    }
                })
            });

            $(document).on('click', '.backnews', function () {
                window.location.replace('/faqmanage');
            });
        });
    </script>
@endsection
@section('content')
    <div class="content-wrapper wrapper-default">
        <section>
            <div class="container-fluid">
                <div class="content-inner">
                    <div class="content-body">
                        <div class="content-title" style="position: relative;">
                            <h5>{{$page_name}}</h5>
                            <button class="btn btn-default pull-right savenews"> Save</button>
                            <button class="btn btn-default pull-right backnews"> Back</button>
                        </div>

                        <div class="row" style="margin-top: 20px;margin-bottom: 20px;">
                            <div class="col-md-12">
                                <label>Question</label>
                                <input type="text" id="title" class="form-control" value="{{isset($faq->content)? $faq->content:""}}"/>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px;margin-bottom: 20px;">
                            <div class="col-md-12">
                                <label>Category</label>
                                <select type="text" id="category" class="form-control">
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row" style="height: 700px;">
                            <div class="col-md-12" style="height: 100%;">
                                <label>Answer</label>
                                <textarea style="height: 100%;" id="editcont" value=""></textarea>
                                <input type="hidden" value="{{html_entity_decode(isset($faq->answer)?$faq->answer:"")}}" id="des"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
