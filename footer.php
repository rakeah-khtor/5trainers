<?php
  // When included from /blog/, adjust asset paths and internal links one level up.
  $footerAssetPrefix = !empty($is_blog) ? '../' : '';
  $footerLinkPrefix  = !empty($is_blog) ? '../' : '';
?>
<?php include($footerAssetPrefix . 'assets/include/floating-icon.php'); ?>

<span id="top"></span>

<section class="continer-fluid ftr-top">
  <div class="contain">
    <div class="row">
      <div class="col-sm-6 col-md-6 col-lg-4">
        <div class="footer-contact-two">
          <div class="icon"><span><img src="<?php echo $footerAssetPrefix; ?>assets/image/icon/ftr-phn.png" alt="call-request-training"></span></div>
          <div class="content">
            <h3>
              <a class="d-block" href="tel:+918283840606">+91 8283840606</a>
            </h3>
            <p> Give us a call </p>
          </div>
          <div class="right"><span><img src="<?php echo $footerAssetPrefix; ?>assets/image/icon/ftr-phn-light.png"
                alt="give-call-request-training"></span></div>
        </div>
      </div><!--/col-->

      <div class="col-sm-6 col-md-6 col-lg-4">
        <div class="footer-contact-two">
          <div class="icon"><span><img src="<?php echo $footerAssetPrefix; ?>assets/image/icon/ftr-email.png" alt="email us for query"></span></div>
          <div class="content">
            <h3>
              <a href="https://mail.google.com/mail/?view=cm&fs=1&to=info@5trainers.com"
                target="_blank">info@5trainers.com</a>
            </h3>
            <p> Drop us a line</p>
          </div>
          <div class="right"><span><img src="<?php echo $footerAssetPrefix; ?>assets/image/icon/ftr-email-light.png" alt=""></span></div>
        </div>
      </div><!--/col-->

      <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="footer-contact-two">
          <div class="icon"><span><img src="<?php echo $footerAssetPrefix; ?>assets/image/icon/ftr-location.png" alt=""></span></div>
          <div class="content">
            <h3><a href="https://maps.app.goo.gl/6kAtYrE7bm3SqC4N9" target="_blank">Victory Tower, Phase 8B, Industrial
                Area, Sector 74, SAS Nagar, Punjab 160055</a></h3>

          </div>
          <div class="right"><span><img src="<?php echo $footerAssetPrefix; ?>assets/image/icon/ftr-location-light.png" alt=""></span></div>
        </div>
      </div><!--/col-->

    </div>
  </div>
</section><!--/footer top-->

