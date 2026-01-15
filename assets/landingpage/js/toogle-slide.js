$(document).ready(function () {
  $(".open-call").on("click", function (e) {
    e.preventDefault();
    $("#wrap").animate({ width: "toggle" }, 700);
    $(".open-call").toggleClass("opened closed");
  });
  $(".close-call").click(function () {
    $("#wrap").hide({ width: "toggle" }, 700);
  });
});
