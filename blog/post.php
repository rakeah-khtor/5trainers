<?php
// Load shared blog config (API base + blog base path)
$cfg = require __DIR__ . '/include/config.php';

$id   = isset($_GET['id']) ? trim($_GET['id']) : '';
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

// Basic SEO/meta setup for the main header
if ($slug) {
    $meta_title = 'Blog - ' . $slug . ' | 5Trainers';
} else {
    $meta_title = 'Blog Post | 5Trainers';
}
$meta_description = "Read this blog article from 5Trainers on careers, courses, and training insights.";
$canonical_url = "https://www.5trainers.com/blog/post.php" . ($id ? "?id=" . urlencode($id) : '');

// Compute the actual blog base URL from the current script path so it works
// under localhost subfolders and on production.
$blogBaseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/') . '/';

// Flag so header/footer know this is inside /blog/
$is_blog = true;
// Use the main site header/footer (located at project root)
include __DIR__ . '/../header.php';
?>

<!-- Blog-specific styles (layout/content for single post) -->
<link rel="stylesheet" href="<?php echo htmlspecialchars($blogBaseUrl . 'assets/css/style.css', ENT_QUOTES); ?>">

<script>
  // Share config + current slug with the blog JS
  window.__BLOG_CONFIG = {
    apiBase: <?php echo json_encode($cfg['apiBase']); ?>,
    basePath: <?php echo json_encode($blogBaseUrl); ?>,
  };
  window.__BLOG_SLUG = <?php echo json_encode($slug); ?>;
</script>

<div class="blog-container" style="margin-top:20px;">
  <?php echo '<a class="back-link" href="' . htmlspecialchars($blogBaseUrl) . '">&larr; Back to Blog</a>'; ?>
</div>

<div class="blog-layout">
  <div class="blog-full" id="blogContent"></div>

  <aside class="blog-sidebar">
    <h3 class="sidebar-title">Latest Blogs</h3>
    <div id="latestBlogs" class="latest-list"></div>
  </aside>
</div>

<!-- LocalStorage-only comments widget -->
<div class="comments-wrap">
  <h3>Comments</h3>
  <form id="commentForm" class="comment-form" novalidate>
    <label>
        Name*
        <input type="text" id="cName" name="name" autocomplete="name" minlength="4">
      <span id="errName" class="field-error"></span>
    </label>

    <label>
      Email*
      <input type="email" id="cEmail" name="email" autocomplete="email">
      <span id="errEmail" class="field-error"></span>
    </label>

    <label>
      Comment*
      <textarea id="cText" name="comment" rows="4"></textarea>
      <span id="errText" class="field-error"></span>
    </label>

    <button type="submit" class="back-btn" style="margin-top:8px;">Post Comment</button>
    <div id="commentStatus" class="field-error" style="margin-top:6px;"></div>
  </form>

  <div id="commentsList" class="comments-list"></div>
</div>

<script src="<?php echo $blogBaseUrl; ?>assets/js/blog.js" defer></script>

<?php
$is_blog = true;
include __DIR__ . '/../footer.php';
?>