<footer class="continer-fluid ftr">
  <!--div class="ftr-imag"></div-->
  <div class="nocontainer width90">
    <div class="row">
      <div class="col-sm-6 col-lg-4 col-md-12">
        <div class="aboutts aos-init aos-animate" data-aos="zoom-in-right">
          <div class="logodiv"><a href="<?php echo $footerLinkPrefix; ?>index.php"><img src="<?php echo $footerAssetPrefix; ?>assets/image/5trainer-logo.png" class="img-fluid" alt=""></a></div>
          <p class="">We Don't Just Teach—We Empower You With Market-Proven Techniques To Outperform The Competition</p>
          <div class="ftrlocation">
            <p>
              <spna><img src="<?php echo $footerAssetPrefix; ?>assets/image/icon/ftr-location.png" alt="icon"></spna><a
                href="https://maps.app.goo.gl/6kAtYrE7bm3SqC4N9" target="_blank">Victory Tower Phase 8B, Industrial
                Area, Sector 74, Mohali, Punjab 140308</a>
            </p>
            <p>
              <spna><img src="<?php echo $footerAssetPrefix; ?>assets/image/icon/ftr-phn.png" alt="icon"></spna><a class="d-block"
                href="tel:+918283840606">+91 8283840606</a>
            </p>
            <p>
              <spna><img src="<?php echo $footerAssetPrefix; ?>assets/image/icon/ftr-email.png" alt="icon"></spna><a
                href="https://mail.google.com/mail/?view=cm&fs=1&to=info@5trainers.com"
                target="_blank">info@5trainers.com</a>
            </p>
          </div>
        </div>
      </div><!--/col-->
      <div class="col-sm-6 col-lg-2 col-md-4">
        <div class="comnli quicklink aos-init aos-animate" data-aos="zoom-in-left">
          <h4>Useful Links</h4>
          <ul class="footer-ul">
            <li>
             <img src="<?php echo $footerAssetPrefix; ?>assets/image/icon/bulb-white.png" alt="icon" class="footer-icon">   
            <a href="<?php echo $footerLinkPrefix; ?>about.php">About</a></li>
            <li>
             <img src="<?php echo $footerAssetPrefix; ?>assets/image/icon/bulb-white.png" alt="icon" class="footer-icon">   
            <a href="<?php echo $footerLinkPrefix; ?>course.php">Courses</a></li>
            <li>
             <img src="<?php echo $footerAssetPrefix; ?>assets/image/icon/bulb-white.png" alt="icon" class="footer-icon">   
            <a href="<?php echo $footerLinkPrefix; ?>career.php">Career</a></li>
            <li>
             <img src="<?php echo $footerAssetPrefix; ?>assets/image/icon/bulb-white.png" alt="icon" class="footer-icon">   
            <a href="<?php echo $footerLinkPrefix; ?>terms-conditions.php">Terms of Service</a></li>
            <li>
             <img src="<?php echo $footerAssetPrefix; ?>assets/image/icon/bulb-white.png" alt="icon" class="footer-icon">   
            <a href="<?php echo $footerLinkPrefix; ?>privacy-policy.php">Privacy Policy</a></li>
          </ul>
        </div>
      </div><!--/col-->
      <div class="col-sm-6 col-lg-3 col-md-4">
        <div class="comnli aos-init aos-animate" data-aos="zoom-in-left">
          <h4>courses</h4>
          <ul class="footer-ul">
            <li>
            <img src="<?php echo $footerAssetPrefix; ?>assets/image/icon/bulb-white.png" alt="icon" class="footer-icon">  
            <a href="<?php echo $footerLinkPrefix; ?>digitalmarketingcourse.php">Digital Marketing</a></li>
            <li>
             <img src="<?php echo $footerAssetPrefix; ?>assets/image/icon/bulb-white.png" alt="icon" class="footer-icon">   
            <a href="<?php echo $footerLinkPrefix; ?>google-ads-30days.php">Google Ads</a></li>
            <li>
             <img src="<?php echo $footerAssetPrefix; ?>assets/image/icon/bulb-white.png" alt="icon" class="footer-icon">   
            <a href="<?php echo $footerLinkPrefix; ?>seo-one-month.php">Search Engine Optimization</a></li>
            <li>
             <img src="<?php echo $footerAssetPrefix; ?>assets/image/icon/bulb-white.png" alt="icon" class="footer-icon">   
            <a href="<?php echo $footerLinkPrefix; ?>smm.php">Social Media Marketing</a></li>
          </ul>
        </div>
      </div><!--/col-->
      <div class="col-sm-6 col-lg-3 col-md-4">
        <div class="comnli fsocial aos-init aos-animate" data-aos="zoom-in-down">
          <h4>social links</h4>
          <ul class="footer-ul">
            <li><a href="https://www.facebook.com/profile.php?id=61576550454616" target="_blank"><span>
              <!-- <img src="assets/image/icon/f-fb.png" alt="icon"> -->
                  <i class="fa-brands fa-square-facebook footer-icon"></i>
                  </span>Facebook</a></li>
            <li><a href="https://x.com/_5trainers" target="_blank"><span>
              <!-- <img src="assets/image/icon/f-tw.png"alt="icon"> -->
           <i class="fa-brands fa-x-twitter footer-icon"></i>
            </span>Twitter</a></li>
            <li><a href="https://www.linkedin.com/company/5trainer" target="_blank"><span>
              <!-- <img style="width:30px"src="assets/image/icon/mdi_linkedin.png" alt="icon"> -->
               <i class="fa-brands fa-linkedin  footer-icon" ></i>
            </span>linkedin</a></li>
            <li><a href="https://www.instagram.com/5_trainers/" target="_blank"><span>
              <!-- <img src="assets/image/icon/f-insta.png" alt="icon"> -->
               <i class="fa-brands fa-square-instagram footer-icon"></i>
            </span>Instagram</a></li>
            <li><a href="https://www.youtube.com/@5Trainers" target="_blank"><span>
              <!-- <img src="assets/image/icon/f-yt.png"
                    alt="icon"> -->
                  <i class="fa-brands fa-square-youtube footer-icon"></i>
                  </span>YouTube</a></li>
          </ul>
        </div>
      </div>
    </div><!--row-->
    <div class="row btm-ftr">
      <div class="scrolltop"><a href="#top" id="bottom"><span><img src="<?php echo $footerAssetPrefix; ?>assets/image/icon/scroll-up.png"></span></a>
      </div>
      <div class="col-sm-12 col-lg-12 col-md-12">
        <div class="btm-ftr-left">
          <p>Copyright © 2025 <a href="https://www.theneedleads.com/">Needleads</a> All Rights Reserved</p>
        </div>
      </div>
    </div>
  </div>
</footer>
<script src="<?php echo $footerAssetPrefix; ?>assets/js/jquery.min.js"></script>
<script src="<?php echo $footerAssetPrefix; ?>assets/js/wow.js"></script>
<script src="<?php echo $footerAssetPrefix; ?>assets/js/aos.js"></script>
<script src="<?php echo $footerAssetPrefix; ?>assets/js/faq.js"></script>
<script src="<?php echo $footerAssetPrefix; ?>assets/js/scrolltop.js"></script>
<script src="<?php echo $footerAssetPrefix; ?>assets/js/fixed-header.js"></script>
<script src="<?php echo $footerAssetPrefix; ?>assets/js/call-request.js"></script>
<script src="<?php echo $footerAssetPrefix; ?>landingpage/assets/js/vertical-tab.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.1/owl.carousel.min.js"></script>
<script>

  AOS.init({
    easing: 'ease-in-out-sine'
  });
</script>
<script>
  const modal = document.getElementById("callbackModal");

  function openModal() {
    modal.style.display = "flex";
  }

  function closeModal() {
    modal.style.display = "none";
  }

  function outsideClick(e) {
    if (e.target === modal) {
      closeModal();
    }
  }
</script><!--/call-->

<script>
  $(".box-video").click(function () {
    $('iframe', this)[0].src += "&amp;autoplay=1";
    $(this).addClass('open');
  });
</script>

<!--   If call not possible, then redirect WhatsApp-->
<script>
  function makeContact() {
    // Try to open phone dialer
    window.location.href = "tel:+918283840606";

    // If not supported (desktop, tablet without SIM, etc.), fallback to WhatsApp after short delay
    setTimeout(function () {
      let whatsappMsg = "Hello, I’d like to get in touch";
      let whatsappURL = "https://wa.me/918283840606?text=" + encodeURIComponent(whatsappMsg);
      window.open(whatsappURL, "_blank");
    }, 1000); // 1 second delay
  }
</script>
