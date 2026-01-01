document.addEventListener("DOMContentLoaded", function () {
  const boxes = document.querySelectorAll(".box");
  if (!boxes.length) return;

  function removeClass() {
    boxes.forEach((el) => el.classList.remove("active"));
  }

  boxes.forEach((el) => {
    el.addEventListener("click", () => {
      removeClass();
      el.classList.toggle("active");
    });
  });
});

