$(document).ready(function(){

  $("#shop-item").on("click", ".subtract", function(){
    let obj = $(this);
    cartCalculator("sub", obj);
  });

  $("#shop-item").on("click", ".addition", function(){
    let obj = $(this);
    cartCalculator("add", obj);
  });

  function cartCalculator(operation, obj){
    var qty_object = obj.parents("tr").find(".product-amount-text");
    var price_object = obj.parents("tr").find(".dp-cost");
    var realm = parseInt(obj.parents("tr").attr("realm"));
    var item_index = obj.parents("tr").attr("item-index");
    var subtotal_object = obj.parents("tr").find(".dp-subtotal");
    var character = obj.parents("tr").find(".character-text").text();
    if (character == "Empty") character = "";
    let qty = parseInt(qty_object.text());
    let price = parseInt(price_object.text());
    if (qty >= 1 ){
      if(operation == "sub" && qty > 1){
        qty = qty-1;
        qty_object.text(qty);
        subtotal_object.text(qty*price);
      }
      else if(operation == "add"){
        qty = qty+1;
        qty_object.text(qty);
        subtotal_object.text(qty*price);
      }
      $(cart_data).each(function(){
        if(this.realm == realm && this.character == character){
          for(var k = 0; k < this.purchase_details.length; k++){
            if(this.purchase_details[k].item_id == parseInt(item_index)){
              this.purchase_details[k].quantity = qty;
              break;
            }
          }
        }
      });
      updateTotal();
    }
  }

  function cartLoader(data, product_info){
    var data_index = data.length;
    var cor_check = false;
    if(data_index > 0 && product_info.length > 0 && data_index != undefined && product_info != undefined){
      while ( data_index-- ){
        if(data[data_index].purchase_details.length == 0){
          data.splice(data_index, 1);
          cor_check = true;
        }
      }
      if(cor_check) {
        cart_data = data;
      }
      var cart_body;
      for (var i = 0; i < data.length; i++){
        for(var j = 0; j < data[i].purchase_details.length; j++){
          var current_realm = data[i].realm;
          $(product_info).each(function(){
            if(this.item_id == data[i].purchase_details[j].item_id){
              for(var realm_index = 0; realm_index < this.realm_available.length; realm_index++){
                var dp, quantity, bg_switcher;
                if(this.realm_available[realm_index].item_realm_id == current_realm){
                  if(data[i].character == "" || data[i].character_type == ""){
                    bg_switcher = "background-color : #100000";
                  }
                  else if(data[i].character_type == "other" && data[i].character != ""){
                    bg_switcher = "background-color : #000011";
                  }
                  else{
                    bg_switcher = "";
                  }
                  dp = this.realm_available[realm_index].item_dp;
                  quantity = data[i].purchase_details[j].quantity;
                  cart_body +=
                 `<tr item-index="`+data[i].purchase_details[j].item_id+`" realm = "`+current_realm+`" char = "`+data[i].character+`" char-type = "`+data[i].character_type+`" style = "`+bg_switcher+`">
                    <td scope="row" class="d-flex product text-left align-items-center align-content-middle product-details" url="`+this.realm_available[realm_index].item_url+`">
                    <img src="`+this.realm_available[realm_index].item_image+`">
                    <div class="product-img-desc align-self-center d-flex">
                      <p class="product-img-title">`+this.realm_available[realm_index].item_title+`</p>
                      <p>`+this.realm_available[realm_index].item_group+`</p>
                    </div>
                    </td>
                    <td class="realm">
                      <div class="d-flex justify-content-center">
                        <select class ="realm-selector">`;
                        if(data[i].purchase_details[j].item_id == this.item_id){
                          for (var m = 0; m < this.realm_available.length; m++){
                            if(this.realm_available[m].item_realm_id == current_realm){
                              cart_body += `<option value="`+this.realm_available[m].item_realm_id+`" selected>`+this.realm_available[m].item_realm_name+`</option>`;
                            }
                            else {
                              cart_body += `<option value="`+this.realm_available[m].item_realm_id+`">`+this.realm_available[m].item_realm_name+`</option>`;
                            }
                          }
                        }
                        var char_display, char_text_class;
                        if(data[i].character == ""){
                          char_display = "Empty";
                          char_text_class = " text-danger";
                        }
                        else{
                          char_display = data[i].character;
                          char_text_class = "";
                        }
                        cart_body +=
                       `</select>
                      </div>
                    </td>
                    <td class="character-selector">
                        <div class="d-flex justify-content-center">
                          <p class="character-text mr-1`+char_text_class+`">`+char_display+`</p>
                          <button class="character-selection btn btn-asc">
                            <i class="material-icons">edit</i>
                          </button>
                        </div>
                    </td>
                    <td class="product-price">
                        <div class="d-flex justify-content-center">
                            <img class="acc-p-img" src="../media/icon/dp.svg" height="20px">
                            <p class="product-price-text dp-cost">`+dp+`</p>
                        </div>
                    </td>

                    <td class="product-amount">
                        <div class="d-flex justify-content-center">
                            <img class="subtract" src="../media/icon/Subtract2.svg">
                            <p class="product-amount-text">`+quantity+`</p>
                            <img class="addition" src="../media/icon/Plus Math2.svg">
                        </div>
                    </td>
                    <td class="product-total">
                        <div class="d-flex justify-content-center">
                            <img class="acc-p-img" src="../media/icon/dp.svg" height="20px">
                            <p class="product-price-text dp-subtotal">`+(dp * quantity)+`</p>
                        </div>
                    </td>
                    <td class="action">
                        <div class="d-flex justify-content-center">
                            <button class="item-remove btn btn-asc mr-1">
                              <i class="material-icons">cancel</i>
                            </button>
                            <button class="item-duplicate btn btn-asc" data-toggle="modal" data-target="#item-duplicator">
                              <i class="material-icons">add_box</i>
                            </button>
                        </div>
                    </td>
                  </tr>`;
                }
              }
            }
          });
        }
      }
      $("#cart-calc-body").html(cart_body);
      updateTotal();
    }
    else{
      $("#cart-calc-body").html("<tr><td colspan ='7' class='text-center'><h1>Your cart seems to be empty!</h1><h2>Let's add some items first.</h2><a href='https://"+window.location.hostname+"/store'><h3><u>Take me to the store</u></h3></a></td></tr>");
      $("#shop-item tfoot").hide();
    }
  }

  function updateTotal(){
    let subtotal_elements = $("#cart-calc-body").children();
    var total = 0;
    subtotal_elements.each(function(element){
      total += parseInt($(this).find(".dp-subtotal").text());
    });
    $("#dp-total").text(total);
    var temp_cart = JSON.stringify(cart_data);
    var temp_product = JSON.stringify(product_info);
    if (sync_cart_data != temp_cart || sync_product_info != temp_product){
      sync_cart_data == temp_cart;
      sync_product_info = temp_product;
      var _token = $('meta[name="_token"]').attr('content');
      $("#LoadingImage").show();
      $.ajax({
        url: "https://"+window.location.hostname+"/save",
        type: "POST",
        data: {
          cart_data : temp_cart,
          _token
        },
        success:function(response) {
          $("#LoadingImage").hide();
          if(response != "Cart successfully saved!"){
            $('#cart-state .cart-state').text("There was an error!");
            $('#cart-state').modal('show');
          }
        }
      });
    }
  }

  $("#empty-cart").on("click", function(){
    var _token = $('meta[name="_token"]').attr('content');
    var temp = [];
    temp = JSON.stringify(temp);
    $("#LoadingImage").show();
    $.ajax({
      url: "https://"+window.location.hostname+"/save",
      type: "POST",
      data: {
        cart_data : temp,
        _token
      },
      success:function(response) {
        $("#LoadingImage").hide();
        $('#cart-state .cart-state').text(response);
        $('#cart-state').modal('show');
        cartLoader(cart_data, product_info);
      }
    });
  });

  $("#shop-item").on("click", ".item-remove", function(){
    let realm = parseInt($(this).parents("tr").attr("realm"));
    let item_index = $(this).parents("tr").attr("item-index");
    let character = $(this).parents("tr").find(".character-text").text();
    if (character == "Empty") character = "";
    let i = cart_data.length;
    while ( i-- ){
      if(cart_data[i].realm == realm && cart_data[i].character == character){
        for(var j = 0; j < cart_data[i].purchase_details.length; j++){
          if(cart_data[i].purchase_details[j].item_id == parseInt(item_index)){
            cart_data[i].purchase_details.splice(j, 1);
            break;
          }
        }
      }
    }
    cartLoader(cart_data, product_info);
  });

  $("#shop-item").on("click", ".character-selection", function(){
    let obj = $(this);
    characterSelector(obj);
  });

  $("#shop-item").on("change", ".realm-selector", function(){
    let obj = $(this);
    characterSelector(obj);
  });

  function characterSelector(cap_object){
    $("#shop-item").data("se_obj", cap_object);
    var _token = $('meta[name="_token"]').attr('content');
    var target_index = cap_object.parents("tr").attr("item-index");
    var char = cap_object.parents("tr").attr("char");
    var char_type = cap_object.parents("tr").attr("char-type");
    var product_title = cap_object.parents("tr").find(".product-img-title").text();
    var pre_realm = parseInt(cap_object.parents("tr").attr("realm"));
    var realm = parseInt(cap_object.parents("tr").find(".realm-selector option:selected").val());
    var product_quantity = cap_object.parents("tr").find(".product-amount-text").text();
    var realm_name = cap_object.parents("tr").find(".realm-selector option:selected").text();
    var assigned_char = [];
    $('#cart-calc-body').children().filter(function() {
      if($(this).attr("realm") == realm && $(this).attr("item-index") == target_index ){
        assigned_char.push( $(this).attr('char'));
      }
    });
    $('#character-editor .char-realm').text(realm_name);
    $("#LoadingImage").show();
    $.ajax({
      url: "https://"+window.location.hostname+"/char",
      type: "POST",
      data: {
        realm_id : realm,
        _token
      },
      success:function(char_data) {
        $("#LoadingImage").hide();
        var char_state = true;
        char_data = JSON.parse("["+char_data+"]");
        var editor_body = "<p class='char-editor-heading' pre-realm = '"+pre_realm+"' realm = '"+realm+"' item-quantity='"+product_quantity+"' item-id='"+target_index+"' char='"+char+"' char-type='"+char_type+"'>Please select character(s) you wish to send item : <b>"+product_title+"</b></p>";
        editor_body += "<div class='own-character'>";
        $(char_data).each(function(){
          editor_body += "<p class='own-character-text'>Your own character(s):</p>";
          if(this.hasOwnProperty("characters") && this.characters.length > 0){
            for(var i = 0; i < this.characters.length; i++){
              if(assigned_char.indexOf(this.characters[i]) == -1){
                editor_body += "<div class='own-character-checkbox'><input type='checkbox' name='own-character-checkbox' value='"+this.characters[i]+"'>"+this.characters[i]+"</div>";
                char_state = false;
              }
            }
          }
          else{
            char_state = false;
            editor_body += "<p class='own-empty-character'>You don't have any character in realm: "+realm_name+"</p>";
          }
        });
        if(char_state){
          editor_body += "<p class='own-empty-character'>All available characters have already been selected for realm: "+realm_name+" </p>";
        }
        editor_body += "</div>";
        editor_body += "<div class='other-character'>";
        editor_body += "<p class='other-character-text'>Search and add character(s) to send this item.(Character level will be added automatically)</p>";
        editor_body += "<div class='other-characters'></div>";
        editor_body += "<input type='text' class='other-character-input' placeholder='Character name' style='padding: 10px'/>";
        editor_body += "<button class='other-character-add btn btn-asc'><i class='material-icons'>add</i></button></div>";
        $("#character-editor").find(".char-editor").html(editor_body);
        $('#character-editor').modal('show');
      }
    });
  };

  $("#character-editor").on("click", ".other-character-add", function(){
    var _token = $('meta[name="_token"]').attr('content');
    var target_index = parseInt($('#character-editor .char-editor-heading').attr("item-id"));
    var realm = parseInt($('#character-editor .char-editor-heading').attr("realm"));
    var character = $('#character-editor .other-character-input').val();
    var assigned_char = [];
    var assigned_char_wl = [];
    $('#cart-calc-body').children().filter(function() {
      if($(this).attr("realm") == realm && $(this).attr("item-index") == target_index ){
        if($(this).attr('char').indexOf("(Lv") != -1 ){
          assigned_char.push($(this).attr('char').split("(Lv")[0]);
        }
        else{
          assigned_char.push($(this).attr('char'));
        }
        assigned_char_wl.push($(this).attr('char'));
      }
    });
    var check = true;
    var other_char_body = '';
    if (assigned_char.indexOf(character.split("(Lv")[0]) == -1){
      $("#character-editor input:checkbox[class=other-char-checkbox]").each(function () {
        if($(this).val().startsWith(character + "(Lv")) {
          check = false;
          other_char_body += `<div class="alert alert-warning alert-dismissible fade show char-alert" role="alert">
                                <strong>Character already added!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>`;
        }
      });
    }
    else{
      let char_index = assigned_char.indexOf(character.split("(Lv")[0]);
      check = false;
      other_char_body += `<div class="alert alert-warning alert-dismissible fade show char-alert" role="alert">
                            <strong>This item is already in cart for character: `+assigned_char_wl[char_index]+`</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>`;
    }
    $("#character-editor").find(".other-characters").prepend(other_char_body);
    $("#character-editor").find(".other-character-input").val("");
    $(".char-alert").delay(5000).slideUp(200, function() {
        $(this).alert('close');
    });
    if (character != "" && check){
      var other_char_body = '';
      $("#LoadingImage").show();
      $.ajax({
        url: "https://"+window.location.hostname+"/other",
        type: "POST",
        data: {
          realm_id : realm,
          character: character,
          _token
        },
        success:function(char_data) {
          $("#LoadingImage").hide();
          char_data = JSON.parse("["+char_data+"]");
          $(char_data).each(function(){
            if(this.hasOwnProperty("characters") && this.characters.length > 0){
              for(var i = 0; i < this.characters.length; i++){
                other_char_body += "<div class='other-character-checkbox'><input type='checkbox' class='other-char-checkbox' name='other-character-checkbox' value='"+this.characters[i]+"'>"+this.characters[i]+"</div>";
              }
            }
            else{
              other_char_body += `<div class="alert alert-warning alert-dismissible fade show char-alert" role="alert">
                                    <strong>Character was not found in this realm!</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>`;
            }
          });
          $("#character-editor").find(".other-characters").prepend(other_char_body);
          $("#character-editor").find(".other-character-input").val("");
          $(".char-alert").delay(5000).slideUp(200, function() {
              $(this).alert('close');
          });
        }
      });
    }
  });

  $("#character-editor").on("click", ".update-cart-with-char", function(){
    var pre_realm = parseInt($('#character-editor .char-editor-heading').attr("pre-realm"));
    var realm = parseInt($('#character-editor .char-editor-heading').attr("realm"));
    var item_index = parseInt($('#character-editor .char-editor-heading').attr("item-id"));
    var quantity = parseInt($('#character-editor .char-editor-heading').attr("item-quantity"));
    var char = $('#character-editor .char-editor-heading').attr("char");
    var char_type = $('#character-editor .char-editor-heading').attr("char-type");
    var own_selected_char = $("#character-editor input:checkbox[name=own-character-checkbox]:checked").map(function(){
      return $(this).val();
    }).get();
    var other_selected_char = $("#character-editor input:checkbox[class=other-char-checkbox]:checked").map(function(){
      return $(this).val();
    }).get();
    if(own_selected_char.length > 0 || other_selected_char.length > 0){
      var duplicate = $('#character-editor').data('duplicator');
      $(cart_data).each(function(){
        if(this.character == char && this.realm == pre_realm && duplicate == undefined){
          for(var j = 0; j < this.purchase_details.length; j++ ){
            if(this.purchase_details[j].item_id == item_index){
              this.purchase_details.splice(j, 1);
            }
          }
        }
        for(var ow = 0; ow < own_selected_char.length; ow++){
          if(this.character == own_selected_char[ow] && this.realm == realm && this.character_type == "self"){
            this.purchase_details.push(JSON.parse('{ "item_id" : '+item_index+', "quantity" : '+quantity+'}'));
            own_selected_char.splice(ow, 1);
          }
        }
        for(var ot = 0; ot < other_selected_char.length; ot++){
          if(this.character == other_selected_char[ot] && this.realm == realm && this.character_type == "other"){
            this.purchase_details.push(JSON.parse('{ "item_id" : '+item_index+', "quantity" : '+quantity+'}'));
            other_selected_char.splice(ot, 1);
          }
        }
      });
      for(var ow = 0; ow < own_selected_char.length; ow++){
        let new_cart_el =
        `{
          "character": "`+own_selected_char[ow]+`",
          "realm": `+realm+`,
          "character_type": "self",
          "purchase_details": [
            {
              "item_id": `+item_index+`,
              "quantity": `+quantity+`
            }
          ]
        }`;
        cart_data.push(JSON.parse(new_cart_el));
      }
      for(var ot = 0; ot < other_selected_char.length; ot++){
        let new_cart_el =
        `{
          "character": "`+other_selected_char[ot]+`",
          "realm": `+realm+`,
          "character_type": "other",
          "purchase_details": [
            {
              "item_id": `+item_index+`,
              "quantity": `+quantity+`
            }
          ]
        }`;
        cart_data.push(JSON.parse(new_cart_el));
      }
      cartLoader(cart_data, product_info);
    }
    else{
      $("#shop-item").data("se_obj").val(pre_realm);
    }
  });

  $("#shop-item").on("click", ".item-duplicate", function(){
    $('#item-duplicator').data('obj', $(this));
    var target_index = $(this).parents("tr").attr("item-index");
    var product_title = $(this).parents("tr").find(".product-img-title").text();
    var realm = parseInt($(this).parents("tr").attr("realm"));
    var product_quantity = $(this).parents("tr").find(".product-amount-text").text();
    var realm_options = "<p class='item-duplicator-heading' item-quantity='"+product_quantity+"' item-id='"+target_index+"'>Select a realm to duplicate: <b>"+product_title+"</b></p>";
    realm_options += "<div class='duplicator-realm'><select class='duplicator-realm-select'>";
    realm_options += $(this).parents("tr").find(".realm-selector").html();
    realm_options += "</select></div>";
    $(".duplicator").html(realm_options);
  });

  $("#item-duplicator").on("click", ".duplicate-this", function(){
    let realm_id = $("#item-duplicator").find(".duplicator-realm-select option:selected").val();
    let realm_name = $("#item-duplicator").find(".duplicator-realm-select option:selected").text();
    let pre_realm = $('#item-duplicator').data('obj').parents("tr").find(".realm-selector").val();
    let obj = $('#item-duplicator').data('obj').parents("tr").find(".realm-selector").val(realm_id);
    characterSelector(obj);
    $('#item-duplicator').data('obj').parents("tr").find(".realm-selector").val(pre_realm);
    $('#character-editor').data('duplicator', true);
    $('#character-editor').modal('show');
  });

  $('#cart-calc-body').on("click", ".product-details", function(){
    let url = $(this).attr("url");
    window.open(url, '_blank');
  });

  $('#cart-checkout .purchase-btn').on("click", function(){
    var corrupted = false;
    $(cart_data).each(function(){
      if(this.character == "" || this.realm == ""){
        corrupted = true;
        return true;
      }
    });
    if(!corrupted){
      $('#cart-checkout input[name=cart_data]').val(JSON.stringify(cart_data));
      $('#cart-checkout').submit();
    }
    else{
      $('#cart-state .cart-state').text("Your cart seems to be corrupted! You can't add any item with \"Empty\" character.");
      $('#cart-state').modal('show');
    }
  });
  var sync_cart_data = JSON.stringify(cart_data);
  var sync_product_info = JSON.stringify(product_info);
  cartLoader(cart_data, product_info);

});
