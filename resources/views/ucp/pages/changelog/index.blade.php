@extends('ucp.templates.app')
@section('pageTitle', 'Changelog Manage')
@section('additional_headers')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
@endsection

@section('content')
    <div class="content-wrapper wrapper-default">
        <section>
            <div class="container-fluid">
                <div class="content-inner">
                    <div class="content-body">
                        <div class="content-title" style="position: relative;">
                            <div class="row">
                              <div class="col-lg-6 col-md-12">
                                <h5>Changelog List</h5>
                              </div>
                              <div class="col-lg-6 col-md-12">
                                <button id="new_catagory" class="btn-asc float-right"> Add Category </button>
                                <button id="new_changelog" class="btn-asc float-right mr-1"> Add Change </button>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="bugtracker_table" class="table datalist">
                                        <thead>
                                        <tr>
                                            <th width="35%">Changelog</th>
                                            <th width="20%">Category</th>
                                            <th width="15%">Creator</th>
                                            <th width="15%">Date</th>
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

    @include("ucp.pages.changelog.alertmodal")

@endsection

@section('additional_scripts')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script>
        var dataTable;
        $(document).ready(function () {
            dataTable = $('#bugtracker_table').DataTable({
                "serverSide": false,
                "processing": true,
                "order": [],
                "ajax":
                    {
                        url: "{{ route('changelog.list') }}",
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
        $(document).ready(function () {

          $("#new_catagory" ).click(function() {
            $('#add_catagory').modal('show');
          });

          $("#new_changelog" ).click(function() {
            $('#add_changelog').modal('show');
          });

          $("#bugtracker_table").on("click", "a[title='Delete']", function(ev) {
             var link = $(this).attr('t-link');
             Swal.fire({
               title: "Are you sure?",
               text: "Once deleted, This changelog will be deleted forever",
               type: "warning",
               buttons: true
             })
             .then((willDelete) => {
               if (willDelete) {
                 window.location.replace(link);
               }
             });
          });
        });
    </script>

    @if($errors->first('error'))
      <script>
        $(document).ready(function () {
        Swal.fire({
          title: "Error!",
          text: "{{$errors->first('error')}}",
          type: "error",
          });
        });
      </script>
    @endif

    @if(session()->has('success'))
      <script>
        $(document).ready(function () {
        Swal.fire({
          title: "Success!",
          text: " {{ session()->get('success') }}",
          type: "success",
          });
        });
      </script>
    @endif

    @if(session()->has('edit_info'))
      <script>
        $(document).ready(function () {
          $('#edit_changelog').modal('show');
        });
      </script>
    @endif

    @if(session()->has('show_info'))
    <script>
      $(document).ready(function () {
        $('#show_changelog').modal('show');
      });
    </script>
    @endif

@endsection
