@extends('ucp.templates.app')
@section('pageTitle', 'User List')
@section('additional_headers')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
          integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
@endsection
@section('additional_scripts')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            var col = [
                {"data": "no"},
                {"data": "user_name"},
                {"data": "email"},
                {"data": "position"},
                {"data": "status"},
                {"data": "created"},
                {"data": "action"}
            ];
            $('#bugtracker_table').DataTable({
                serverSide: false,
                "order": [],
                "columns": col,
                "ajax": {
                    url: "{{ route('user_list_report') }}",
                    type: "POST",
                    data: {
                        '_token': '{{ csrf_token() }}'
                    },
                },
                "language": {
                    "paginate": {
                        "previous": "&#706",
                        "next": "&#707"
                    }
                }
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
                        <div class="content-title">
                            <h5>User List</h5>
                        </div>
                        <div id="LoadingImage"
                             style="display: none; z-index: 99998; left:0; top:0; overflow: hidden; width: 100%; height: 100% ; background-color: #000000CC; position:fixed;">
                            <img style="margin-left:-50px; margin-top:-50px; z-index: 99999; left:50%; top: 50%; position:absolute; border: 2px solid #c9aa71; border-radius:50%; padding: 5px;"
                                 src="{{url('/media/image/shop/ajax-loader.gif')}}"/>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="bugtracker_table" class="table datalist">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Position</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header text-center justify-content-center">
                    <h5 class="modal-title" id="exampleModalCenterTitle"></h5>
                </div>
                <div class="modal-body text-center">
                    <span class="item-name" id="result"></span>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Return
                        to User List
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function changeUserAccessLevel(access_level, user_id) {
            $("#LoadingImage").show();

            $.ajax({
                url: "{{ route('change_user_role') }}",
                //url: {{url('add') }},
                type: "POST",
                CrossDomain: true,
                data: {
                    requested_role: access_level.value,
                    user_id: user_id,
                    _token: '{{ csrf_token() }}',
                },
                success: function (responds) {
                    $("#LoadingImage").hide();
                    console.log(responds);
                    if (responds == "Error") {
                        $("#exampleModalCenterTitle").html("Error!!!");
                        $("#result").html("Unable to change access Level");
                    } else {
                        $("#exampleModalCenterTitle").html("Success!!!");
                        $("#result").html(responds);
                    }
                    $('#successModal').modal('show');
                }
            });
        }
    </script>
@endsection
