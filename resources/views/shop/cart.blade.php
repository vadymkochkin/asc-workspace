@extends('templates.app')

@section('pageTitle', 'My Cart - ')

@section('content')
<div id="page-img-container">
    <img id="page-background" src="{{ asset('media/image/backgrounds/background_6.png')}}">
</div>
    <div class="modal" id="cart-state">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Message</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body cart-state">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="item-duplicator" tabindex="-1" role="dialog" data-backdrop="static"
         data-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Item Duplicator (Purchase for another realm)</h5>
                </div>
                <div class="modal-body duplicator">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-asc p-fix" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-asc duplicate-this p-fix" data-dismiss="modal">Next</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="character-editor" tabindex="-1" role="dialog" data-backdrop="static"
         data-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Character Selector (Realm : <strong class='char-realm'></strong>)</h5>
                </div>
                <div class="modal-body char-editor">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-asc update-cart-with-char" data-dismiss="modal">Update Cart
                    </button>
                </div>
            </div>
        </div>
    </div>
    <section id="shop-item" class="justify-content-center">
        <div class="container">
            <div class="row justify-content-center align-items-center text-center col-md-12">
                <div class="col-12 text-left">
                    <h1 id="cart-title">Shopping Cart</h1>
                </div>
                <div class="col-12" style="overflow: auto;">
                    <table class="table-ascension">
                        <thead>
                        <tr>
                            <th scope="col">PRODUCT</th>
                            <th scope="col" class="center">REALM</th>
                            <th scope="col" class="center">CHARACTER</th>
                            <th scope="col" class="center">PRICE</th>
                            <th scope="col" class="center">QTY</th>
                            <th scope="col" class="center">SUB TOTAL</th>
                            <th scope="col" class="center">ACTION</th>
                        </tr>
                        </thead>
                        <tbody id="cart-calc-body">
                        </tbody>
                        <tfoot>
                        <tr>
                            <td class="subtotal d-flex">
                                <p class="subtotal-title">TOTAL</p>
                                <div class="d-flex">
                                    <img class="subtotal-img" src="../media/icon/dp.svg" height="20x">
                                    <p id="dp-total" class="subtotal-text">0</p>
                                </div>
                            </td>
                            <td colspan="6">
                                <form id="cart-checkout" method="POST" action="{{url("/checkout")}}">
                                    @csrf
                                    <input type="hidden" name="cart_data">
                                    <input type="hidden" name="product_info">
                                    <a class="purchase-btn float-right">Checkout</a>
                                </form>
                                <a id="empty-cart" class="purchase-btn float-right mr-1">Reset</a>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- <footer class="align-items-center d-flex justify-content-center">
        <a href="#top">
            <h5>Back to top</h5>
        </a>
    </footer> -->
    <!-- Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header text-center justify-content-center">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Confirm Purchase</h5>
                </div>
                <div class="modal-body text-center">
                    Would you like to buy one <span class="item-name">Whomper</span> for 5 coins?
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="modal"
                            data-target="#failModal">Cancel
                    </button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal"
                            data-target="#successModal">Purchase
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div id="LoadingImage"
         style="display: none; z-index: 99998; left:0; top:0; overflow: hidden; width: 100%; height: 100% ; background-color: #000000CC; position:fixed;">
        <img style="margin-left:-50px; margin-top:-50px; z-index: 99999; left:50%; top: 50%; position:absolute; border: 2px solid #c9aa71; border-radius:50%; padding: 5px;"
             src="{{url('/media/image/shop/ajax-loader.gif')}}"/>
    </div>
    <div class="modal fade" id="failModal" tabindex="-1" role="dialog" aria-labelledby="successModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header text-center justify-content-center">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Purchase Failed!</h5>
                </div>
                <div class="modal-body text-center">
                    We were unable to complete the purchase for <span class="item-name">Whomper</span>, please try
                    again.
                    If this issue persists, please contact us at <span class="item-name">email@example.com</span>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Return
                        to shop
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional_scripts')
    <script type="text/jscript">
      var cart_data = <?php echo $selectedItems;?>;
      var product_info = <?php echo $realmAvailable;?>;

    </script>
    <script src="{{ asset('js/shop/shop-anim.js') }}"></script>
    <script src="{{ asset('js/shop/cart.js') }}"></script>
    <script src="{{ asset('js/jquery-cookie.js') }}"></script>
@endsection
