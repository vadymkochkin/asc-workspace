$("#item-1").click(function(event) {
  // Remember the link href
  var href = this.href;

  // Don't follow the link
  event.preventDefault();

  $("#item-3").addClass("fadeOut animated faster");
  $("#item-2").addClass("fadeOut animated faster");
  $("#item-2").one(
    "animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd",
    function() {
      $(".sub-items").addClass("fadeOutDown animated faster");
      $(".support-header").addClass("fadeOutUp animated faster");
      $(".support-header").one(
        "animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd",
        function() {
          //Run the function
          $("#preload")
            .delay(0)
            .fadeIn("slow"); // Fade in the preloader
          $("body")
            .delay(500)
            .css("overflow", "hidden !important"); //Hide the overflow (broken at the moment)

          //After the timeout, follow the link.
          setTimeout(function() {
            window.location = href;
          }, 1000);
        }
      );
    }
  );
});

$("#item-2").click(function(event) {
  // Remember the link href
  var href = this.href;

  // Don't follow the link
  event.preventDefault();

  $("#item-3").addClass("fadeOut animated faster");
  $("#item-1").addClass("fadeOut animated faster");
  $("#item-1").one(
    "animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd",
    function() {
      $(".sub-items").addClass("fadeOutDown animated faster");
      $(".support-header").addClass("fadeOutUp animated faster");
      $(".support-header").one(
        "animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd",
        function() {
          //Run the function
          $("#preload")
            .delay(0)
            .fadeIn("slow"); // Fade in the preloader
          $("body")
            .delay(500)
            .css("overflow", "hidden !important"); //Hide the overflow (broken at the moment)

          //After the timeout, follow the link.
          setTimeout(function() {
            window.location = href;
          }, 1000);
        }
      );
    }
  );
});

$("#item-3").click(function(event) {
  // Remember the link href
  var href = this.href;

  // Don't follow the link
  event.preventDefault();

  $("#item-2").addClass("fadeOut animated faster");
  $("#item-1").addClass("fadeOut animated faster");
  $("#item-1").one(
    "animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd",
    function() {
      $(".sub-items").addClass("fadeOutDown animated faster");
      $(".support-header").addClass("fadeOutUp animated faster");
      $(".support-header").one(
        "animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd",
        function() {
          //Run the function
          $("#preload")
            .delay(0)
            .fadeIn("slow"); // Fade in the preloader
          $("body")
            .delay(500)
            .css("overflow", "hidden !important"); //Hide the overflow (broken at the moment)

          //After the timeout, follow the link.
          setTimeout(function() {
            window.location = href;
          }, 1000);
        }
      );
    }
  );
});
