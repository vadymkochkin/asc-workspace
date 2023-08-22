$(document).ready(function(){

    //Declare Variables
    var heroMain = $('.hero-text h1');
    var heroSub = $('.hero-text h4');
    var headerPrivacy = $('.header .float-right');
    var headerService = $('.header .float-left');
    var footerRead = $('.footer');
    var navBtn = $('#menu-btn');
    var playBtn = $('#play-btn');
    var exitBtn = $('#exit-menu');
    var menuTarget = $('#asc-navigation');

    //Prepare for animation by hiding.
    /*heroMain.hide();
    heroSub.hide();
    headerPrivacy.hide();
    headerService.hide();
    footerRead.hide();*/

    //Play Animations
    heroMain.addClass('animated fadeInDown slow');
    heroSub.addClass('animated fadeInUp slower');
    footerRead.addClass('animated fadeInUp');
    playBtn.addClass('animated fadeInRight');
    heroMain.one("animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function () {
      headerPrivacy.addClass('animated fadeInRight');
      headerService.addClass('animated fadeInLeft');
      headerService.one("animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function () {
        navBtn.addClass('animated fadeInUp');
      });
    });

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
