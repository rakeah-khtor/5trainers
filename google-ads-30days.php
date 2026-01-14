<script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());

    gtag('config', 'AW-17301291955');
</script>
<!-- Google Tag Manager -->
<script>(function (w, d, s, l, i) {
        w[l] = w[l] || []; w[l].push({
            'gtm.start':
                new Date().getTime(), event: 'gtm.js'
        }); var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-K3N4DF4B');</script>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K3N4DF4B" height="0" width="0"
        style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<?php
$meta_title = "Google Ads Course in Mohali – 30 Days PPC Training";
$meta_description = "Master Google Ads in 30 days with 5Trainers Mohali. Learn PPC, Display Ads, Search Ads & YouTube Ads with practical projects.";
$canonical_url = "https://www.5trainers.com/google-ads-30days.php";
?>
<?php include('header.php'); ?>
<link href="landingpage/assets/css/landing-page.css" type="text/css" rel="stylesheet" />
<link href="landingpage/assets/css/slider-landing.css" type="text/css" rel="stylesheet" />
<link href="landingpage/assets/css/toogle-slide.css" type="text/css" rel="stylesheet" />
<link href="landingpage/assets/css/shorttermcourse.css" type="text/css" rel="stylesheet" />
<link href="landingpage/assets/css/coursedetails.css" type="text/css" rel="stylesheet" />

<!--Slider-->
<section id="slide-show" class="setbg landignsetbg">
    <div class="custom-container width80">
        <div>
            <div class="hero-main row">
                <div class="col-lg-7 google-ads-main">
                    <div class="intro-details">
                        <div class="slide-text">
                            <p class="topP mb-15">Restricted by opportunities?</p>
                            <div class="sliderHeading mb-20">
                                <h2>Google Ads in 30 Days</h2>
                                <h1>Job Bootcamp with GenAI</h1>
                            </div>
                            <p class="coDetail">Google Ads Mastery in 30 Days Course with Guaranteed Placement Support
                                <br> Perfect for Both Freshers & Working Professionals.
                            </p>
                        </div><!--/slider text-->

                        <div class="course-features mtb-40">
                            <div class="features">
                                <img src="assets/image/landing-page/live-one.png" alt="Icon">
                                <div class="typo-pills"> Affordable Fees </div>
                            </div><!--/features-->

                            <div class="features">
                                <img src="assets/image/landing-page/live-one.png" alt="Icon">
                                <div class="typo-pills"> Certified Trainers </div>
                            </div><!--/features-->

                            <div class="features">
                                <img src="assets/image/landing-page/live-one.png" alt="Icon">
                                <div class="typo-pills"> Internship Opportunity </div>
                            </div><!--/features-->

                            <div class="features">
                                <img src="assets/image/landing-page/live-one.png" alt="Icon">
                                <div class="typo-pills"> Placement assistance</div>
                            </div><!--/features-->

                            <div class="features">
                                <img src="assets/image/landing-page/live-one.png" alt="Icon">
                                <div class="typo-pills"> Professional Resume Building </div>
                            </div><!--/features-->
                            <div class="features">
                                <img src="assets/image/landing-page/live-one.png" alt="Icon">
                                <div class="typo-pills"> Mock Interviews & HR Rounds</div>
                            </div><!--/features-->

                            <div class="features">
                                <img src="assets/image/landing-page/live-one.png" alt="Icon">
                                <div class="typo-pills"> Lifetime Access to Study Material</div>
                            </div><!--/features-->

                        </div><!--/course-features-->
                        <div class="course-metrics mt-15 mb-40">
                            <div class="course-metric">
                                <div class="metric-heading"> 95%</div>
                                <div class="metric-sub-heading"> placement rate </div>
                            </div><!--/course-metric-->
                            <div class="divider"></div><!--/divider-->

                            <div class="course-metric">
                                <div class="metric-heading"> 1200+</div>
                                <div class="metric-sub-heading"> Companies Hiring</div>
                            </div><!--/course-metric-->
                            <div class="divider"></div><!--/divider-->

                            <div class="course-metric">
                                <div class="metric-heading"> 128%</div>
                                <div class="metric-sub-heading"> Average hike</div>
                            </div><!--/course-metric-->
                            <div class="divider"></div><!--/divider-->

                            <div class="course-metric">
                                <div class="metric-heading"> 1.5 L+</div>
                                <div class="metric-sub-heading"> Learners</div>
                            </div><!--/course-metric-->
                        </div><!--/course-metrics-->

                        <div class="webinar-text">
                            <p>Know in-depth details in our free Consultancy</p>
                        </div><!--/class="webinar-text-->
                    </div><!--/intro-details-->
                </div>
                <div class="col-lg-5">
                    <div class="formAlign">
                        <div class="form-screen">
                            <div class="title">Book a <span class="talert">Course</span> <span class="more">Now</span>
                            </div>
                            <?php
                            // session_start();
                            
                            // Check for success/error messages for SweetAlert
                            $show_alert = false;
                            $alert_type = '';
                            $alert_message = '';

                            if (isset($_SESSION['form_status'])) {
                                $show_alert = true;
                                $alert_type = $_SESSION['form_status'];
                                $alert_message = $_SESSION['form_message'];
                                unset($_SESSION['form_status'], $_SESSION['form_message']);
                            }
                            ?>

                            <form action="sendmail.php" method="POST">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" required="required" placeholder="Name"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" required="required" placeholder="Email"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="tel" name="phone_number" required="required"
                                                placeholder="Phone Number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Courses</label>
                                            <div class="basic-container">
                                                <div>
                                                    <input type="radio" id="option1" name="basic" value="Google Ads">
                                                    <label for="option1">Google Ads</label>
                                                </div>
                                                <div>
                                                    <input type="radio" id="option2" name="basic"
                                                        value="Digital Marketing">
                                                    <label for="option2">Digital Marketing</label>
                                                </div>
                                                <div>
                                                    <input type="radio" id="option3" name="basic" value="SEO">
                                                    <label for="option3">SEO</label>
                                                </div>
                                                <div>
                                                    <input type="radio" id="option4" name="basic" value="Social Media">
                                                    <label for="option4">Social Media</label>
                                                </div>
                                                <div>
                                                    <input type="radio" id="option5" name="basic" value="Meta Ads"
                                                        checked>
                                                    <label for="option5">Meta Ads</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <input type="submit" class="submitbtn btn btn-primary"
                                            value="Enroll for Course Booking">
                                    </div>
                                </div>
                            </form>
                        </div><!--/form-screen-->
                    </div>
                </div>
            </div>
        </div>
</section><!--/Slider-->
<span id="top"></span>
<section class="container-fluid slider-hding">
    <div class="custom-container width80">
        <div class="row">
            <div class="col-lg-12">
                <div class="buildText">
                    <h2>You Are One Step Closer To Building A Thriving Career As <span>Google Ads Expert</span></h2>
                    <a href="contact.php">Register Now</a>
                </div>
            </div><!--col-->
        </div><!--/row-->
    </div><!--container-->
</section><!--/slider Heading-->

<section class="continer-fluid pt pb counseling">
    <div class="no-container width80">
        <div class="row">
            <div class="col-lg-7">
                <div class="section-title-area">
                    <h6 data-aos="fade-up" data-aos-duration="500"
                        class="section-subtitle section-subtitle-2 aos-init aos-animate">Transform Your Career with
                        Industry-Focused Data Science Training</h6>
                    <h1 data-aos="fade-up" data-aos-duration="800" class="section-title aos-init aos-animate">Google Ads
                        Mastery in 30 Days</h1>
                    <p data-aos="fade-up" data-aos-duration="1100" class="aos-init aos-animate">This 30-day course will
                        teach you everything you need to know about Google Ads (PPC Advertising). From creating your
                        first campaign to advanced targeting, optimization, and conversion tracking, you’ll gain
                        practical, hands-on skills to run profitable ad campaigns.</p>
                    <p data-aos="fade-up" data-aos-duration="1300" class="aos-init aos-animate">By the end of this
                        course, you’ll be able to confidently set up, manage, and scale Google Ads campaigns for any
                        business or client.</p>
                </div>
                <!--/heading div-->
                <div class="keywordsBox">
                    <ul class="mt-20">
                        <li data-aos="fade-up" data-aos-duration="500" class="aos-init aos-animate p-0">
                        <img src="assets/image/icon/bulb-blue.png"  alt="icon" class="footer-icon">     
                        career counseling for students</li>
                        <li data-aos="fade-up" data-aos-duration="500" class="aos-init aos-animate p-0">
                        <img src="assets/image/icon/bulb-blue.png"  alt="icon" class="footer-icon">    
                        importance of career counseling</li>
                        <li data-aos="fade-up" data-aos-duration="500" class="aos-init aos-animate p-0">
                         <img src="assets/image/icon/bulb-blue.png"  alt="icon" class="footer-icon">   
                        student career guidance</li>
                    </ul>
                </div>

                <!-- Trigger Button -->
                <!-- <div class="counselingButn">
                    <div class="yellowBtn"><a href="#">Get a Free Consultation</a></div>
                </div> -->


            </div>
            <!--/col-->
            <div class="col-lg-5">
                <div class="counselingAbout">
                    <!-- <img src="assets/image/slider/counseling-for-students.png" class="img-fluid" alt="Counseling"> -->
                    <img src="assets/image/slider/counseling-for-student.png" class="img-fluid" alt="Counseling">
                </div>
            </div>
            <!--/col-->
        </div>
        <!--/row-->
    </div><!--/container-->
</section><!--/Course Overview-->

<section class="contaianer-fluid pt pb courseModules">
    <div class="cutom-container width80">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area">
                    <h6 data-aos="fade-up" data-aos-duration="500" class="section-subtitle section-subtitle-2">Program
                        Journey</h6>
                    <h2 data-aos="fade-up" data-aos-duration="1000" class="section-title">Future-proof your career with
                        GenAI skills</h2>
                </div><!--/heading-->
            </div><!--/col-->
        </div><!--/row-->
        <div class="row mt-80">
            <div class="col-lg-4">
                <div class="courseMleft">
                    <div class="widget-container">
                        <h3 class="heading-title">Course Modules</h3>
                    </div>
                    <div class="service-catagery-list">
                        <div class="widget-container">
                            <ul class="icon-list-items">
                                <li class="icon-list-item tab active one">
                                    <a href="">
                                        <span class="icon-list-icon"><img
                                                src="landingpage/assets/image/icon/arrow22.png" alt="Arrow"></span>
                                        <div class="weekdivision">
                                            <span class="icon-list-text">Week 1</span>
                                            <h6>Introduction to Meta Ads & Account Setup</h6>
                                        </div>
                                    </a>
                                </li>
                                <li class="icon-list-item tab two">
                                    <a href="">
                                        <span class="icon-list-icon"><img
                                                src="landingpage/assets/image/icon/arrow22.png" alt="Arrow"></span>
                                        <div class="weekdivision">
                                            <span class="icon-list-text">Week 2</span>
                                            <h6>Campaign Creation & Ad Design</h6>
                                        </div>
                                    </a>
                                </li>
                                <li class="icon-list-item tab three">
                                    <a href="">
                                        <span class="icon-list-icon"><img
                                                src="landingpage/assets/image/icon/arrow22.png" alt="Arrow"></span>
                                        <div class="weekdivision">
                                            <span class="icon-list-text">Week 3</span>
                                            <h6>Optimization & Advanced Targeting</h6>
                                        </div>
                                    </a>
                                </li>
                                <li class="icon-list-item tab four">
                                    <a href="">
                                        <span class="icon-list-icon"><img
                                                src="landingpage/assets/image/icon/arrow22.png" alt="Arrow"></span>
                                        <div class="weekdivision">
                                            <span class="icon-list-text">Week 4</span>
                                            <h6>Scaling & Final Project</h6>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!--/courseMleft-->
            </div><!--/col-->
            <div class="col-lg-8">
                <div class="courseMright">
                    <div class="course-tab-content coursetab1">
                        <h5>Introduction to Meta Ads & Account Setup</h5>
                        <div class="row fourdivision">
                            <div class="col-lg-6 prb-0">
                                <div class="daybox borderrightbottom">
                                    <h6><span>Day 1–2</span> Meta Ads Overview</h6>
                                    <ul>
                                        <li>What are Meta Ads and how they work.</li>
                                        <li>Understanding campaign objectives: Awareness, Consideration, Conversion.
                                        </li>
                                        <li>Ad placements across Facebook, Instagram, Messenger, and Audience Network.
                                        </li>
                                    </ul>
                                </div><!--/daybox-->
                            </div><!--/col-->
                            <div class="col-lg-6 plb-0">
                                <div class="daybox prb-30 borderbottom">
                                    <h6><span>Day 3–4</span> Business Manager Setup</h6>
                                    <ul>
                                        <li>Creating and verifying a Business Manager account.</li>
                                        <li>Setting up ad accounts, pages, and pixels.</li>
                                        <li>Understanding campaign structure: Campaign, Ad Set, Ad.</li>
                                    </ul>
                                </div><!--/daybox-->
                            </div><!--/col-->
                            <div class="col-lg-6 pr-0">
                                <div class="daybox ptr-30 borderright">
                                    <h6><span>Day 5–7</span> Audience Targeting Basics</h6>
                                    <ul>
                                        <li>Core, Custom, and Lookalike audiences.</li>
                                        <li>Geo-targeting, demographics, and interest-based targeting.</li>
                                        <li>Understanding audience size and relevance.</li>
                                    </ul>
                                </div><!--/daybox-->
                            </div><!--/col-->
                        </div><!--/fourdivision-->
                    </div><!--/course-tab-content tab-1-->

                    <div class="course-tab-content coursetab2 two" id="">
                        <h5>Campaign Creation & Ad Design</h5>
                        <div class="row fourdivision">
                            <div class="col-lg-6">
                                <div class="daybox borderrightbottom">
                                    <h6><span>Day 8-10</span> Creating Your First Campaign</h6>
                                    <ul>
                                        <li>Step-by-step campaign setup.</li>
                                        <li>Setting budgets and bidding strategies.</li>
                                        <li>Choosing the right campaign objective for your goal.</li>
                                    </ul>
                                </div><!--/daybox-->
                            </div><!--/col-->
                            <div class="col-lg-6 plb-0">
                                <div class="daybox borderright">
                                    <h6><span>Day 11-12</span> Ad Creatives & Copywriting</h6>
                                    <ul>
                                        <li>Designing scroll-stopping creatives (image, video, carousel).</li>
                                        <li>Writing compelling ad copy that drives clicks.</li>
                                        <li>Using CTAs effectively.</li>
                                    </ul>
                                </div><!--/daybox-->
                            </div><!--/col-->
                            <div class="col-lg-6">
                                <div class="daybox borderright ptr-30">
                                    <h6><span>Day 13-14</span> Creative Tools & Formats</h6>
                                    <ul>
                                        <li>Using Canva, Photoshop, and Meta’s Creative Hub.</li>
                                        <li>A/B testing creatives and ad formats.</li>
                                    </ul>
                                </div><!--/daybox-->
                            </div><!--/col-->
                        </div><!--/fourdivision-->
                    </div><!--/course-tab-content tab-2-->

                    <div class="course-tab-content coursetab3 three" id="">
                        <h5>Optimization & Advanced Targeting</h5>
                        <div class="row fourdivision">
                            <div class="col-lg-6 prb-0">
                                <div class="daybox borderrightbottom">
                                    <h6><span>Day 15–16</span> Pixel & Event Setup</h6>
                                    <ul>
                                        <li>Installing Meta Pixel and tracking events.</li>
                                        <li>Standard vs custom conversions.</li>
                                    </ul>
                                </div><!--/daybox-->
                            </div><!--/col-->
                            <div class="col-lg-6 plb-0">
                                <div class="daybox prb-30">
                                    <h6><span>Day 17–18</span> Campaign Optimization</h6>
                                    <ul>
                                        <li>Reading analytics in Ads Manager.</li>
                                        <li>Improving CTR, lowering CPC, and increasing ROAS.</li>
                                        <li>Audience refinement and budget reallocation.</li>
                                    </ul>
                                </div><!--/daybox-->
                            </div><!--/col-->
                            <div class="col-lg-6 pr-0">
                                <div class="daybox ptr-30">
                                    <h6><span>Day 19-20</span> Retargeting Strategies</h6>
                                    <ul>
                                        <li>Setting up website visitor retargeting.</li>
                                        <li>Retargeting engaged users on Facebook & Instagram.</li>
                                        <li>Retargeting with video views and lead forms.</li>
                                    </ul>
                                </div><!--/daybox-->
                            </div><!--/col-->
                            <div class="col-lg-6 pl-0">
                                <div class="daybox bordertopleft plt-30">
                                    <h6><span>Day 21</span> Funnel Building with Meta Ads</h6>
                                    <ul>
                                        <li>Awareness, Consideration, and Conversion funnel.</li>
                                        <li>Building multi-step campaigns for maximum ROI.</li>
                                    </ul>
                                </div><!--/daybox-->
                            </div><!--/col-->
                        </div><!--/fourdivision-->
                    </div><!--/course-tab-content tab-3-->

                    <div class="course-tab-content coursetab4 four" id="">
                        <h5>Scaling & Final Project</h5>
                        <div class="row fourdivision">
                            <div class="col-lg-6 prb-0">
                                <div class="daybox borderrightbottom">
                                    <h6><span>Day 22-23</span> Advanced Audience Strategies</h6>
                                    <ul>
                                        <li>Using Lookalike audiences effectively.</li>
                                        <li>Interest layering for niche targeting.</li>
                                    </ul>
                                </div><!--/daybox-->
                            </div><!--/col-->
                            <div class="col-lg-6 plb-0">
                                <div class="daybox prb-30">
                                    <h6><span>Day 24–25</span> E-commerce & Lead Generation Ads</h6>
                                    <ul>
                                        <li>Setting up product catalog sales campaigns.</li>
                                        <li>Using instant forms for lead generation.</li>
                                    </ul>
                                </div><!--/daybox-->
                            </div><!--/col-->
                            <div class="col-lg-6 pr-0">
                                <div class="daybox ptr-30">
                                    <h6><span>Day 26-27</span> Scaling Ad Campaigns</h6>
                                    <ul>
                                        <li>Vertical and horizontal scaling methods.</li>
                                        <li>CBO (Campaign Budget Optimization) for scaling.</li>
                                    </ul>
                                </div><!--/daybox-->
                            </div><!--/col-->
                            <div class="col-lg-6 pl-0">
                                <div class="daybox bordertopleft plt-30">
                                    <h6><span>Day 28</span> Troubleshooting & Common Issues</h6>
                                    <ul>
                                        <li>Resolving ad rejections and account restrictions.</li>
                                        <li>Staying compliant with Meta Ads policies.</li>
                                    </ul>
                                </div><!--/daybox-->
                            </div><!--/col-->
                            <div class="col-lg-6 pr-0">
                                <div class="daybox bordertopright ptr-30">
                                    <h6><span>Day 29-30</span> Final Project: Launch a Profitable Campaign</h6>
                                    <ul>
                                        <li>Hands-on project: Create a complete Meta Ads campaign for a chosen business.
                                        </li>
                                        <li>Review, analyze, and optimize results using learned strategies.</li>
                                    </ul>
                                </div><!--/daybox-->
                            </div><!--/col-->
                        </div><!--/course-tab-content tab-4-->
                    </div>
                </div><!--/courseMright-->
            </div>
        </div><!--/container-->
</section><!--/courseModules-->

<section class="contaianer-fluid pt pb courseModules">
    <div class="cutom-container width80">
        <div class="row">
            <div class="col-lg-4">
                <div class="section-title-area">
                    <h6 data-aos="fade-up" data-aos-duration="1000" class="section-subtitle section-subtitle-2">Course
                        Features</h6>
                    <h1 data-aos="fade-up" data-aos-duration="1500" class="section-title">Future-proof your career with
                        GenAI skills</h1>
                </div><!--/heading-->
            </div><!--/col-->
            <div class="col-lg-8">
                <div class="rightsec">

                    <div class="course-journey-card-desktop one">
                        <div class="course-journey-card-desktop-wrapper">
                            <div class="emoji">
                                <img alt="Iocn" src="landingpage/assets/image/icon/Certification-Ready.png">
                                <div class="gesture-notch notch-0 zen-typo-pills"> Google Ads Certification Prep </div>
                            </div>
                            <div class="side-tracker-container">
                                <div class="ng-star-inserted leftright">
                                    <div style="border: none; margin-top: -1px; height: 0px; width: 0px;"></div>
                                </div>
                            </div>
                            <div class="feature-card">
                                <div class="feature-title zen-typo-subtitle-small">
                                    <h6>Google Ads Certification Prep </h6>
                                </div>
                                <ul class="unordered-list">
                                    <li class="zen-typo-body-small">Prepare for official Google Ads certifications.</li>
                                </ul>
                                <div class="ng-star-inserted topbtm">
                                    <div style="border: none; margin-left: -1px; height: 0px; width: 0px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="course-journey-card-desktop two">
                        <div class="course-journey-card-desktop-wrapper">
                            <div class="emoji">
                                <img alt="Iocn" class="" src="landingpage/assets/image/icon/Hands-on-Assignments.png">
                                <div class="gesture-notch notch-0 zen-typo-pills"> Hands-on Assignments </div>
                            </div>
                            <div class="side-tracker-container">
                                <div class="ng-star-inserted leftright">
                                    <div style="border: none; margin-top: -1px; height: 0px; width: 0px;"></div>
                                </div>
                            </div>
                            <div class="feature-card">
                                <div class="feature-title zen-typo-subtitle-small">
                                    <h6>Hands-on Assignments </h6>
                                </div>
                                <ul class="unordered-list">
                                    <li class="zen-typo-body-small">Real-world campaign creation & optimization.</li>
                                </ul>
                                <div class="ng-star-inserted topbtm">
                                    <div style="border: none; margin-left: -1px; height: 0px; width: 0px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="course-journey-card-desktop three">
                        <div class="course-journey-card-desktop-wrapper">
                            <div class="emoji">
                                <img alt="Iocn" class="" src="landingpage/assets/image/icon/Live-Q&A.png">
                                <div class="gesture-notch notch-0 zen-typo-pills"> Live Q&A </div>
                            </div>
                            <div class="side-tracker-container">
                                <div class="ng-star-inserted leftright">
                                    <div style="border: none; margin-top: -1px; height: 0px; width: 0px;"></div>
                                </div>
                            </div>
                            <div class="feature-card">
                                <div class="feature-title zen-typo-subtitle-small">
                                    <h6> Live Q&A</h6>
                                </div>
                                <ul class="unordered-list">
                                    <li class="zen-typo-body-small">Weekly interactive doubt-solving sessions.</li>
                                </ul>
                                <div class="ng-star-inserted topbtm">
                                    <div style="border: none; margin-left: -1px; height: 0px; width: 0px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="course-journey-card-desktop four">
                        <div class="course-journey-card-desktop-wrapper">
                            <div class="emoji">
                                <img alt="Iocn" class="" src="landingpage/assets/image/icon/SMO-Tool-Access.png">
                                <div class="gesture-notch notch-0 zen-typo-pills"> Tool Access </div>
                            </div>
                            <div class="side-tracker-container">
                                <div class="ng-star-inserted leftright"
                                    style="position: absolute; z-index: 0; border: 1px dashed; top: 58px; left: 80px; color: rgb(195, 195, 195); height: 0px; width: 72px;">
                                    <div style="border: none; margin-top: -1px; height: 0px; width: 0px;"></div>
                                </div>
                            </div>
                            <div class="feature-card">
                                <div class="feature-title zen-typo-subtitle-small">
                                    <h6>Tool Access </h6>
                                </div>
                                <ul class="unordered-list">
                                    <li class="zen-typo-body-small">Google Keyword Planner, SEMrush, SpyFu, Canva.</li>
                                </ul>
                                <div class="ng-star-inserted topbtm">
                                    <div style="border: none; margin-left: -1px; height: 0px; width: 0px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="course-journey-card-desktop five">
                        <div class="course-journey-card-desktop-wrapper">
                            <div class="emoji">
                                <img alt="Iocn" class="" src="landingpage/assets/image/icon/access.png">
                                <div class="gesture-notch notch-0 zen-typo-pills"> Lifetime Access </div>
                            </div>
                            <div class="side-tracker-container">
                                <div class="ng-star-inserted leftright">
                                    <div style="border: none; margin-top: -1px; height: 0px; width: 0px;"></div>
                                </div>
                            </div>
                            <div class="feature-card">
                                <div class="feature-title zen-typo-subtitle-small">
                                    <h6> Lifetime Access </h6>
                                </div>
                                <ul class="unordered-list">
                                    <li class="zen-typo-body-small">Course materials & updates for future strategies
                                    </li>
                                </ul>
                                <div class="ng-star-inserted topbtm">
                                    <div style="border: none; margin-left: -1px; height: 0px; width: 0px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/course Modules Col-->
            </div><!--/col-->
        </div><!--/row-->
    </div><!--/container-->
</section><!--/Course Modules-->

<section class="container-fluid pt pb whyShould">
    <div class="no-container width80">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area text-center">
                    <h1 data-aos="fade-up" class="section-title aos-init aos-animate">Why 5Trainers is the Right Choice
                        for You</h1>
                    <p data-aos="fade-up" data-aos-duration="800" class="aos-init text-center aos-animate">Become a
                        job-ready data science professional in just 6 months! Our comprehensive training covers the most
                        in-demand tools and techniques used by top data analysts and data scientists.</p>
                </div><!--/heading div-->
            </div><!--/col-->
        </div><!--/row-->
        <div class="row mt-80">
            <div class="col-lg-3">
                <div class="whyShould-container">
                    <div class="whyShould-image-box-wrapper">
                        <figure class="whyShould-image-box-img">
                            <img src="assets/image/icon/capital-gain-1.svg" class="img-fluid" alt="">
                        </figure>
                        <div class="whyShould-image-box-content">
                            <h3 class="whyShould-image-box-title">Quick Learning</h3>
                            <p class="whyShould-image-box-description">Master Google Ads in just 30 days.</p>
                        </div>
                    </div>
                </div>
            </div><!--/col-->
            <div class="col-lg-3">
                <div class="whyShould-container">
                    <div class="whyShould-image-box-wrapper">
                        <figure class="whyShould-image-box-img">
                            <img src="assets/image/icon/capital-gain-1.svg" class="img-fluid" alt="">
                        </figure>
                        <div class="whyShould-image-box-content">
                            <h3 class="whyShould-image-box-title">Result-Oriented</h3>
                            <p class="whyShould-image-box-description">Learn strategies that drive real leads & sales.
                            </p>
                        </div>
                    </div>
                </div>
            </div><!--/col-->
            <div class="col-lg-3">
                <div class="whyShould-container">
                    <div class="whyShould-image-box-wrapper">
                        <figure class="whyShould-image-box-img">
                            <img src="assets/image/icon/capital-gain-1.svg" class="img-fluid" alt="">
                        </figure>
                        <div class="whyShould-image-box-content">
                            <h3 class="whyShould-image-box-title">Expert-Led</h3>
                            <p class="whyShould-image-box-description">Taught by PPC professionals with proven results.
                            </p>
                        </div>
                    </div>
                </div>
            </div><!--/col-->
            <div class="col-lg-3">
                <div class="whyShould-container">
                    <div class="whyShould-image-box-wrapper">
                        <figure class="whyShould-image-box-img">
                            <img src="assets/image/icon/capital-gain-1.svg" class="img-fluid" alt="">
                        </figure>
                        <div class="whyShould-image-box-content">
                            <h3 class="whyShould-image-box-title">Comprehensive</h3>
                            <p class="whyShould-image-box-description">Covers Search, Display, Video, Shopping &
                                Performance Max.</p>
                        </div>
                    </div>
                </div>
            </div><!--/col-->
        </div><!--/row-->
    </div>
</section><!--/Why Choose This Course?-->

<?php include('placement-certificate-havequestion.php'); ?>

<section class="container-fluid pt pb faq">
    <div class="custom-container width80">
        <div class="row">
            <div class="col-sm-5 col-lg-6">
                <div class="section-title-area">
                    <span class="section-subtitle section-subtitle-2">FAQ's</span>
                    <h3 data-aos="fade-up" data-aos-duration="1000" class="section-title aos-init aos-animate">Got
                        questions? we've got answers</h3>
                    <p data-aos="fade-up" data-aos-duration="1700" class="aos-init aos-animate">The Most Eminent Visas
                        and Immigration Consultant service provider. Branches in Delhi and overseas state.</p>
                </div>
                <!--heading-->
                <!-- <div class="faqimg"><img src="../assets/image/services/faq-bg.png" alt="" class="img-fluid"></div> -->
                <div class="faqimg"><img src="assets/image/services/Q-A.png" alt="" class="img-fluid"></div>
            </div>
            <div class="col-sm-7 col-lg-6">
                <div class="accordion rpt mt-80">
                    <div class="box active aos-init aos-animate" data-aos="fade-up" data-aos-duration="500">
                        <div class="label">1. Who can join the Google Ads course?</div>
                        <div class="content">
                            Anyone interested in learning online advertising – students, business owners, marketers, or
                            professionals looking to upskill – can join. No prior experience is needed.
                        </div>
                    </div>
                    <div class="box aos-init" data-aos="fade-up" data-aos-duration="700">
                        <div class="label">2. What will I learn in this 1-month course?</div>
                        <div class="content">
                            You’ll learn campaign creation, keyword research, ad targeting, bidding strategies,
                            conversion tracking, optimization, and Google Ads policies.
                        </div>
                    </div>
                    <div class="box aos-init" data-aos="fade-up" data-aos-duration="900">
                        <div class="label">3. Will I get hands-on practice?</div>
                        <div class="content">Yes. You’ll work on live projects and real campaigns to gain practical
                            experience alongside theoretical concepts.</div>
                    </div>
                    <div class="box aos-init" data-aos="fade-up" data-aos-duration="1100">
                        <div class="label">4. Will I receive a certificate after completion?</div>
                        <div class="content">
                            Yes, you will get a recognized certificate from our institute after successfully completing
                            the course.
                        </div>
                    </div>
                    <div class="box aos-init" data-aos="fade-up" data-aos-duration="1300">
                        <div class="label">5. How are the classes conducted?</div>
                        <div class="content">
                            Classes are conducted online and offline (depending on your preference) with flexible
                            weekday and weekend batches
                        </div>
                    </div>
                </div>
                <!--/accordion-->
            </div>
        </div>
    </div>
</section><!--/FAQ-->

<?php include('footer.php'); ?>