$(document).ready(function(){
  $('#hover-assistant').click(function () {
    let state = $('#user-dropdown').hasClass('d-none');
    if (state){
      $('#user-dropdown').fadeIn(100, function(){
        $('#user-dropdown').removeClass('d-none');
      });
    }
    else{
      $('#user-dropdown').fadeOut(500, function(){
        $('#user-dropdown').addClass('d-none');
      });
    }
  });
});
