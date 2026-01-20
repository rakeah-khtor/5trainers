<section class="content-section alt">
    <div class="container">
        <div class="contact-flex">

            <div data-animate>
                <div class="contact-card">
                    <h3>Request a Callback</h3>

                    <form action="form.php" method="POST">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" placeholder="Your full name" minlength="4">

                        <label for="phone">Mobile Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="+91">

                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="you@example.com">

                        <label for="country">Country</label>
                        <select id="country" name="country" class="from-country" value="Select Country">
                            <option value="" selected disabled>Select Country</option>
                            <option value="Australia">Australia</option>
                            <option value="Canada">Canada</option>
                            <option value="New Zealand">New Zealand</option>
                            <option value="Russia">Russia</option>
                            <option value="Singapore">Singapore</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States">United States</option>
                        </select>

                        <label for="message">Message</label>
                        <textarea id="message" name="message"
                            placeholder="Tell us briefly about your plans..."></textarea>

                        <button type="submit" class="auth-btn create-account-btn">
                            <i class="fas fa-paper-plane"></i>
                            Submit Request
                        </button>
                    </form>
                    <script src="../assets/js/global-validation.js"></script>

                    <p class="footer-small" style="margin-top:8px;">
                        We respect your privacy and only contact you with genuine updates.
                    </p>

                </div>
            </div>
        </div>
    </div>
</section>
