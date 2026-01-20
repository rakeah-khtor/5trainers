<style>
    .popup-overlay.registerpopup {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .registerpopup .popup-content {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        width: auto;
        position: relative;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.8);
    }

    .registerpopup .close-btn {
        position: absolute;
        right: 8px;
        top: 0px;
        font-size: 22px;
        cursor: pointer;
    }

    .registerpopup .form-screen {
        background: #fff;
        min-height: 100%;
        padding: 24px;
        border: 15px solid #15181a;
        width: 570px;
        border-radius: 30px;
        box-shadow: 0 0 12px rgba(255, 234, 180, .5);
    }
</style>

<a href="" id="openPopup">Register Now</a>

<!-- Popup Form -->
<div id="popupForm" class="popup-overlay registerpopup">
    <div class="popup-content">
        <span class="close-btn" id="closePopup">&times;</span>

        <div class="formAlign">
            <div class="form-screen">
                <div class="title">Book a <span class="talert">Course</span> <span class="more">Now</span></div>
                <form action="sendmail.php" method="POST">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>name</label>
                                <input type="text" name="name" required="required" placeholder="Name"
                                     class="form-control" minlength="4">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>email</label>
                                <input type="email" name="email" required="required" placeholder="Email"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>phone number</label>
                                <input type="tel" name="phone_number" required="required" placeholder="Phone Number"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Courses</label>
                                <div class="basic-container">
                                    <div>
                                        <input type="radio" id="option1" name="basic">
                                        <label for="Google Ads"> Google Ads</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="option2" name="basic">
                                        <label for="Digital Marketing"> Digital Marketing</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="option3" name="basic">
                                        <label for="SEO">SEO</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="option4" name="basic">
                                        <label for="Social Media"> Social Media</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="Others" name="basic" checked="">
                                        <label for="Meta Ads">Meta Ads</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <input type="submit" class="submitbtn btn btn-primary" value="Enroll for Course Booking">
                        </div>
                    </div>
                </form>
            </div>
            <!--/form-screen-->
        </div>
    </div>
</div>
<script>
    document.getElementById("openPopup").addEventListener("click", function (e) {
        e.preventDefault();
        document.getElementById("popupForm").style.display = "flex";
    });

    document.getElementById("closePopup").addEventListener("click", function () {
        document.getElementById("popupForm").style.display = "none";
    });

    window.addEventListener("click", function (e) {
        if (e.target === document.getElementById("popupForm")) {
            document.getElementById("popupForm").style.display = "none";
        }
    });
</script>
