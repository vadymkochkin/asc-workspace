$(window).on("load", function() {
  $("#loader")
    .delay(0)
    .fadeOut(); // will first fade out the loading animation
  $("#preload")
    .delay(500)
    .fadeOut("slow", function() {
      $("body").removeAttr("style");
    });
});

$("header .nav-link").click(function(event) {
  // Remember the link href
  var href = this.href;

  // Don't follow the link
  event.preventDefault();

  //Run the function
  $("#preload")
    .delay(0)
    .fadeIn("slow"); // Fade in the preloader
  $("body")
    .delay(500)
    .css("overflow", "hidden !important"); //Hide the overflow (broken at the moment)
  $("#loader")
    .delay(1000)
    .fadeIn(); //Fade in the loader/spinner

  //After the timeout, follow the link.
  setTimeout(function() {
    window.location = href;
  }, 1000);
});
