<?php
// Load blog config (API base + blog base path)
$cfg = require __DIR__ . '/include/config.php';

// SEO/meta for this page
$meta_title = "5Trainers Blog – Latest Updates & Course Insights";
$meta_description = "Read the latest articles, course updates, and career tips from 5Trainers across Digital Marketing, Data, AI, Cyber Security and more.";
$canonical_url = "https://www.5trainers.com/blog/index.php";

// Compute the actual blog base URL from the current script path so it works
// under localhost subfolders and on production.
$blogBaseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/') . '/';

// Flag so header/footer know this is inside /blog/
$is_blog = true;
// Use the main site header/footer (located at project root)
include __DIR__ . '/../header.php';
?>

<!-- Blog-specific styles (layout for cards/grid) -->
<link rel="stylesheet" href="<?php echo htmlspecialchars($blogBaseUrl . 'assets/css/style.css', ENT_QUOTES); ?>">

<div class="blog-container">
  <h1>Latest Blogs</h1>
  <div class="card-grid" id="blogList"></div>

  <div class="load-more-wrap">
    <button id="loadMoreBtn" class="load-more-btn">Load More</button>
  </div>
</div>

<script>
  // Pass config to the blog JS so it knows where to load data from
  window.__BLOG_CONFIG = {
    apiBase: <?php echo json_encode($cfg['apiBase']); ?>,
    basePath: <?php echo json_encode($blogBaseUrl); ?>,
  };
</script>
<script src="<?php echo $blogBaseUrl; ?>assets/js/blogList.js" defer></script>

<?php
$is_blog = true;
include __DIR__ . '/../footer.php';
?>
