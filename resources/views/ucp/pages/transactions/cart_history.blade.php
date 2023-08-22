@extends('ucp.templates.app')
@section('pageTitle', 'Cart History')
@section('additional_headers')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
          integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
@endsection
@section('additional_scripts')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ secure_asset('js/cart_history.js') }}"></script>
@endsection
@section('content')
    <div class="modal fade" id="cart-details" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
        <div style="max-width:90% !important; padding-right:0px !important"
             class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cart-id"></h5>
                </div>
                <div class="modal-body cart-detail-data">
                </div>
            </div>
        </div>
    </div>
    <div class="content-wrapper wrapper-default">
        <section>
            <div class="container-fluid">
                <div class="content-inner">
                    <div class="content-body">
                        <div class="content-title">
                            <h5>Cart History</h5>
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
                                            <th>Total Items</th>
                                            <th>Total DP</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
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
