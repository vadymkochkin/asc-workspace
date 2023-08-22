$(document).ready(function(){
  let images = document.querySelectorAll("img[src='https://"+window.location.hostname+"/media/image/shop/lazy-load.svg']");
  lazyload(images);
  var item_removed = [];
  var _token = $('meta[name="_token"]').attr('content');
  $(".manage-featured").click(function(){
    manageOrder("fire");
  });

  function manageOrder(url){
    $("#LoadingImage").show();
    $.ajax({
      url: "https://" + window.location.hostname + "/manage_store/edit-feature",
      type: "POST",
      CrossDomain: true,
      data: {
        realm: $("#shop-type").attr('realm-id'),
        _token,
      },
      success: function (response) {
        var data = JSON.parse(response);
        $("#LoadingImage").hide();
        if (data != "Error" && data.length > 0){
          var html_output = `
            <div class="row" id="sortable-items">`;
            data.forEach(function(item){
              html_output +=`
              <div class="sort-item col-xl-3 col-md-4 col-sm-6 col-12">
                  <div class="item-container">
                      <button class="btn-asc remove-featured" item-id="`+item.id+`">X</button>
                      <img class="img" src="https://`+window.location.hostname+`/media/image/shop/lazy-load.svg" data-src="`+item.image+`">
                      <div class="item-footer">
                          <div class="item-title text-center">
                              <h5>`+item.name+`</h5>
                          </div>
                          <div class="item-price text-center">
                              <img class="price-icon" src="/media/icon/dp.svg">
                              <span class="price">`+item.dp+`</span>
                          </div>
                      </div>
                  </div>
              </div>`;
            });
            html_output += `</div>`;
          $("#manage-order-body").html(html_output);
          $("#manage-order").modal("show");
          let images = document.querySelectorAll("img[src='https://"+window.location.hostname+"/media/image/shop/lazy-load.svg']");
          lazyload(images);
          $( "#sortable-items" ).sortable();
          $( "#sortable-items" ).disableSelection();
        }
        else if (data != "Error" && data.length == 0){
          Swal.fire({
            title: "error",
            text: "Add some items to Featured page first",
            type: "error"
          });
        }
        else{
          Swal.fire({
            title: "Error",
            text: "There was an error",
            type: "error"
          });
        }
      },
      error: function(){
        $("#LoadingImage").hide();
        Swal.fire({
          title: "Error",
          text: "There was an error, Try later",
          type: "error"
        });
      }
    });
  }

  $("#manage-order-body").on("click", ".remove-featured", function(){
    Swal.fire({
      title: "Are you sure?",
      text: "This item will be removed from Featured page",
      type: "warning",
      buttons: true
    })
    .then((willRemove) => {
      item_removed.push($(this).attr("item-id"));
      $(this).parents("div .sort-item").remove();
    });
  });

  $("#update-order").click(function(){
    Swal.fire({
      title: "Are you sure?",
      text: "Featured page will be updated",
      type: "warning",
      buttons: true
    })
    .then((willAdd) => {
      var item_ordered = [];
      $("#sortable-items").children().each(function(){
        item_ordered.push($(this).find(".remove-featured").attr("item-id"));
      });
      item_ordered = JSON.stringify(item_ordered);
      item_removed = JSON.stringify(item_removed);
      $("#LoadingImage").show();
      $.ajax({
        url: "https://" + window.location.hostname + "/manage_store/feature-save",
        type: "POST",
        CrossDomain: true,
        data: {
          realm : $("#shop-type").attr('realm-id'),
          item_removed,
          item_ordered,
          _token,
        },
        success: function (response) {
          $("#LoadingImage").hide();
          Swal.fire({
            title: "Success",
            text: response,
            type: "success"
          })
          .then((saved) => {
            window.location.replace(window.location.href);
          });
        },
        error : function(){
          $("#LoadingImage").hide();
          Swal.fire({
            title: "Error",
            text: "There was an error, Try later",
            type: "error"
          });
        }
      });
    });
  });
});
