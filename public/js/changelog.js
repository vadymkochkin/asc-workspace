$(document).ready(function () {
  var _token = $('meta[name="_token"]').attr('content');
  $("#load-button").on("click", function(){
    var interval = $(this).attr('interval');
    $("#LoadingImage").show();
    $.ajax({
      url: "https://"+window.location.hostname+"/changelog/load-more",
      type: "POST",
      data: {
        interval,
        _token
      },
      success:function(changelog) {
        $("#LoadingImage").hide();
        let raw = JSON.parse(changelog);
        var data = raw.changelog_items;
        var next_interval = raw.next_interval;
        if(data.length != 0){
          var html_output="";
          $.each(data, function (key_first_l, data_first_l) {
              html_output += `<li class="timeline-item rounded ml-3 p-4 shadow">
                  <h1 class="h5">Change(s) made on `+key_first_l+`</h1>
                  <div class="timeline-arrow"></div>`;
              $.each(data_first_l, function (key_second_l, data_second_l) {
                  html_output += `<h2 class="h5 mt-4">`+key_second_l+`</h2>`;
                  $(data_second_l).each(function(){
                    html_output += `<div class="changelog-des">
                      <i class="fa fa-clock-o mr-1"></i>
                      <span class="small">`+this.time+`</span>
                      <p class="text-small mt-2 font-weight-light">`+this.changelog+`</p>
                    </div>`;
                  });
              });
              html_output += "</li>";
          });
          $(".timeline li:last-child").after(html_output);
          if(next_interval == 0 ){
            $("#load-button").parents('.load-container').remove();
          }
          else{
            $("#load-button").attr('interval', next_interval);
          }
        }
        else{
          $("#load-button").parents('.load-container').remove();
        }
      }
    });
  });
});
