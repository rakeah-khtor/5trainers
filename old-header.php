<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Google Tag Manager -->
  <script>(function (w, d, s, l, i) {
      w[l] = w[l] || []; w[l].push({
        'gtm.start':
          new Date().getTime(), event: 'gtm.js'
      }); var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
          'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-K3N4DF4B');</script>
  <!-- End Google Tag Manager -->


  <style>
    /* ✅ Default dropdown hidden */
    .drop-menu {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.4s ease;
    }

    .drop-menu {
      max-height: 100%;
      overflow: hidden;
      transition: max-height 0.4s ease;
      max-height: 620px;
    }



    /* ✅ Mobile dropdown open behavior */
    @media (max-width: 970px) {

      /* ensure images visible on dark backgrounds */
      .menu_box img {
        filter: invert(1);
      }

      .close_icon img {
        filter: grayscale(1);
      }


      /* When checkbox checked, expand dropdown */
      #drop-about:checked~.drop-menu,
      #drop-courses:checked~.drop-menu,
      #drop-counseling:checked~.drop-menu {
        max-height: 800px;
        /* big enough for full content */
      }

      .drop-menu {
        max-height: 100%;
        overflow: hidden;
        transition: max-height 0.4s ease;
        max-height: auto !important;
      }
    }

    :root {
      /* --color-primary: #f97316; Orange color */
      --color-primary: #ff8503;
      /* Orange color */
      --color-primary-dark: #ff8503;
      /* Darker orange for hover */
      --color-text-dark: #1f2937;
      /* Dark gray text color */
      --font-family: 'Inter', sans-serif;
    }

    @keyframes scroll-loop {
      0% {
        transform: translateX(100%);
      }

      100% {
        transform: translateX(-100%);
      }
    }

    /* --- Full-width Scrolling Bar Container (Hides Overflow) --- */
    .scrolling-bar {
      overflow: hidden;
      white-space: nowrap;
      background-color: white;
      border-bottom: 2px solid var(--color-primary);
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
      /* Soft shadow */
      padding: 0.75rem 0;
    }

    /* --- Scrolling Track (Applies the animation) --- */
    .scrolling-track {
      display: flex;
      width: max-content;
      /* Critical: Makes the track width equal to the combined content */
      animation: scroll-loop 25s linear infinite;
      /* 25s speed, infinite loop */
    }

    /* --- Pause on Hover Enhancement --- */
    .scrolling-bar:hover .scrolling-track {
      animation-play-state: paused;
    }

    /* --- Content Block Structure & Styling --- */
    .scrolling-content-unit {
      display: flex;
      align-items: center;
      font-family: var(--font-family);
      font-size: 0.875rem;
      /* text-sm */
      font-weight: 500;
      /* font-medium */
      color: var(--color-text-dark);
      letter-spacing: 0.025em;
      /* tracking-wide */
      padding-right: 4rem;
      /* Ensures large gap between repeating blocks */
    }

    /* Styling for links within the content */
    .scrolling-content-unit a {
      font-weight: 600;
      margin-left: 0.25rem;
      text-decoration: none;
      color: inherit;
      transition: color 150ms ease-in-out;
    }

    .scrolling-content-unit a:hover {
      color: var(--color-primary-dark);
    }

    /* Styling for separators and icons */
    .scrolling-content-unit .separator {
      color: var(--color-primary);
      margin: 0 0.5rem;
    }

    .scrolling-content-unit .icon {
      color: var(--color-primary);
      margin-right: 0.5rem;
    }

    .scrolling-content-unit .label {
      margin-right: 1.5rem;
    }

    .scrolling-content-unit .pipe-separator {
      color: var(--color-primary);
      margin: 0 1.5rem;
    }

    .modal-backdrop.show {
      opacity: 0 !important;
    }

    .modal-backdrop {
      display: none !important;
    }

    .brochure-btn {
      /* background-color: #2c849e; */
      background-color: #0f79be;
      border-radius: 10px;
      padding: 0px 40px;
      height: 60px;
      border: none;
      color: white;
      font-weight: 600;
      font-size: 17px;
      margin-left: 20px
    }

    .popup-form {
      border: 1px solid #dee2e6;
      border-radius: 5px;
      align-items: center;
      padding: 0px 10px;
    }

    .form-control {
      border: none !important;
      outline: none !important;
    }

    .form-btn {
      background-color: #2c849e;
      border-radius: 10px;
      padding: 0px 40px;
      height: 60px;
      border: none;
      color: white;
      font-weight: 600;
      font-size: 17px;
    }

    .form-control:focus {
      box-shadow: none !important;
    }
  </style>
