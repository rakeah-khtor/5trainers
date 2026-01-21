<div class="form-screen">
    <div class="title">Book a <span class="talert">Free consultancy</span> <span class="more">to know more</span></div>
    <form action="sendmail.php" method="POST">
        <input type="hidden" name="form_type" value="Callback Request">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label >Name</label>
                    <input type="text" name="name" required placeholder="Jordan Belfort" class="form-control border" minlength="4">
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required placeholder="Example@gmail.com" class="form-control border">
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" name="phone_number" required placeholder="9874563210" class="form-control border"
                        pattern="[0-9]{10}" title="Enter a 10-digit phone number">
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Experience</label>
                    <div class="basic-container">
                        <div><input type="radio" id="option1" name="basic" value="Technical"> Technical</div>
                        <div><input type="radio" id="option2" name="basic" value="Non-technical"> Non-technical</div>
                        <div><input type="radio" id="option3" name="basic" value="Final year student"> Final year
                            student</div>
                        <div><input type="radio" id="option4" name="basic" value="Pre-final year"> Pre-final year</div>
                        <div><input type="radio" id="Others" name="basic" value="Others"> Others</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <input type="submit" class="submitbtn btn btn-primary" value="Enroll For Course Booking">
            </div>
        </div>
    </form>
</div>
</div><!--/form-screen-->
