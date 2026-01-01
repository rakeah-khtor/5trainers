document.addEventListener("DOMContentLoaded", function () {
  const prev = document.querySelector(".previousx");
  const next = document.querySelector(".nextx");
  const slides = Array.from(document.querySelectorAll(".slidex"));

  if (!slides.length) return;

  let mode = "auto";

  function getActiveIndex() {
    const current = document.querySelector(".slidex.activx");
    return current ? slides.indexOf(current) : 0;
  }

  function setActive(index) {
    slides.forEach((s) => s.classList.remove("activx"));
    slides[index].classList.add("activx");
  }

  function showNextImage() {
    let idx = getActiveIndex();
    idx = (idx + 1) % slides.length;
    setActive(idx);
  }

  function showPreviousImage() {
    let idx = getActiveIndex();
    idx = (idx - 1 + slides.length) % slides.length;
    setActive(idx);
  }

  if (prev) {
    prev.addEventListener("click", function (e) {
      e.preventDefault();
      mode = "manual";
      showPreviousImage();
    });
  }

  if (next) {
    next.addEventListener("click", function (e) {
      e.preventDefault();
      mode = "manual";
      showNextImage();
    });
  }

  setInterval(function () {
    if (mode === "auto") {
      showNextImage();
    }
  }, 5000);
});
