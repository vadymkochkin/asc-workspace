$(document).ready(function(){
    $('.container').one("animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function () {
        $('.news-header').addClass('animated fadeInUp');
        $('.news-title').addClass('animated fadeInRight');
        $('.news-content').addClass('animated fadeInDown');
        $('.news-footer').addClass('animated fadeInRight');
  });
});

$("a[href='#top']").click(function() {
    $("html, body").animate({ scrollTop: 0 }, "slow");
    return false;
});

$("a[href='#back']").click(function() {
    parent.history.back();
    return false;
});

