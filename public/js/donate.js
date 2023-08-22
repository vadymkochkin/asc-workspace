var donationItems = [
  "dp-item-0",
  "dp-item-1",
  "dp-item-2",
  "dp-item-3",
  "dp-item-4",
  "dp-item-5",
  "dp-item-6",
  "dp-item-7",
  "dp-item-8"
];

$(".item-anchor").click(function(event) {
  var main = $(this);
  console.log(this.id);
  donationItems.forEach(element => {
    if (element != this.id) {
      var foo = ["#", element].join("");
      var domObj = document.getElementById(element);
      $(foo).addClass("animated fadeOut fast");

      $(".item-anchor").one(
        "animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd",
        function() {
          $(main).addClass("animated fadeOut fast");
          $(".donate-title").fadeOut(500);
          setTimeout(function() {
            $(".donate-title").text("Choose a payment method");
            $(".donate-title").fadeIn(500);
          }, 1000);
         

        }
      );
    }
  });
});
