//navbar animation
var lastTop = 0;

$(window).scroll(function(event){
   var currentTop = $(this).scrollTop();
   if (currentTop > lastTop){
      if($('.asc-navbar-upper').css('display') == 'flex'){
        $('.asc-navbar-upper').attr('style','display:none !important');
      }
   } else {
      if(($('.asc-navbar-upper').css('display') == 'none') && (currentTop == 0)){
        $('.asc-navbar-upper').fadeIn('slow').attr('style','display:flex !important');
      }
   }
   lastTop = currentTop;
});
