<?php
require __DIR__ . '/auth.php';
$site_cfg = require __DIR__ . '/../include/config.php';
$admin_cfg = require __DIR__ . '/config.php';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blog Admin</title>
  <link rel="stylesheet" href="assets/css/admin.css">
  <script>
    window.__BLOG_CONFIG = {
      apiBase: <?php echo json_encode($site_cfg['apiBase']); ?>, // from blog/include/config.php
      basePath: <?php echo json_encode($site_cfg['basePath']); ?>
    };
    window.__ADMIN_TOKEN = <?php echo json_encode($admin_cfg['admin_token']); ?>;
  </script>
</head>
<body>
  <div style="max-width:1100px;margin:18px auto;padding:0 12px;">
    <div style="display:flex;justify-content:flex-end;margin-bottom:10px;">
      <a href="logout.php" style="text-decoration:none;">Logout</a>
    </div>
  </div>

<header class="admin-header">
    <div class="admin-header-inner">
      <div style="display:flex;align-items:center;gap:12px;">
        <a href="<?php echo htmlspecialchars($site_cfg['basePath']); ?>" style="display:inline-flex;align-items:center;">
          <img src="<?php echo htmlspecialchars($site_cfg['basePath']); ?>../assets/image/logo.png" alt="5Trainers" style="height:40px;max-width:140px;object-fit:contain;">
        </a>
        <div>
          <h1 class="admin-title">Blog Admin</h1>
          <p class="admin-subtitle">Create, edit, and delete blog posts</p>
        </div>
      </div>
      <div class="admin-actions">
        <a class="admin-link" href="<?php echo htmlspecialchars($site_cfg["basePath"]); ?>">View Blog</a>
      </div>
    </div>
  </header>

  <main class="admin-main">
    <!-- POSTS LIST PANEL (stays on page) -->
    <section class="admin-panel">
      <div class="panel-header">
        <h2>Posts</h2>
        <div class="panel-controls">
          <input id="searchInput" type="search" placeholder="Search title / slug / content..." />
          <select id="sortSelect">
            <option value="newest" selected>Newest first</option>
            <option value="oldest">Oldest first</option>
            <option value="title">Title A–Z</option>
          </select>
          <select id="statusFilter">
            <option value="">All statuses</option>
            <option value="published">Published</option>
            <option value="draft">Drafts</option>
          </select>
          <button id="newBtn" class="admin-btn primary">+ New Post</button>
        </div>
      </div>

      <div class="table-wrap">
        <table class="admin-table">
          <thead>
            <tr>
              <th>Image</th>
              <th>Title</th>
              <th>Slug</th>
              <th>Date</th>
              <th class="actions-col">Actions</th>
            </tr>
          </thead>
          <tbody id="postsTbody"></tbody>
        </table>
      </div>

      <div id="statusBar" class="status-bar" aria-live="polite"></div>
    </section>
  </main>

  <!-- MODAL (popup) -->
  <div id="postModal" class="modal" aria-hidden="true">
    <div class="modal-overlay" data-modal-close></div>

    <div class="modal-dialog" role="dialog" aria-modal="true" aria-labelledby="formTitle">
      <section class="admin-panel modal-panel">
        <div class="panel-header modal-header">
          <h2 id="formTitle">Create Post</h2>
          <button type="button" id="modalCloseBtn" class="modal-close" aria-label="Close">
            ×
          </button>
        </div>

        <form id="postForm" class="post-form">
          <input type="hidden" id="postId" />

          <label>
            Title *
            <input id="postTitle" type="text" required placeholder="Post title" />
          </label>

          <label>
            Slug (post_name) *
            <input id="postSlug" type="text" required placeholder="auto-generated if empty" />
            <small>Must be unique. Example: <code>my-first-post</code></small>
          </label>

          <label>
            Date
            <input id="postDate" type="datetime-local" />
            <small>Optional. If empty, the server will use current date/time.</small>
          </label>

          <label>
            Image URL/Path
            <input id="postImage" type="text" placeholder="assets/images/placeholder.svg or https://..." />
            <small>Either paste a URL/path OR upload an image below (upload will auto-fill this field).</small>
          </label>

          <label>
            Upload Image (PNG/JPG/JPEG)
            <input id="postImageFile" type="file" accept="image/png,image/jpeg" />
            <small>On Save, the server stores it under <code>assets/images</code> and returns the exact URL.</small>
          </label>

          <label>
            Author
            <input id="postAuthor" type="text" placeholder="Optional author name" />
          </label>

          <label>
            Status
            <select id="postStatus">
              <option value="draft">Draft</option>
              <option value="published">Published</option>
            </select>
            <small>Use Draft while editing. Switch to Published to show on the public blog.</small>
          </label>

          <label>
            Content
            <textarea id="postContent" rows="12" placeholder="Write your post content here..."></textarea>
          </label>

          <div class="form-actions">
            <button type="submit" class="admin-btn primary" id="saveBtn">Save</button>
            <button type="button" class="admin-btn" id="resetBtn">Reset</button>
            <button type="button" class="admin-btn danger" id="deleteBtn" style="display:none;">Delete</button>
          </div>

          <div class="image-preview">
            <p class="preview-label">Preview</p>
            <img
              id="imagePreview"
              src="<?php echo htmlspecialchars($site_cfg["basePath"]); ?>assets/images/placeholder.svg"
              alt="preview"
            />
          </div>
        </form>
      </section>
    </div>
  </div>

  <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
  <script src="assets/js/admin.js" defer></script>
</body>
</html>

