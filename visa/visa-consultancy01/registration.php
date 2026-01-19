<?php
$pageTitle = 'Registration | 5Trainers Visa Consultancy';
$pageDescription = 'Register with 5Trainers Visa Consultancy for IELTS, PTE, study visa and immigration counselling.';
$currentPage = 'registration';
include 'header.php';
?>

<div class="registration-content">
    <div class="container">
    <div class="registration-layout">
        <div class="hero-text">
            <div class="title-section" data-animate>
                <h1 class="main-title"> Student Registration</h1>
                <p class="hero-subtitle">
                    Share your basic details and we will connect with you for personalised counselling.
                </p>
            </div>
        </div>
        <!-- <div class="hero-visual" data-animate>
            <div class="hero-visual-card">
                <img src="assets/img/hero-students1.jpg" alt="Student registration for visa consultancy">
                <div class="hero-tag-floating">
                    <i class="fas fa-user-plus"></i>
                    <span>New registrations</span>
                </div>
                <div class="hero-stat">
                    <span>Application review</span>
                    <strong>Within 24–48 hrs</strong>
                </div>
            </div>
        </div> -->
    </div>
    </div>
</div>

<section class="content-section alt">
    <div class="container Registration-Form" >
    <!--<div class="container Registration-Form" style="display:flex; gap :30px">-->
        <div class="contact-card" data-animate>
            <h3>Registration Form</h3>
            <form action="form.php" method="POST">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Your full name">

                <label for="phone">Mobile Number</label>
                <input type="tel" id="phone" name="phone" placeholder="+91">

                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="you@example.com">

                <label for="city">City</label>
                <input type="text" id="city" name="city" placeholder="Your current city">

                <label for="interest">Interested In</label>
                <input type="text" id="interest" name="interest" placeholder="IELTS / PTE / Study Visa / PR / Work Permit">

                <label for="country">Preferred Country</label>
                <input type="text" id="country" name="country" placeholder="Canada, Australia, UK, etc.">

                <label for="message">Additional Details</label>
                <textarea id="message" name="message" placeholder="Briefly describe your education and plans..."></textarea>

                <button type="submit" class="auth-btn create-account-btn">
                    <i class="fas fa-paper-plane"></i>
                    Submit Registration
                </button>
            </form>
            <p class="footer-small" style="margin-top:8px;">
                Note: This is a sample form layout. Connect this to your backend or CRM to capture submissions.
            </p>
        </div>
        <!---->
        <!--<div class="contact-card" data-animate>-->
        <!--    <h3>Registration</h3>-->
        <!--    <form action="form.php" method="POST">-->
        <!--        <label for="name">Full Name</label>-->
        <!--        <input type="text" id="name" name="name" placeholder="Your full name">-->

        <!--        <label for="phone">Mobile Number</label>-->
        <!--        <input type="tel" id="phone" name="phone" placeholder="+91">-->

        <!--        <label for="email">Email Address</label>-->
        <!--        <input type="email" id="email" name="email" placeholder="you@example.com">-->

        <!--        <label for="city">City</label>-->
        <!--        <input type="text" id="city" name="city" placeholder="Your current city">-->

        <!--        <label for="interest">Interested In</label>-->
        <!--        <input type="text" id="interest" name="interest" placeholder="IELTS / PTE / Study Visa / PR / Work Permit">-->

        <!--        <label for="country">Preferred Country</label>-->
        <!--        <input type="text" id="country" name="country" placeholder="Canada, Australia, UK, etc.">-->

        <!--        <label for="message">Additional Details</label>-->
        <!--        <textarea id="message" name="message" placeholder="Briefly describe your education and plans..."></textarea>-->

        <!--        <button type="submit" class="auth-btn create-account-btn">-->
        <!--            <i class="fas fa-paper-plane"></i>-->
        <!--            Submit Registration-->
        <!--        </button>-->
        <!--    </form>-->
        <!--    <p class="footer-small" style="margin-top:8px;">-->
        <!--        Note: This is a sample form layout. Connect this to your backend or CRM to capture submissions.-->
        <!--    </p>-->
        <!--</div>-->
        
    </div>
</section>

<?php include 'footer.php'; ?>
