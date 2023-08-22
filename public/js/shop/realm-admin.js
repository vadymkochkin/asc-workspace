$(document).ready(function(){
    var _token = $('meta[name="_token"]').attr('content');
    $(".realm-delete").on("click", function(){
        var u_id = $(this).parent().attr("u-id");
        var url = "https://"+window.location.hostname+"/manage_store/realm-delete";
        Swal.fire({
          title: "Are you sure?",
          text: "Once deleted, This realm and it's items will be hidden",
          type: "warning",
          buttons: true
        })
        .then((willDelete) => {
          if (willDelete) {
            requestItemAction(url, u_id, "delete");
          }
        });
    });

    $(".realm-edit").on("click", function(){
        var u_id = $(this).parent().attr("u-id");
        var url = "https://"+window.location.hostname+"/manage_store/realm-info";
        requestItemAction(url, u_id, "edit");
    });

    $(".realm-add").on("click", function(){
        var url = "https://"+window.location.hostname+"/manage_store/realm-add";
        addRealm(url);
    });

    function requestItemAction(url, data, type){
        $("#LoadingImage").show();
        $.ajax({
          url: url,
          type: "POST",
          data: {
            id:data,
            _token
          },
          success:function(response) {
            response = JSON.parse(response);
            $("#LoadingImage").hide();
            if(type == "edit"){
              editRealm(response);
            }
            else{
              if(response == "Successfully Deleted"){
                Swal.fire({
                  title: "Success!",
                  type: "success",
                  text: response,
                  className: "asc-swal"
                })
                .then(()=>{
                  window.location.replace('/store');
                });
              }
              else{
                Swal.fire({
                  title: "Error!",
                  type: "error",
                  text: "There was an error. Try later.",
                  className: "asc-swal"
                })
                .then(()=>{
                  window.location.replace('/store');
                });
              }
            }
          },
          error:function(){
            $("#LoadingImage").hide();
            Swal.fire({
              title: "Error!",
              type: "error",
              text: "There was an error. Try later.",
              className: "asc-swal"
            })
            .then(()=>{
              window.location.replace('/store');
            })
          }
        });
    }

    function editRealm(init_data){
      var html_output = `
      <form id="r-form" method="POST" type="edit">
        <input type="hidden" name="realm_id" value="`+init_data.u_id+`">
        <div class="row">
          <div class="col-12 mb-2 text-center">
            <h5>Realm Details</h5>
          </div>
          <div class="col-12 mb-2">
            <div class="row m-0 pt-2 pb-2" style="background:#1B1B1B">
              <div class="col-12 mb-2 text-center">
                <input type="hidden" name="realm_id" value="`+init_data.u_id+`" />
              </div>
              <div class="col-6 mb-2">
                <label for="realm-name">Realm Name</label>
                `;
                realm_name = init_data.realm_name != null ? init_data.realm_name : "";
                html_output +=`
                <input type="text" name="realm_name" class="form-control" placeholder="Realm name" value="`+realm_name+`">
              </div>
              <div class="col-3 mb-2">
                <label for="realm-name">Host</label>
                `;
                realm_host_name = init_data.realm_host_name != null ? init_data.realm_host_name : "";
                html_output +=`
                <input type="text" name="realm_host_name" class="form-control" placeholder="Realm host" value="`+realm_host_name+`">
              </div>
              <div class="col-3 mb-2">
                <label for="realm-name">Port</label>
                `;
                realm_port = init_data.realm_port != null ? init_data.realm_port : "";
                html_output +=`
                <input type="text" name="realm_host_port" class="form-control" placeholder="Realm port" value="`+realm_port+`">
              </div>
              <div class="col-10 mb-2">
                <label for="image-url">Realm BG Image</label>
                `;
                image = init_data.image != null ? init_data.image : "";
                html_output +=`
                <input type="text" name="image" class="form-control image-link" placeholder="Image URL" value="`+image+`">
              </div>
              <div class="col-2 mb-2">
                <img id="item-main-img" src="`+image+`" style="max-height:54px; max-width:100%; display:block; margin-left:auto; margin-right:auto" class="image-live">
              </div>
            </div>
          </div>
          <div class="col-12 mb-2 text-center">
            <h5>Character Database Details</h5>
          </div>
          <div class="col-12 mb-2">
            <div class="row m-0 pt-2 pb-2" style="background:#1B1B1B">
              <div class="col-6 mb-2">
                <label for="realm-name">Character DB Name</label>
                `;
                char_db_name = init_data.char_db_name != null ? init_data.char_db_name : "";
                html_output +=`
                <input type="text" name="char_db_name" class="form-control" placeholder="Character database name" value="`+char_db_name+`">
              </div>
              <div class="col-3 mb-2">
                <label for="realm-name">DB Host</label>
                `;
                char_db_host_name = init_data.char_db_host_name != null ? init_data.char_db_host_name : "";
                html_output +=`
                <input type="text" name="char_host_name" class="form-control" placeholder="Character database host" value="`+char_db_host_name+`">
              </div>
              <div class="col-3 mb-2">
                <label for="realm-name">DB Port</label>
                `;
                char_db_port = init_data.char_db_port != null ? init_data.char_db_port : "";
                html_output +=`
                <input type="text" name="char_db_port" class="form-control" placeholder="Character database port" value="`+char_db_port+`">
              </div>
              <div class="col-6 mb-2">
                <label for="realm-name">DB Username</label>
                `;
                char_db_username = init_data.char_db_user_name != null ? init_data.char_db_user_name : "";
                html_output +=`
                <input type="text" name="char_db_username" class="form-control" placeholder="Character database username" value="`+char_db_username+`">
              </div>
              <div class="col-6 mb-2">
                <label for="realm-name">DB Password</label>
                `;
                char_db_password = init_data.char_db_password != null ? init_data.char_db_password : "";
                html_output +=`
                <input type="text" name="char_db_password" class="form-control" placeholder="Character database password" value="`+char_db_password+`">
              </div>
            </div>
          </div>
          <div class="col-12 mb-2 text-center">
            <h5>World Console Details</h5>
          </div>
          <div class="col-12 mb-2">
            <div class="row m-0 pt-2 pb-2" style="background:#1B1B1B">
              <div class="col-3 mb-2">
                <label for="realm-name">Console Host</label>
                `;
                world_console_host = init_data.world_console_host != null ? init_data.world_console_host : "";
                html_output +=`
                <input type="text" name="console_host" class="form-control" placeholder="World console host" value="`+world_console_host+`">
              </div>
              <div class="col-3 mb-2">
                <label for="realm-name">Console Port</label>
                `;
                world_console_port = init_data.world_console_port != null ? init_data.world_console_port : "";
                html_output +=`
                <input type="text" name="console_port" class="form-control" placeholder="World console port" value="`+world_console_port+`">
              </div>
              <div class="col-3 mb-2">
                <label for="realm-name">Username</label>
                `;
                world_console_username = init_data.world_console_username != null ? init_data.world_console_username : "";
                html_output +=`
                <input type="text" name="console_username" class="form-control" placeholder="Console username" value="`+world_console_username+`">
              </div>
              <div class="col-3 mb-2">
                <label for="realm-name">Password</label>
                `;
                world_console_password = init_data.world_console_password != null ? init_data.world_console_password : "";
                html_output +=`
                <input type="text" name="console_password" class="form-control" placeholder="Console password" value="`+world_console_password+`">
              </div>
            </div>
          </div>
        </div>
      </form>`;
      $("#realm-editor-body").html(html_output);
      $('#realm-editor').modal('show');
    }

    function addRealm(url){
      var html_output = `
      <form id="r-form" method="POST" action="`+url+`" type="add">
        <div class="row">
          <div class="col-12 mb-2 text-center">
            <h5>Realm Details</h5>
          </div>
          <div class="col-12 mb-2">
            <div class="row m-0 pt-2 pb-2" style="background:#1B1B1B">
              <div class="col-6 mb-2">
                <label for="realm-name">Realm Name</label>
                <input type="text" name="realm_name" class="form-control" placeholder="Realm name" value="">
              </div>
              <div class="col-4 mb-2">
                <label for="realm-host">Host</label>
                <input type="text" name="realm_host_name" class="form-control" placeholder="Realm host" value="">
              </div>
              <div class="col-2 mb-2">
                <label for="realm-name">Port</label>
                <input type="text" name="realm_host_port" class="form-control" placeholder="Realm port" value="">
              </div>
              <div class="col-10 mb-2">
                <label for="image-url">Realm BG Image</label>
                <input type="text" name="image" id="image" class="form-control image-link" placeholder="Image URL" value="">
              </div>
              <div class="col-2 mb-2">
                <img id="item-main-img" src="https://localhost.ascension/media/image/shop/invalid-image.png" style="max-height:54px; max-width:100%; display:block; margin-left:auto; margin-right:auto" class="image-live">
              </div>
            </div>
          </div>
          <div class="col-12 mb-2 text-center">
            <h5>Character Database Details</h5>
          </div>
          <div class="col-12 mb-2">
            <div class="row m-0 pt-2 pb-2" style="background-color:#1B1B1B">
              <div class="col-6 mb-2">
                <label for="realm-name">Character DB Name</label>
                <input type="text" name="char_db_name" class="form-control" placeholder="Character database name" value="">
              </div>
              <div class="col-4 mb-2">
                <label for="realm-name">DB Host</label>
                <input type="text" name="char_host_name" class="form-control" placeholder="Character database host" value="">
              </div>
              <div class="col-2 mb-2">
                <label for="realm-name">DB Port</label>
                <input type="text" name="char_db_port" class="form-control" placeholder="Character database port" value="">
              </div>
              <div class="col-6 mb-2">
                <label for="realm-name">DB Username</label>
                <input type="text" name="char_db_username" class="form-control" placeholder="Character database username" value="">
              </div>
              <div class="col-6 mb-2">
                <label for="realm-name">DB Password</label>
                <input type="text" name="char_db_password" class="form-control" placeholder="Character database password" value="">
              </div>
            </div>
          </div>
          <div class="col-12 mb-2 text-center">
            <h5>World Console Details</h5>
          </div>
          <div class="col-12 mb-2">
            <div class="row m-0 pt-2 pb-2" style="background:#1B1B1B">
              <div class="col-3 mb-2">
                <label for="realm-name">Console Host</label>
                <input type="text" name="console_host" class="form-control" placeholder="World console host" value="">
              </div>
              <div class="col-3 mb-2">
                <label for="realm-name">Console Port</label>
                <input type="text" name="console_port" class="form-control" placeholder="World console port" value="">
              </div>
              <div class="col-3 mb-2">
                <label for="realm-name">Username</label>
                <input type="text" name="console_username" class="form-control" placeholder="Console username" value="">
              </div>
              <div class="col-3 mb-2">
                <label for="realm-name">Password</label>
                <input type="text" name="console_password" class="form-control" placeholder="Console password" value="">
              </div>
            </div>
          </div>
        </div>
      </form>`;
      $("#realm-editor-body").html(html_output);
      $('#realm-editor').modal('show');
    }

    $("#realm-save").on("click", function(){
      var type = $("#r-form").attr('type');
      var url = "https://"+window.location.hostname;
      var formData = new FormData();
      if(type == "edit"){
        url += "/manage_store/realm-edit";
        formData.append('realm_id',$("input[name='realm_id']").val().trim());
      }
      else if(type == "add"){
        url += "/manage_store/realm-add";
      }
      formData.append('realm_name', $("input[name='realm_name']").val().trim());
      formData.append('realm_host_name', $("input[name='realm_host_name']").val().trim());
      formData.append('realm_host_port', $("input[name='realm_host_port']").val().trim());
      formData.append('image', $("input[name='image']").val().trim());
      formData.append('char_db_name', $("input[name='char_db_name']").val().trim());
      formData.append('char_host_name', $("input[name='char_host_name']").val().trim());
      formData.append('char_db_port', $("input[name='char_db_port']").val().trim());
      formData.append('char_db_username', $("input[name='char_db_username']").val().trim());
      formData.append('char_db_password', $("input[name='char_db_password']").val().trim());
      formData.append('console_host', $("input[name='console_host']").val().trim());
      formData.append('console_port', $("input[name='console_port']").val().trim());
      formData.append('console_username', $("input[name='console_username']").val().trim());
      formData.append('console_password', $("input[name='console_password']").val().trim());
      formData.append('_token', _token);
      $.ajax({
          url,
          method: "POST",
          dataType: "JSON",
          data: formData,
          processData: false,
          contentType: false,
          success: function(res) {
            inputChecker(res);
          },
          error: function(err) {

          }
      });
    });

    function inputChecker(data){
      if(data == "Successfully Saved"){
        Swal.fire({
          title: "Success!",
          type: "success",
          text: data,
          className: "asc-swal"
        })
        .then(()=>{
          window.location.replace('/store');
        });
      }
      else{
        for (var key in data) {
          let error_msg = "<div class='asc-error-tooltip'>"+data[key][0]+"</div>";
          let num = $("input[name='"+key+"']").next().length;
          if (num < 1){
            $("input[name='"+key+"']").addClass("is-invalid").after(error_msg);
          }
          else{
            $("input[name='"+key+"']").addClass("is-invalid").next().replaceWith(error_msg);
          }
        }
      }
    }

    $("#realm-editor-body").on("input","input", function(){
      let error_check = $(this).next().length;
      if(error_check != 0){
        $(this).removeClass("is-invalid").next().remove();
      }
    });

    $("#realm-editor-body").on("input",".image-link", function(){
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
