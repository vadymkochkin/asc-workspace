@extends('ucp.templates.app')
@section('pageTitle', 'Item Purchase History')
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
                {"data": "image"},
                {"data": "item_name"},
                {"data": "realm_name"},
                {"data": "character"},
                {"data": "quantity"},
                {"data": "status"},
                {"data": "total"},
                {"data": "created"}
            ];
            $('#bugtracker_table').DataTable({
                serverSide: false,
                "order": [],
                "columns": col,
                "ajax":
                    {
                        url: "{{ route('store.display_api') }}",
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
                            <h5>Item Purchase History</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="bugtracker_table" class="table datalist">
                                        <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Item Name</th>
                                            <th>Realm</th>
                                            <th>Character</th>
                                            <th>Quantity</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Created</th>
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
