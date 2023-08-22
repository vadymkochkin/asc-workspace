$(document).ready(function(){
    let images = document.querySelectorAll("img[src='https://"+window.location.hostname+"/media/image/shop/lazy-load.svg']");
    lazyload(images);
    var _token = $('meta[name="_token"]').attr('content');
    $(document).on("click", ".item-delete", function(){
        var u_id = $(this).parent().attr("u-id");
        var url = "https://"+window.location.hostname+"/manage_store/item-delete";
        Swal.fire({
          title: "Are you sure?",
          text: "Once deleted, This item will be hidden",
          type: "warning",
          buttons: true
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              url: url,
              type: "POST",
              data: {
                id: u_id,
                _token
              },
              success:function(response) {
                $("#LoadingImage").hide();
                Swal.fire({
                  title: "Success",
                  text: JSON.parse(response),
                  type: "success"
                }).then(() => {
                  window.location.replace(window.location.href);
                });
              },
              error:function(){
                $("#LoadingImage").hide();
                Swal.fire({
                  title: "Error",
                  text: "There was an error, Try later.",
                  type: "error"
                });
              }
            });
          }
        });
    });

    $(document).on("click", ".item-featured", function(){
        var u_id = $(this).parent().attr("u-id");
        var url = "https://"+window.location.hostname+"/manage_store/add-to-featured";
        manageItems(u_id, url, "featured");
    });

    $(document).on("click", ".item-limited", function(){
        var u_id = $(this).parent().attr("u-id");
        var url = "https://"+window.location.hostname+"/manage_store/add-to-limited";
        manageItems(u_id, url, "limited");
    });

    function manageItems(u_id, url, type){
      Swal.fire({
        title: "Are you sure?",
        text: "This item will be added to "+type+" items",
        type: "warning",
        buttons: true
      })
      .then((willAdd) => {
        if (willAdd) {
          $.ajax({
            url: url,
            type: "POST",
            data: {
              id: u_id,
              realm: $("#shop-type").attr("realm"),
              _token
            },
            success:function(response) {
              $("#LoadingImage").hide();
              Swal.fire({
                title: "Info",
                text: JSON.parse(response),
                type: "warning"
              });
            },
            error:function(){
              $("#LoadingImage").hide();
              Swal.fire({
                title: "Error",
                text: "There was an error, Try later.",
                type: "error"
              });
            }
          });
        }
      });
    }

    $(document).on('click', '.item-edit', function(){
        var u_id = $(this).parent().attr("u-id");
        var url = "https://"+window.location.hostname+"/manage_store/item-edit";
        requestItemData(url, u_id, "update");
    });

    $(document).on('click', '.item-duplicate', function(){
        var u_id = $(this).parent().attr("u-id");
        var url = "https://"+window.location.hostname+"/manage_store/item-edit";
        requestItemData(url, u_id, "duplicate");
    });

    $(document).on("click", ".item-add", function(){
      modifyItem("add", "add");
    });

    function requestItemData(url, data, type){
        $("#LoadingImage").show();
        $.ajax({
          url: url,
          type: "POST",
          data: {
            id:data,
            _token
          },
          success:function(response) {
            $("#LoadingImage").hide();
            modifyItem(type, JSON.parse(response));
          },
          error:function(){
            $("#LoadingImage").hide();
            $('#item-editor').modal('show');
          }
        });
    }

    function modifyItem(type, init_data){

      if (type == 'update'){
        $("#exampleModalLabel").text('Item Editor');
        $("#item-update").text("Update");
        $("#item-update").attr("add-new", "");
      }
      else if (type == 'add') {
        $("#exampleModalLabel").text('Add New Item');
        $("#item-update").text("Add");
        $("#item-update").attr("add-new", "true");
      }
      else if (type == 'duplicate') {
        $("#exampleModalLabel").text('Item Duplicator');
        $("#item-update").text("Duplicate");
        $("#item-update").attr("add-new", "true");
      }

      var html_output = `
      <form method="POST" id="item-cu" action="" target="" type="`+type+`">`;
        var item_u_id = "";
        if (init_data != "add"){
          item_u_id = init_data.item_information.u_id != null ? init_data.item_information.u_id : "";
        }
        html_output += `
        <input type="hidden" id="additional_text" name="additional_text" value="">
        <input type="hidden" id="additional_images" name="additional_images" value="">
        <input type="hidden" id="item-u-id" value="`+item_u_id+`">
        <input type="hidden" id="item-data" name="item-data" value="">
        <input type="hidden" id="item-token" name="_token" value="">
        <div class="row">
          <div class="col-10 mb-2">
            <label for="item-name">Item Name</label>
            `;
            var item_name = "";
            if (init_data != "add"){
              item_name = init_data.item_information.name != null ? init_data.item_information.name : "";
            }
            html_output +=`
            <input type="text" id="item-name" name="item-name" class="form-control" placeholder="Item name" value="`+item_name+`">
          </div>
          <div class="col-2 mb-2">
            <label for="item-id">Item ID</label>
            `;
            var item_id = "";
            if (init_data != "add"){
              item_id = init_data.item_information.item_id != null ? init_data.item_information.item_id : "";
            }
            html_output +=`
            <input type="text" id="item-id" name="item-id" class="form-control" placeholder="Item ID" value="`+item_id+`">
          </div>
          <div class="col-10 mb-2">
            <label for="image-url">Image URL</label>
            `;
            var featured_image = "";
            if (init_data != "add"){
              featured_image = init_data.item_information.featured_image != null ? init_data.item_information.featured_image : "";
            }
            html_output +=`
            <input type="text" id="image-url" name="image-url" class="form-control image-link" placeholder="Image URL" value="`+featured_image+`">
          </div>
          <div class="col-2 mb-2">
            <img id="item-main-img" src="`+featured_image+`" class="image-live" style="max-height:70px; max-width:100%; vertical-align:center">
          </div>
          <div class="col-10 mb-2">
            <label for="threeD-asset">3D-Asset URL</label>
            `;
            var threeD_asset = "";
            if (init_data != "add"){
              threeD_asset = init_data.item_information.threeD_asset != null ? init_data.item_information.threeD_asset : "";
            }
            html_output +=`
            <input type="text" id="threeD-asset" name="threeD-asset" class="form-control" placeholder="3D asset URL" value="`+threeD_asset+`">
          </div>
          <div class="col-2 mb-2">
            <img id="item-main-img">
          </div>
          <div class="col-4 mb-2">
            <label for="dp-price">DP Price</label>
            `;
            var dp_price = "";
            if (init_data != "add"){
              dp_price = init_data.item_information.dp_price != null ? init_data.item_information.dp_price : "";
            }
            html_output +=`
            <input type="text" id="dp-price" name="dp-price" class="form-control" placeholder="DP price" value="`+dp_price+`">
          </div>
          <div class="col-4 mb-2">
            <label for="realm">Realm</label>
            `;
            if (init_data != "add"){
              var realm = (init_data.item_information.realm != null && init_data.realm_information != null) ? init_data.item_information.realm : "";
              html_output +=`
              <select id="realm" name="realm" class="form-control">`;
              for (var i = 0; i < init_data.realm_information.length; i++){
                if(init_data.item_information.realm == init_data.realm_information[i].id){
                  html_output += `<option value='`+init_data.realm_information[i].id+`' selected>`+init_data.realm_information[i].name+`</option>`;
                }
                else{
                  html_output += `<option value='`+init_data.realm_information[i].id+`'>`+init_data.realm_information[i].name+`</option>`;
                }
              }
              html_output +=`
              </select>`;
            }
            else{
              html_output +=`<p>`+$("#item_info").attr("realm").trim()+`</p>`;;
            }
            html_output +=`
          </div>
          <div class="col-4 mb-2">
            <label for="group">Group</label>
            `;
            if (init_data != "add"){
              var group = (init_data.item_information.group != null && init_data.group_information != null) ? init_data.item_information.group : "";
              html_output +=`
              <select id="group" name="group" class="form-control">`;
              for (var i = 0; i < init_data.group_information.length; i++){
                if(init_data.item_information.group == init_data.group_information[i].id){
                  html_output += `<option value='`+init_data.group_information[i].id+`' selected>`+init_data.group_information[i].name+`</option>`;
                }
                else{
                  html_output += `<option value='`+init_data.group_information[i].id+`'>`+init_data.group_information[i].name+`</option>`;
                }
              }
              html_output +=`
              </select>`;
            }
            else{
              html_output +=`<p>`+$("#item_info").attr("group").trim()+`</p>`;
            }
          html_output +=`
          </div>
          <div class="col-12 mb-2">
            <label for="item-details">Item Details</label>
            `;
            var item_description = "";
            if (init_data != "add"){
              item_description = init_data.item_information.description != null ? init_data.item_information.description : "";
            }
            html_output +=`
            <textarea id="item-detail" name="item-detail" class="form-control" placeholder="Item long description">`+item_description+`</textarea>
          </div>
          <div class="col-12 mb-2 text-center">
            <h3>Additional Description</h3>
          </div>
          <div class="col-12 mb-2">
            <div id="additional" class="row m-0" style="background:#333">
              `;
              var count = 1;
              if (init_data != "add"){
                var item_additional_images = init_data.item_information.additional_images != null ? init_data.item_information.additional_images : "";
                var item_additional_texts = init_data.item_information.additional_text != null ? init_data.item_information.additional_text : "";
                var additional_array = [item_additional_images.length, item_additional_texts.length];
                count = Math.max.apply(Math, additional_array);
                count = count < 1 ? 1 : count;
              }
              for (var i = 0; i < count; i++ ){
                html_output +=`
                <div class="col-12 row mx-0 additional-unit" style="border-top: 1px dotted #eca659">
                  <div class="col-12 mb-2">
                  <button type="button" class="btn-asc float-right ad-description-remove">
                    <i class="material-icons">
                      remove_circle_outline
                    </i>
                  </button>
                </div>
                <div class="col-10 mb-2">
                  <label for="image-url">Additional Image URL</label>`;
                  var item_additional_image = "";
                  if (init_data != "add"){
                    item_additional_image = init_data.item_information.additional_images[i] != null ? init_data.item_information.additional_images[i] : "";
                  }
                  html_output +=`
                  <input type="text" class="ad-item-image form-control image-link" placeholder="Additional image URL" value="`+item_additional_image+`">
                </div>
                <div class="col-2 mb-2">
                  <img src="`+item_additional_image+`" class="image-live" style="max-height:70px; max-width:100%">
                </div>
                <div class="col-12 mb-4">
                  <label for="item-details">Additional Description</label>`;
                  var item_additional_description = "";
                  if (init_data != "add"){
                    item_additional_description = init_data.item_information.additional_text[i] != null ? init_data.item_information.additional_text[i] : "";
                  }
                  html_output +=`
                  <textarea class="form-control ad-item-description" placeholder="Additional description">`+item_additional_description+`</textarea>
                </div>`;
                html_output += "</div>";
              }
              html_output +=`
            </div>
            <div class="row mt-2 ad-btn">
              <div class="col-12">
                <button type="button" class="btn-asc float-right" id="ad-description-add">
                  <i class="material-icons">
                    add_circle
                  </i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </form>`;
      $("#item-editor-body").html(html_output);
      $('#item-editor').modal('show');
    }

    $("#preview").on("click", function(){
      let action = "https://"+window.location.hostname+"/store/item-preview";
      let target = "_blank";
      submitData(action, target);
    });

    $("#item-update").on("click", function(){
      let type = $(this).attr("add-new");
      var action = "";
      if(type != "true"){
        action = "https://"+window.location.hostname+"/store/item-update";
      }
      else{
        action = "https://"+window.location.hostname+"/store/item-add";
      }
      submitData(action, "");
    });

    function submitData(action, target){
      $("#item-cu").attr("action", action);
      $("#item-cu").attr("target", target);
      var _token = $('meta[name="_token"]').attr('content');
      $("#item-token").val(_token);
      var images = [];
      var description = [];
      $("#item-editor-body #additional").children().each(function(){
        if ($(this).find(".ad-item-description").val() != "")
          description.push('"'+$(this).find(".ad-item-description").val().trim()+'"');
        if ($(this).find(".ad-item-image").val() != "")
          images.push('"'+$(this).find(".ad-item-image").val().trim()+'"');
      });
      images = images.length != 0 ? images : [];
      description = description.length != 0 ? description : [];
      var realm = $("#item-cu").attr("type") == "add" ? $("#item_info").attr("realm").trim() : $("#realm option:selected").text().trim();
      var realm_id = $("#item-cu").attr("type") == "add" ? $("#item_info").attr("realm-id").trim() : $("#realm option:selected").val().trim();
      var group = $("#item-cu").attr("type") == "add" ? $("#item_info").attr("group").trim() : $("#group option:selected").text().trim();
      var group_id = $("#item-cu").attr("type") == "add" ? $("#item_info").attr("group_id").trim() : $("#group option:selected").val().trim();
      var u_id = $("#item-cu").attr("type") == "add" ? "" : $("#item-u-id").val().trim();
      var formData = new FormData();
      formData.append('u_id', u_id);
      formData.append('item-id', $("#item-id").val().trim());
      formData.append('threeD-asset', $("#threeD-asset").val().trim());
      formData.append('item-name', $("#item-name").val().trim());
      formData.append('dp-price', $("#dp-price").val().trim());
      formData.append('realm', realm);
      formData.append('realm_id', realm_id);
      formData.append('item-detail', $("#item-detail").val().trim());
      formData.append('group', group);
      formData.append('group_id', group_id);
      formData.append('image-url', $("#image-url").val().trim());
      formData.append('additional_images', '['+images+']');
      formData.append('additional_text', '['+description+']');
      formData.append('_token', _token);
      if(target == "_blank"){
        $("#additional_images").val('['+images+']');
        $("#additional_text").val('['+description+']');
        $("#item-cu").submit();
      }
      else{
        $.ajax({
          url: action,
          method: "POST",
          dataType: "JSON",
          data: formData,
          processData: false,
          contentType: false,
          success: function(res) {
            inputChecker(res);
          },
          error: function(err) {
            Swal.fire({
              title: "Error!",
              type: "error",
              text: "There was an error, Please try later."
            })
          }
        });
      }
    }

    $("#item-editor-body").on("input","input, textarea", function(){
      let error_check = $(this).next().length;
      if(error_check != 0){
        $(this).removeClass("is-invalid").next().remove();
      }
    });

    function inputChecker(data){
      if(data == "Successfully Saved"){
        Swal.fire({
          title: "Success!",
          type: "success",
          text: data,
        })
        .then(()=>{
          window.location.replace(window.location.href);
        });
      }
      else{
        for (var key in data) {
          let error_msg = "<div class='asc-error-tooltip'>"+data[key][0]+"</div>";
          let num = $("#"+key).next().length;
          if (num < 1){
            $("#"+key).addClass("is-invalid").after(error_msg);
          }
          else{
            $("#"+key).addClass("is-invalid").next().replaceWith(error_msg);
          }
        }
      }
    }

    $("#item-editor-body").on("click", "#additional .ad-description-remove", function(){
      $(this).parents("div .additional-unit").remove();
    });
    $("#item-editor-body").on("click", "#ad-description-add", function(){
      var html_output = `
        <div class="col-12 row mx-0 additional-unit" style="border-top: 1px dotted #eca659">
          <div class="col-12 mb-2">
            <button type="button" class="btn-asc float-right ad-description-remove">
              <i class="material-icons">
                remove_circle_outline
              </i>
            </button>
          </div>
          <div class="col-10 mb-2">
            <label for="image-url">Additional Image URL</label>
            <input type="text" class="ad-item-image form-control" placeholder="Additional image URL" value="">
          </div>
          <div class="col-2 mb-2">
            <img src="" style="max-height:70px; max-width:100%">
          </div>
          <div class="col-12 mb-4">
            <label for="item-details">Additional Description</label>
            <textarea class="form-control ad-item-description" pleaceholder="Additional description"></textarea>
          </div>
        </div>
        `;
      $(this).parents("div .ad-btn").prev().append(html_output);
    });

    $("#item-editor-body").on("input",".image-link", function(){
      var src = $(this);
      var src_val = src.val().trim();
      var alter = "https://"+window.location.hostname+"/media/image/shop/invalid-image.png";
      $.get(src_val)
        .done(function() {
          src.parent().next().find('.image-live').fadeOut( function() {
            src.parent().next().find('.image-live').attr('src', src_val).fadeIn();
          });
        }).fail(function() {
          src.parent().next().find('.image-live').fadeOut( function() {
            src.parent().next().find('.image-live').attr('src', alter).fadeIn();
          });
        });
    });

});
