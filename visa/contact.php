<?php
$pageTitle = 'Contact | 5Trainers Visa Consultancy';
$pageDescription = '5Trainers Visa Consultancy – IELTS, Immigration, PTE and Visa Centre in Mohali, Punjab (India).';
$currentPage = 'contact';
include 'header.php';
?>

<div class="contact-us">
    <div class="container">
        <div class="hero-layout">
            <div class="hero-text">
                <div class="title-section" data-animate>
                    <h1 class="main-title">Contact & Counselling</h1>
                    <p class="hero-subtitle">
                        Share your study or immigration goal and we will guide you with the most suitable route.
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
</header>

<section class="content-section alt">
    <div class="container">
        <h2 class="content-heading" data-animate>Get in Touch</h2>
        <div class="contact-grid contact-flex">
            <div data-animate data-animate-delay="1" class="contact-img">
                <img src="assets/img/contact-number.jpeg" alt="contact-number" class="contact-number">
            </div>
            <div data-animate data-animate-delay="2">
                <div class="contact-card">
                    <h3>Request a Callback</h3>
                    <form action="form.php" method="POST">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" placeholder="Your full name" minlength="4">

                        <label for="phone">Mobile Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="+91">

                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="you@example.com">

                        <label for="service">Interested In</label>
                        <input type="text" id="service" name="service" placeholder="IELTS / PTE / Study Visa">

                        <label for="message">Message</label>
                        <textarea id="message" name="message"
                            placeholder="Tell us briefly about your plans..."></textarea>

                        <button type="submit" class="auth-btn create-account-btn">
                            <i class="fas fa-paper-plane"></i>
                            Submit Request
                        </button>
                    </form>
                    <p class="footer-small" style="margin-top:8px;">
                        We respect your privacy and only contact you with genuine updates.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>




<?php include 'footer.php'; ?>
