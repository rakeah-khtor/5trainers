// Global client-side form validation for main, landing, and visa forms.
// Shows inline error messages under inputs instead of navigating to an error page.

(function () {
  function ensureErrorElement(input, className) {
    let el = input.nextElementSibling;
    if (!el || !el.classList || !el.classList.contains(className)) {
      el = document.createElement("small");
      el.className = className;
      el.style.display = "block";
      el.style.color = "#b42318";
      el.style.fontSize = "12px";
      el.style.marginTop = "4px";
      input.parentNode.insertBefore(el, input.nextSibling);
    }
    return el;
  }

  function setError(input, message, className) {
    const el = ensureErrorElement(input, className);
    if (message) {
      el.textContent = message;
      el.style.display = "block";
      input.classList.add("input-error");
    } else {
      el.textContent = "";
      el.style.display = "none";
      input.classList.remove("input-error");
    }
  }

  function validName(value) {
    const trimmed = String(value || "").trim();
    const noSpaces = trimmed.replace(/\s+/g, "");
    return noSpaces.length >= 4;
  }

  function validEmail(value) {
    const v = String(value || "").trim();
    if (!v) return false;
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v);
  }

  function validPhone(value) {
    const v = String(value || "").trim();
    if (!v) return false;
    return /^[0-9]{10}$/.test(v);
  }

  function attachValidation(form) {
    form.addEventListener("submit", function (e) {
      let ok = true;

      const name = form.querySelector('input[name="name"]');
      const email = form.querySelector('input[name="email"]');
      const phone = form.querySelector('input[name="phone_number"], input[name="phone"]');
      const course = form.querySelector('select[name="course"], input[name="course"]');
      const batch = form.querySelector('select[name="batch"], input[name="batch"]');
      const qualification = form.querySelector('input[name="qualification"]');

      // Name
      if (name) {
        if (!validName(name.value)) {
          setError(name, "Name must be at least 4 characters.", "field-error");
          ok = false;
        } else {
          setError(name, "", "field-error");
        }
      }

      // Email
      if (email) {
        const required = email.hasAttribute("required");
        if (required && !email.value.trim()) {
          setError(email, "Email is required.", "field-error");
          ok = false;
        } else if (email.value && !validEmail(email.value)) {
          setError(email, "Please enter a valid email address.", "field-error");
          ok = false;
        } else {
          setError(email, "", "field-error");
        }
      }

      // Phone
      if (phone) {
        const required = phone.hasAttribute("required");
        if (required && !phone.value.trim()) {
          setError(phone, "Phone number is required.", "field-error");
          ok = false;
        } else if (phone.value && !validPhone(phone.value)) {
          setError(phone, "Phone number must be 10 digits.", "field-error");
          ok = false;
        } else {
          setError(phone, "", "field-error");
        }
      }

      // Course
      if (course && course.hasAttribute("required")) {
        if (!String(course.value || "").trim()) {
          setError(course, "Please select a course.", "field-error");
          ok = false;
        } else {
          setError(course, "", "field-error");
        }
      }

      // Batch
      if (batch && batch.hasAttribute("required")) {
        if (!String(batch.value || "").trim()) {
          setError(batch, "Please select a batch.", "field-error");
          ok = false;
        } else {
          setError(batch, "", "field-error");
        }
      }

      // Qualification
      if (qualification && qualification.hasAttribute("required")) {
        if (!String(qualification.value || "").trim()) {
          setError(qualification, "Please enter your qualification.", "field-error");
          ok = false;
        } else {
          setError(qualification, "", "field-error");
        }
      }

      if (!ok) {
        e.preventDefault();
      }
    });
  }

  document.addEventListener("DOMContentLoaded", function () {
    // Forms posting to shared handlers on main + landing pages
    const selector =
      'form[action$="sendmail.php"], form[action="sendmail.php"], form[action="form.php"], form[action$="/form.php"]';
    const forms = document.querySelectorAll(selector);
    forms.forEach(attachValidation);
  });
})();

