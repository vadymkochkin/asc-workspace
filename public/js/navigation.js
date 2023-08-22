$(document).ready(function(){
    var navBtn = $('#menu-btn');
    var exitBtn = $('#exit-menu');
    var menuTarget = $('#asc-navigation');

    navBtn.on('click', function(){
        navBtn.hide();
        menuTarget.removeClass('animated fadeOutDown fullscreen-modal');
        menuTarget.addClass('animated slideInUp fullscreen-modal').css("display","block");
      });
  
    exitBtn.on('click',function(){
        menuTarget.removeClass('animated slideInUp fullscreen-modal');
        menuTarget.addClass('animated fadeOutDown fullscreen-modal');
        setTimeout( function(){
          menuTarget.css("display","none");
        },1000);
        navBtn.show();
      });
});

function closeModal(){
    var modal = $('.modal');
    modal.addClass('slideOutDown');
    modal.one("animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function () {
        $('.modal').toggle();
        $('.modal-backdrop').click();
        console.log("animated");
        modal.removeClass('slideOutDown')
    });
};

