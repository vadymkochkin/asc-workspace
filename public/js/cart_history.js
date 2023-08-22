
$(document).ready(function () {
  var _token = $('meta[name="_token"]').attr('content');
  var col = [
    {"data": "no"},
    {"data": "total_items"},
    {"data": "total_dp"},
    {"data": "created"},
    {"data": "action"}
  ];
  $('#bugtracker_table').DataTable({
    serverSide: false,
    "order": [],
    "columns": col,
    "ajax":
      {
        url: "https://" + window.location.hostname + "/store/display-cart-report",
        type: "POST",
        data: {
          _token,
        },
      },
    "language": {
      "paginate": {
        "previous": "&#706",
        "next": "&#707"
      }
    }
  });

  function displayCart(display_data) {
    var html_output = `
    <div class="row">
      <div class="col-md-12 p-0">
        <table class="table-ascension">
          <thead>
            <tr>
              <th scope="col">PRODUCT</th>
              <th scope="col" class="center">REALM</th>
              <th scope="col" class="center">CHARACTER</th>
              <th scope="col" class="center">PRICE</th>
              <th scope="col" class="center">QTY</th>
              <th scope="col" class="center">SUB TOTAL</th>
              <th scope="col" class="center">MARK</th>
            </tr>
          </thead>
          <tbody>`;
          $(display_data.details).each(function () {
            html_output += `
            <tr>
              <td scope="row" class="d-flex product align-items-center align-content-middle">
                <a href="` + this.url + `" target='_blank'>
                  <img src= "` + this.image + `">
                </a>
                <div class="product-img-desc align-self-center d-flex">
                  <p class="product-img-title">` + this.item_name + `</p>
                  <p>` + this.group + `</p>
                </div>
              </td>
              <td class="realm">
                <div class="d-flex justify-content-center">
                  <p class="character-text mr-1">` + this.realm + `</p>
                </div>
              </td>
              <td class="character-selector">
                <div class="d-flex justify-content-center">
                  <p class="character-text mr-1">` + this.character + `</p>
                </div>
              </td>
              <td class="product-price">
                <div class="d-flex justify-content-center">
                  <img class="acc-p-img" src="/media/icon/dp.svg" height="20px">
                  <p class="product-price-text">` + this.product_price + `</p>
                </div>
              </td>
              <td class="product-amount">
                <div class="d-flex justify-content-center">
                  <p class="product-amount-text">` + this.quantity + `</p>
                </div>
              </td>
              <td class="product-total">
                <div class="d-flex justify-content-center">
                  <img class="acc-p-img" src="/media/icon/dp.svg" height="20px">
                  <p class="product-price-text">` + parseInt(this.product_price) * parseInt(this.quantity) + `</p>
                </div>
              </td>
              <td class="product-total">`;
              if (this.is_active == 1) {
                html_output += `
                <div class="d-flex justify-content-center">
                  <input type="checkbox" class="add-to-cart-again" name="add-to-cart-again" value = "` + this.item_u_id + `" char="` + this.character + `" char_type="` + this.character_type + `" qt="` + this.quantity + `" checked>
                </div>`;
              }
              else {
                html_output += `
                <div class="d-flex justify-content-center">
                  <p>NA</p>
                </div>`;
              }
              html_output += `
              </td>
            </tr>`;
            });
          html_output += `
          </tbody>
          <tfoot>
            <tr>
              <td class="subtotal d-flex">
                <p class="subtotal-title">TOTAL</p>
                <div class="d-flex">
                  <img class="subtotal-img" src="/media/icon/dp.svg" height="20x">
                  <p class="subtotal-text">` + display_data.total_dp + `</p>
                </div>
              </td>
              <td colspan="6">
                <a class="purchase-btn float-right" data-dismiss="modal" id="purchase-again">Purchase Again</a>
                <a class="purchase-btn mr-1 float-right" data-dismiss="modal">Close</a>
              </td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>`;
    $('#cart-id').text("Cart Details (Cart ID : " + display_data.cart_id + ")");
    $('.cart-detail-data').html(html_output);
    $("#LoadingImage").hide();
    $("#cart-details").modal('show');
  }

  $("#bugtracker_table").on("click", ".cart-trigger", function () {
    var cart_id = $(this).attr('cart-id');
    $("#LoadingImage").show();
    $.ajax({
      url: "https://" + window.location.hostname + "/store/display-cart",
      type: "POST",
      CrossDomain: true,
      data: {
        cart_id: cart_id,
        _token,
      },
      success: function (response) {
        displayCart(JSON.parse(response));
      }
    });
  });

  $(".cart-detail-data").on("click", "#purchase-again", function () {
    var checked = []
    $("input[name='add-to-cart-again']:checked").each(function () {
      var elem = `
        {
          "u_id" : "` + parseInt($(this).val()) + `",
          "character" : "` + $(this).attr("char") + `",
          "character_type" : "` + $(this).attr("char_type") + `",
          "quantity"  : "` + $(this).attr("qt") + `"
        }`;
      checked.push(JSON.parse(elem));
    });
    $("#LoadingImage").show();
    $.ajax({
      url: "https://" + window.location.hostname + "/store/purchase_again",
      type: "POST",
      CrossDomain: true,
      data: {
        cart_info: JSON.stringify(checked),
        _token,
      },
      success: function (response) {
        console.log(response);
        $("#LoadingImage").hide();
      }
    });
  });

});