</head>
<header>
  <nav>

    <div class="scrolling-bar">
      <div class="scrolling-track">

        <!-- Content Unit 1 -->
        <div class="scrolling-content-unit">
          <span class="label">Contact us for</span>
          <span class="separator">|</span>

          <i class="fa-solid fa-phone icon"></i>
          Digital Marketing Inquire :
          <a href="tel:+919717107250">+91-9717107250</a>

          <span class="pipe-separator">|</span>

          <i class="fa-solid fa-code icon"></i>
          Web Development Inquire :
          <a href="tel:+918750500075">+91-8750500075</a>
        </div>

        <!-- Content Unit 2 (The required duplicate for the seamless loop) -->
        <div class="scrolling-content-unit">
          <span class="label">Contact us for</span>
          <span class="separator">|</span>

          <i class="fa-solid fa-phone icon"></i>
          Digital Marketing :
          <a href="tel:+919717107250">+91-9717107250</a>

          <span class="pipe-separator">|</span>

          <i class="fa-solid fa-code icon"></i>
          Web Development :
          <a href="tel:+918750500075">+91-8750500075</a>
        </div>

      </div>
    </div>

    <div class="nocontainer width80">
      <div class="wrapper">
        <div class="logo">
          <a href="index.php"><img src="assets/image/Final-logo.png" alt="" class="img-fluid"></a>
        </div>

        <input type="radio" name="slider" id="menu-btn">
        <input type="radio" name="slider" id="close-btn">

        <ul class="nav-links menu_box">
          <label for="close-btn" class="btn close-btn close_icon"><img src="assets/image/icon/close.png"></label>

          <li><a href="index.php" class="home">Home</a></li>

          <!-- ✅ About dropdown -->
          <li>
            <a href="about.php" class="desktop-item">About <span><img
                  src="assets/image/icon/expand_arrow.png"></span></a>
            <input type="checkbox" id="drop-about">
            <label for="drop-about" class="mobile-item">About <span><img
                  src="assets/image/icon/expand_arrow.png"></span></label>
            <ul class="drop-menu">
              <li><a href="about.php">About 5Trainer</a></li>
              <li><a href="founder.php">Our Founder</a></li>
            </ul>
          </li>

          <!-- ✅ Courses dropdown -->
          <li>
            <a href="course.php" class="desktop-item">Courses <span><img
                  src="assets/image/icon/expand_arrow.png"></span></a>
            <input type="checkbox" id="drop-courses">
            <label for="drop-courses" class="mobile-item">Courses <span><img
                  src="assets/image/icon/expand_arrow.png"></span></label>
            <ul class="drop-menu">
              <li><a href="digitalmarketingcourse.php">Digital Marketing Course</a></li>
              <li><a href="seo-one-month.php">SEO Course</a></li>
              <li><a href="google-ads-30days.php">Google Ads</a></li>
              <li><a href="meta-ads-30days.php">Meta Ads</a></li>
              <li><a href="smo-one-month.php">SMO Course</a></li>
              <li><a href="smm.php">SMM Course</a></li>
              <li><a href="full-stack-webdevelopment.php">Full Stack Development</a></li>
              <li><a href="data-science-professional-training-6-months.php">Data Science Professional Training</a></li>
              <li><a href="artificial-intelligence.php">Artificial Intelligence</a></li>
              <li><a href="data-analytics-6months.php">Data Analytics</a></li>
            </ul>
          </li>

          <!-- ✅ Counseling dropdown -->
          <li>
            <a href="#" class="desktop-item">Counseling <span><img src="assets/image/icon/expand_arrow.png"></span></a>
            <input type="checkbox" id="drop-counseling">
            <label for="drop-counseling" class="mobile-item">Counseling <span><img
                  src="assets/image/icon/expand_arrow.png"></span></label>
            <ul class="drop-menu">
              <li><a href="counseling-for-students.php">For Students</a></li>
              <li><a href="professionals.php">For Professionals</a></li>
              <li><a href="institutions.php">For Institutions</a></li>
            </ul>
          </li>

          <li><a href="blog.php">Blog</a></li>
          <li><a href="contact.php">Contact Us</a></li>


          <button type="button" class="brochure-btn d-block" data-bs-toggle="modal"
            data-bs-target="#staticBackdrop">Brochure</button>


        </ul>

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
          aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Download Brochure</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <!-- Modal Body -->
              <div class="modal-body">
                <div class="bnrform">
                  <form action="pdfform.php" method="POST" id="emailForm">

                    <div class="mb-3 d-flex popup-form">
                      <i class="fa fa-user"></i>
                      <input type="text" name="name" id="name" class="form-control" placeholder="Name" required minlength="4">
                    </div>

                    <div class="mb-3 d-flex popup-form">
                      <i class="fa fa-envelope"></i>
                      <input type="email" name="email" id="email" class="form-control" placeholder="Email Id" required>
                    </div>

                    <div class="mb-3 d-flex popup-form">
                      <i class="fa fa-phone"></i>
                      <input type="tel" name="number" id="number" class="form-control" placeholder="Phone Number"
                        required>
                    </div>

                    <div class=" d-flex justify-content-center">
                      <button type="submit" class="form-btn d-block">Download Brochure</button>
                    </div>

                  </form>
                </div>
              </div>

              <!-- Optional Footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>

            </div>
          </div>
        </div>
        <label for="menu-btn" class="btn menu-btn"><img src="assets/image/icon/toggle.png" alt=""></label>
      </div>
    </div>
  </nav>
</header>
