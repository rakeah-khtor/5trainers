<form action="form.php" method="POST">
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" required="" placeholder="Name" class="form-control" minlength="4">
            </div>
        </div>

        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label>Email ID *</label>
                <input type="email" name="email" required="" placeholder="Email" class="form-control">
            </div>
        </div>

        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label>Mobile Number</label>
                <input type="tel" name="phone_number" required="" placeholder="Phone" class="form-control">
            </div>
        </div>

        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label>Select Course</label>
                <select name="course" class="form-control" required="">
                    <option value="">Select Course</option>
                    <option value="Digital Marketing">Digital Marketing</option>
                    <option value="Google Ads">Google Ads</option>
                    <option value="SEO">SEO</option>
                    <option value="SMM">SMM</option>
                </select>
            </div>
        </div>

        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label>Select Batch</label>
                <select name="batch" class="form-control" required="">
                    <option value="">Select Batch</option>
                    <option value="MorningBatch">Morning Batch</option>
                    <option value="EveningBatch">Evening Batch</option>
                </select>
            </div>
        </div>

        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label>Qualification</label>
                <input type="text" name="qualification" required="" placeholder="Qualification" class="form-control">
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <input type="submit" class="submitbtn btn btn-primary" value="Send Message">
        </div>
        <p class="secure">100% Secure and Confidential</p>
    </div>
</form>
