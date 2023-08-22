@extends('ucp.templates.app')
@section('pageTitle', 'News Manage')
@section('additional_headers')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
          integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
@endsection
@section('additional_scripts')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script>
        var dataTable;
        $(document).ready(function () {
            dataTable = $('#bugtracker_table').DataTable({
                "serverSide": true,
                "processing": true,
                "order": [],
                "ajax":
                    {
                        url: "{{ route('news.get_news') }}",
                        type: "GET",
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

        function toggleLockNews(id) {
            let data = {
                id: id,
                _token: '{{ csrf_token() }}'
            }
            $.ajax({
                url: "{{ route('news.toggle_lock') }}",
                method: "POST",
                dataType: "JSON",
                data: data,
                success: function(res) {
                    dataTable.draw();
                },
                error: function(err) {

                }
            });
        }

        function editNewsContent(id) {
            window.location.replace('/editnews/' + id);
        }

        function delNews(id) {
            let data = {
                id: id,
                _token: '{{ csrf_token() }}'
            }
            $.ajax({
                url: "{{ route('news.del_news') }}",
                method: "DELETE",
                dataType: "JSON",
                data: data,
                success: function(res) {
                    dataTable.draw();
                },
                error: function(err) {

                }
            });
        }

        function acceptNews(id) {
            let data = {
                _token: '{{ csrf_token() }}'
            }
            $.ajax({
                url: "/news/accept_news/" + id,
                method: "GET",
                dataType: "JSON",
                data: data,
                success: function(res) {
                    dataTable.draw();
                },
                error: function(err) {

                }
            })
        }

        function rejectNews(id) {
            let data = {
                _token: '{{ csrf_token() }}'
            }
            $.ajax({
                url: "/news/reject_news/" + id,
                method: "GET",
                dataType: "JSON",
                data: data,
                success: function(res) {
                    dataTable.draw();
                },
                error: function(err) {

                }
            })
        }
    </script>
@endsection
@section('content')
    <div class="content-wrapper wrapper-default">
        <section>
            <div class="container-fluid">
                <div class="content-inner">
                    <div class="content-body">
                        <div class="content-title" style="position: relative;">
                            <h5>News List</h5>
                            <a href="{{route('create_news',['add'])}}" class="btn btn-default pull-right addnews"> Add News </a>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="bugtracker_table" class="table datalist">
                                        <thead>
                                        <tr>
                                            <th width="5%">Image</th>
                                            <th width="25%">Title</th>
                                            <th width="10%">Created</th>
                                            <th width="5%">Status</th>
                                            <th width="15%">Action</th>
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
@endsection
