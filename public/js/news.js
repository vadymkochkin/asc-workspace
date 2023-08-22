  var isFullscreen = false;

  function fullscreen(){
    var target = $(this);

    target.addClass('news-target');

      $( ".news-pos-target").each(function() {
        if(!($(this).hasClass('news-target'))){
            $(this).addClass('animated fadeOut');
            console.log($(this));
        }
    });


      $('#twitter-container').addClass('animated fadeOutRight');
      $('#twitter-container-2').addClass('animated fadeOutRight');
      
      fun(target);


      $('.news-item').one("animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function () {
        $('body').css("overflow-y", "hidden");
        $('.news-item').addClass('none');
        $('.news-side').addClass('none');
        $('#twitter-container').addClass('none');
        $('#twitter-container-2').addClass('none');

        $( ".news-pos-target").each(function() {
            if(!($(this).hasClass('news-target'))){
                $(this).addClass('none');
            }
        });

        target.addClass('animated zoomOut');
        target.one("animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function () {
            window.location.href = "../docs/news-article.html";
        });
    });
  }

  function fun(evt) {
    var element = evt.closest('body');
    console.log(element);
    console.log(element.length);

    if(element.get(0)){
        console.log('found');
     }
     else{
      console.log('not found');
     }
}

  