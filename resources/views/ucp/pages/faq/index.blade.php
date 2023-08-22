@extends('ucp.templates.app')
@section('pageTitle', 'FAQ Manage')
@section('additional_headers')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
          integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
@endsection
@section('additional_scripts')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script>
        let dataTable;
        let categoryDataTable;
        $(document).ready(function () {
            let $tableID = $("#table");

            $(document).on('click', '.addcate', function () {
                $("#addCategoryModal").modal('show');
            });

            $tableID.on('click', '.table-up', function () {
                const $row = $(this).parents('tr');

                if ($row.index() === 0) {

                    return;
                }
                $row.prev().before($row.get(0));

                let uid = $(this).attr('uid');
                reorderCategory(uid, 0);
            });

            $tableID.on('click', '.table-down', function () {
                const $row = $(this).parents('tr');
                $row.next().after($row.get(0));

                let uid = $(this).attr('uid');
                reorderCategory(uid, 1);
            });

            $tableID.on('click', '.edit_action', function() {
                $("#category_name").val($(this).closest('tr').find('td:first').text());
                $("#category_name").focus();
                $("#eid").val($(this).attr('uid'));
            });

            $tableID.on('click', '.del_action', function() {
                let uid = $(this).attr('uid');
                if(!confirm('Are you sure delete this category?')) {
                    return;
                }
                if(!uid) {
                    alert("Error");
                    return;
                }
                let formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('cid', uid);
                $.ajax({
                    url: "{{ route('faq.del_category') }}?cid=" + uid,
                    method: "DELETE",
                    dataType: "JSON",
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        categoryDataTable.draw();
                    },
                    error: function(err) {

                    }
                })
            });

            $(document).on('click', '.save_category', function () {
                let cate = $("#category_name").val();

                if (!cate) {
                    alert('Please enter category name!');
                    return;
                }
                let formData = new FormData();
                formData.append('category_name', cate);
                let od_id = $("#table tbody tr:first td:first").text != 'No data available in table' ? $("#table tbody tr").length : 0;
                formData.append('order_id', od_id);
                formData.append('_token', '{{ csrf_token() }}');


                if($("#eid").val()) {
                    formData.append('eid', $("#eid").val());
                } else {
                    formData.append('eid', 'add');
                }

                $.ajax({
                    url: "{{ route('faq.save_category') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        categoryDataTable.draw();
                        $("#eid").val('');
                        $("#category_name").val('');
                    },
                    error: function (err) {

                    }
                })
            });

            dataTable = $('#bugtracker_table').DataTable({
                "serverSide": true,
                "processing": true,
                "order": [],
                "ajax":
                    {
                        url: "{{ route('faq.get_faq') }}",
                        type: "GET",
                        data: {
                            '_token': '{{ csrf_token() }}'
                        },
                    },
                "columns": [
                    {
                        "className": 'details-control',
                        "orderable": false,
                        "data": null,
                        "defaultContent": ''
                    },
                    {"data": "content"},
                    {"data": "created"},
                    {"data": "category"},
                    {"data": "status"},
                    {"data": "action"}
                ],
                "language": {
                    "paginate": {
                        "previous": "&#706",
                        "next": "&#707"
                    }
                }
            });

            categoryDataTable = $('#table').DataTable({
                "serverSide": true,
                "processing": true,
                "order": [],
                "ajax":
                    {
                        url: "{{ route('faq.get_category') }}",
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

        // Add event listener for opening and closing details
        $('#bugtracker_table tbody').on('click', 'td.details-control', function () {
            let tr = $(this).closest('tr');
            let row = dataTable.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format(row.data())).show();
                tr.addClass('shown');
            }
        });

        function reorderCategory(uid, utype){
            let postData = {
                uid: uid,
                utype: utype //1: down, 0: up
            };
            $.ajax({
                url: "{{ route('faq.reorder') }}",
                method: "PUT",
                dataType: "JSON",
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                data: postData,
                success: function(res) {
                    categoryDataTable.draw();
                },
                error: function(err) {

                }
            });
        }

        function editContent(id) {
            window.location.replace('/editfaq/' + id);
        }

        function delFaq(id) {
            let data = {
                id: id,
                _token: '{{ csrf_token() }}'
            }
            $.ajax({
                url: "{{ route('faq.del_faq') }}",
                method: "DELETE",
                dataType: "JSON",
                data: data,
                success: function (res) {
                    dataTable.draw();
                },
                error: function (err) {

                }
            })
        }

        function acceptFaq(id) {
            let data = {
                _token: '{{ csrf_token() }}'
            }
            $.ajax({
                url: "/faq/accept_faq/" + id,
                method: "GET",
                dataType: "JSON",
                data: data,
                success: function (res) {
                    dataTable.draw();
                },
                error: function (err) {

                }
            })
        }

        function rejectFaq(id) {
            let data = {
                _token: '{{ csrf_token() }}'
            }
            $.ajax({
                url: "/faq/reject_faq/" + id,
                method: "GET",
                dataType: "JSON",
                data: data,
                success: function (res) {
                    dataTable.draw();
                },
                error: function (err) {

                }
            })
        }

        /* Formatting function for row details - modify as you need */
        function format(d) {
            // `d` is the original data object for the row
            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
                '<tr>' +
                '<td>A:</td>' +
                '<td>' + d.answer + '</td>' +
                '</tr>' +
                '</table>';
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
                            <h5>FAQ List</h5>
                            <a href="javascript:void(0);" class="btn btn-default pull-right addcate"> Category Manage </a>
                            <a href="{{route('create_faq',['add'])}}" class="btn btn-default pull-right addnews"> Add Question </a>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="bugtracker_table" class="table datalist">
                                        <thead>
                                        <tr>
                                            <th width="5%"></th>
                                            <th width="30%">Content</th>
                                            <th width="10%">Created</th>
                                            <th width="15%">Category</th>
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
    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="successModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title">Add Category</h4>
                </div>
                <div class="modal-body">
                    <div id="table_div" class="table-responsive">
                        <div class="row addcategoryrow">
                            <label class="col-sm-4 col-md-3">Category: </label>
                            <input type="text" id="category_name" class="form-control col-md-6 col-sm-8"/>
                            <input type="hidden" id="eid" value=""/>
                            <button class="btn action_btn col-md-2 col-sm-12 save_category">Save</button>
                        </div>
                        <table id="table" class="table datalist" style="color: #ffe4c7;">
                            <thead>
                            <tr>
                                <th class="text-center">Category Name</th>
                                <th class="text-center">Sort</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
