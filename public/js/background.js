$(document).ready(function() {
  moveRightV2();
});

function moveRight(foo) {
  $("#page-background").animate(
    {
      left: "-=960"
    },
    20000,
    "linear",
    function() {
      console.log("move right complete");
      moveLeft();
    }
  );
}

function moveLeft(foo) {
  $("#page-background").animate(
    {
      left: "+=960"
    },
    20000,
    "linear",
    function() {
      console.log("move left complete");
      moveRight();
    }
  );
}

function moveRightV2(foo) {
  $("#page-background").velocity(
    {
      left: "-=960"
    },
    {
      duration: 40000,
      easing: "linear",
      loop: true
    }
  );
}
