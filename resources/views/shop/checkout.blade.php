@extends('templates.app')

@section('additional_headers')

@endsection

@section('content')
    <section id="shop-item" class="justify-content-center">
        <div class="container">
            <div class="row justify-content-center align-items-center text-center">
                <div class="col-12 d-flex text-left">
                    <h1 id="cart-title">Thanks for purchasing items</h1>
                </div>
                <div class="col-12">
                    @isset($checkout_data)
                        @if($checkout_data['success'] || $checkout_data['failed'])
                            <table class="table-ascension">
                                <thead>
                                <tr>
                                    <th>PRODUCT</th>
                                    <th>REALM</th>
                                    <th>CHARACTER</th>
                                    <th>PRICE</th>
                                    <th>QTY</th>
                                    <th>SUB TOTAL</th>
                                </tr>
                                </thead>
                                <tbody id="checkout-cart-calc-body">
                                @if($checkout_data['success'])
                                    <tr>
                                        <td colspan="6" style="background-color : #003300; font-weight:bold">
                                            <div class="justify-content-center">SUCCESS</div>
                                        </td>
                                    </tr>
                                    @foreach ($checkout_data['success'] as $checkdata)
                                        <tr style="background-color : #000011">
                                            <td scope="row"
                                                class="d-flex product align-items-center align-content-middle product-details"
                                                url="`+this.realm_available[realm_index].item_url+`">
                                                <img src="{{$checkdata['image']}}">
                                                <div class="product-img-desc align-self-center d-flex">
                                                    <p class="product-img-title">{{$checkdata['item_name']}}</p>
                                                    <p>{{$checkdata['group']}}</p>
                                                </div>
                                            </td>
                                            <td class="realm">
                                                <div class="d-flex justify-content-center">
                                                    <p class="character-text mr-1">{{$checkdata['realm_name']}}</p>
                                                </div>
                                            </td>
                                            <td class="character-selector">
                                                <div class="d-flex justify-content-center">
                                                    <p class="character-text mr-1">{{$checkdata['character']}}</p>
                                                </div>
                                            </td>
                                            <td class="product-price">
                                                <div class="d-flex justify-content-center">
                                                    <img class="acc-p-img" src="../media/icon/dp.svg" height="20px">
                                                    <p class="product-price-text dp-cost">{{$checkdata['unit_dp_price']}}</p>
                                                </div>
                                            </td>

                                            <td class="product-amount">
                                                <div class="d-flex justify-content-center">
                                                    <p class="product-amount-text">{{$checkdata['quantity']}}</p>
                                                </div>
                                            </td>
                                            <td class="product-total">
                                                <div class="d-flex justify-content-center">
                                                    <img class="acc-p-img" src="../media/icon/dp.svg" height="20px">
                                                    <p class="product-price-text dp-subtotal">{{$checkdata['unit_dp_price']*$checkdata['quantity']}}</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="6">
                                            <div class="d-flex float-right">
                                                <p class="subtotal-title mr-2">COST TOTAL:</p>
                                                <img class="subtotal-img mr-2" src="../media/icon/dp.svg" height="20x">
                                                <p id="checkout-dp-total"
                                                   class="subtotal-text">{{$checkout_data['success_total_dp']}}</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                                @if($checkout_data['failed'])
                                    <tr>
                                        <td colspan="6" style="background-color : #330000; font-weight:bold">
                                            <div class="justify-content-center">FAILED</div>
                                        </td>
                                    </tr>
                                    @foreach ($checkout_data['failed'] as $checkdata)
                                        <tr style="background-color : #100000">
                                            <td scope="row"
                                                class="d-flex product align-items-center align-content-middle product-details"
                                                url="`+this.realm_available[realm_index].item_url+`">
                                                <img src="{{$checkdata['image']}}">
                                                <div class="product-img-desc align-self-center d-flex">
                                                    <p class="product-img-title">{{$checkdata['item_name']}}</p>
                                                    <p>{{$checkdata['group']}}</p>
                                                </div>
                                            </td>
                                            <td class="realm">
                                                <div class="d-flex justify-content-center">
                                                    <p class="character-text mr-1">{{$checkdata['realm_name']}}</p>
                                                </div>
                                            </td>
                                            <td class="character-selector">
                                                <div class="d-flex justify-content-center">
                                                    <p class="character-text mr-1">{{$checkdata['character']}}</p>
                                                </div>
                                            </td>
                                            <td class="product-price">
                                                <div class="d-flex justify-content-center">
                                                    <img class="acc-p-img" src="../media/icon/dp.svg" height="20px">
                                                    <p class="product-price-text dp-cost">{{$checkdata['unit_dp_price']}}</p>
                                                </div>
                                            </td>

                                            <td class="product-amount">
                                                <div class="d-flex justify-content-center">
                                                    <p class="product-amount-text">{{$checkdata['quantity']}}</p>
                                                </div>
                                            </td>
                                            <td class="product-total">
                                                <div class="d-flex justify-content-center">
                                                    <img class="acc-p-img" src="../media/icon/dp.svg" height="20px">
                                                    <p class="product-price-text dp-subtotal">{{$checkdata['unit_dp_price']*$checkdata['quantity']}}</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="6">
                                            <div class="d-flex float-right">
                                                <p class="subtotal-title mr-2">RETURN TOTAL :</p>
                                                <img class="subtotal-img mr-2" src="../media/icon/dp.svg" height="20x">
                                                <p id="checkout-dp-total"
                                                   class="subtotal-text">{{$checkout_data['failed_total_dp']}}</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        @endif
                    @endisset
                </div>
            </div>
        </div>
    </section>
@endsection
