<!-- Popup Modal -->
<div class="modal-overlay" id="popupForm">
  <div class="modal-content">
    <button class="close-btn" id="closePopup">&times;</button>
    <h3>Register Now</h3>
    <p class="mainp">Schedule a Free Consultation to Discover the Best Learning Path for Your Career.</p>

    <form id="registrationForm" action="form.php" method="POST" novalidate>
      <div class="row g-3">

        <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" placeholder="Name" class="form-control" required minlength="4">
            <small class="error-message">Please enter a valid name (at least 4 letters).</small>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="email">Email ID *</label>
            <input type="email" id="email" name="email" placeholder="Email" class="form-control" required>
            <small class="error-message">Enter a valid email (example@domain.com).</small>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="phone_number">Mobile Number</label>
            <input type="tel" id="phone_number" name="phone_number" placeholder="Phone" class="form-control" required>
            <small class="error-message">Enter a valid 10-digit phone number.</small>
          </div>
        </div>

        <!-- Updated Course Dropdown -->
        <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="course">Select Course</label>
            <select id="course" name="course" class="form-control" required>
              <option value="">Select Course</option>
              <option value="Digital Marketing">Digital Marketing</option>
              <option value="Google Ads">Google Ads</option>
              <option value="Meta Ads">Meta Ads</option>
              <option value="AI">Artificial Intelligence</option>
              <option value="DS">Data Science</option>
              <option value="DA">Data Analytics</option>
              <option value="FS">Full Stack</option>
            </select>
            <small class="error-message">Please select a course.</small>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="batch">Select Batch</label>
            <select id="batch" name="batch" class="form-control" required>
              <option value="">Select Batch</option>
              <option value="MorningBatch">Morning Batch</option>
              <option value="EveningBatch">Evening Batch</option>
            </select>
            <small class="error-message">Please select a batch.</small>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="qualification">Qualification</label>
            <input type="text" id="qualification" name="qualification" placeholder="Qualification" class="form-control"
              required>
            <small class="error-message">Enter a valid qualification (min 2 characters).</small>
          </div>
        </div>

        <div class="col-12">
          <input type="submit" class="submitbtn btn btn-primary" value="Send Message">
        </div>
      </div>
    </form>
  </div>
</div>
