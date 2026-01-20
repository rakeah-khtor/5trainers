const popup = document.getElementById("popupForm");
const openBtn = document.querySelector(".getst");
const closeBtn = document.getElementById("closePopup");
const form = document.getElementById("registrationForm");

// Open popup
openBtn.addEventListener("click", (e) => {
  e.preventDefault(); // stop link refresh
  popup.style.display = "flex";
});

// Close popup
closeBtn.addEventListener("click", () => {
  popup.style.display = "none";
});

window.addEventListener("click", (e) => {
  if (e.target === popup) {
    popup.style.display = "none";
  }
});

// Form Validation
form.addEventListener("submit", function (e) {
  let valid = true;

  // Full name validation
  const name = document.getElementById("name");
  const nameError = name.nextElementSibling;
  if (!/^[a-zA-Z ]{4,}$/.test(name.value.trim())) {
    nameError.style.display = "block";
    valid = false;
  } else {
    nameError.style.display = "none";
  }

  // Email validation
  const email = document.getElementById("email");
  const emailError = email.nextElementSibling;
  const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
  if (!emailPattern.test(email.value.trim())) {
    emailError.style.display = "block";
    valid = false;
  } else {
    emailError.style.display = "none";
  }

  // Phone validation
  const phone = document.getElementById("phone_number");
  const phoneError = phone.nextElementSibling;
  if (!/^[0-9]{10}$/.test(phone.value.trim())) {
    phoneError.style.display = "block";
    valid = false;
  } else {
    phoneError.style.display = "none";
  }

  // Course validation
  const course = document.getElementById("course");
  const courseError = course.nextElementSibling;
  if (course.value === "") {
    courseError.style.display = "block";
    valid = false;
  } else {
    courseError.style.display = "none";
  }

  // Batch validation
  const batch = document.getElementById("batch");
  const batchError = batch.nextElementSibling;
  if (batch.value === "") {
    batchError.style.display = "block";
    valid = false;
  } else {
    batchError.style.display = "none";
  }

  // Qualification validation
  const qualification = document.getElementById("qualification");
  const qualificationError = qualification.nextElementSibling;
  if (qualification.value.trim().length < 2) {
    qualificationError.style.display = "block";
    valid = false;
  } else {
    qualificationError.style.display = "none";
  }

  if (!valid) {
    e.preventDefault(); // Stop form submit
  }
});
