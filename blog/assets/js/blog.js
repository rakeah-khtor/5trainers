const BLOG_CONFIG = window.__BLOG_CONFIG || { apiBase: "/api", basePath: "/blog/" };
const API_BASE = (BLOG_CONFIG.apiBase || "/api").replace(/\/$/, "");
const BASE_PATH = (BLOG_CONFIG.basePath || "/blog/").replace(/([^\/])$/, "$1/");

// Identify the current blog either by id (query) or slug (query / injected)
const urlParams = new URLSearchParams(window.location.search);
const blogId = urlParams.get("id");
const slugFromQuery = urlParams.get("slug");
const slugFromInjected = (window.__BLOG_SLUG || "").toString().trim();
let blogSlug = (slugFromInjected || slugFromQuery || "").toString().trim();

// Guard against bad slugs like "index.php" that may come from misrouted URLs
if (blogSlug && /\.php$/i.test(blogSlug)) {
  blogSlug = "";
}

const els = {
  content: document.getElementById("blogContent"),
  latest: document.getElementById("latestBlogs"),

  // Comment form
  commentForm: document.getElementById("commentForm"),
  cName: document.getElementById("cName"),
  cEmail: document.getElementById("cEmail"),
  cText: document.getElementById("cText"),
  commentsList: document.getElementById("commentsList"),
  commentStatus: document.getElementById("commentStatus"),

  errName: document.getElementById("errName"),
  errEmail: document.getElementById("errEmail"),
  errText: document.getElementById("errText"),
};

const PLACEHOLDER_IMG = `${BASE_PATH}assets/images/placeholder.svg`;

function normalizeImagePath(v) {
  if (!v) return "";
  const s = String(v).trim();
  if (!s) return "";
  // Existing JSON may contain assets/... whereas uploads return /assets/...
  if (s.startsWith("/blog/")) return `${BASE_PATH}${s.replace(/^\/blog\//, "")}`;
  if (s.startsWith("/assets/")) return `${BASE_PATH}${s.replace(/^\/+/, "")}`;
  if (s.startsWith("/")) return s;
  if (s.startsWith("assets/")) return `${BASE_PATH}${s}`;
  if (s.startsWith("blog/assets/")) return `/${s}`;

  return s;
}

function esc(str) {
  return (str || "")
    .toString()
    .replaceAll("&", "&amp;")
    .replaceAll("<", "&lt;")
    .replaceAll(">", "&gt;")
    .replaceAll('"', "&quot;")
    .replaceAll("'", "&#039;");
}

function formatDate(iso) {
  return iso ? new Date(iso).toLocaleString() : "";
}

function sanitizeContentHtml(html) {
  if (!html) return "";
  let out = (html || "").toString();

  // Remove script blocks
  out = out.replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, "");

  // Demote any h1 to h2 to preserve single-H1 rule
  out = out.replace(/<\s*h1(\s[^>]*)?>/gi, "<h2$1>");
  out = out.replace(/<\s*\/\s*h1\s*>/gi, "</h2>");

  // Strip inline event handlers
  out = out.replace(/\son\w+\s*=\s*"[^"]*"/gi, "");
  out = out.replace(/\son\w+\s*=\s*'[^']*'/gi, "");
  out = out.replace(/\son\w+\s*=\s*[^ >]+/gi, "");

  // Neutralize javascript: URLs
  out = out.replace(/(href|src)\s*=\s*"javascript:[^"]*"/gi, '$1="#"');
  out = out.replace(/(href|src)\s*=\s*'javascript:[^']*'/gi, "$1='#'");

  return out;
}

// ---------- COMMENTS (localStorage for now) ----------
function currentCommentKey() {
  const key = (blogId || blogSlug || "").toString().trim();
  return key ? `comments:${key}` : "";
}

function getComments() {
  const key = currentCommentKey();
  if (!key) return [];
  try {
    return JSON.parse(localStorage.getItem(key) || "[]");
  } catch {
    return [];
  }
}

function saveComments(list) {
  const key = currentCommentKey();
  if (!key) return;
  localStorage.setItem(key, JSON.stringify(list));
}

function renderComments() {
  if (!els.commentsList) return;
  const list = getComments();

  if (!list.length) {
    els.commentsList.innerHTML =
      `<p style="color:#666;margin:8px 2px;">No comments yet. Be the first!</p>`;
    return;
  }

  els.commentsList.innerHTML = list
    .slice()
    .reverse()
    .map(
      (c) => `
      <div class="comment-card">
        <div class="c-top">
          <span class="c-name">${esc(c.name)}</span>
          <span class="c-date">${esc(formatDate(c.date))}</span>
        </div>
        <p style="margin:0 0 6px 0; color:#666; font-size: 13px;">
          ${esc(c.email)}
        </p>
        <p class="c-text">${esc(c.text).replace(/\n/g, "<br>")}</p>
      </div>
    `
    )
    .join("");
}

function setFieldError(inputEl, errEl, message) {
  if (!inputEl || !errEl) return;
  if (message) {
    inputEl.classList.add("input-error");
    errEl.textContent = message;
  } else {
    inputEl.classList.remove("input-error");
    errEl.textContent = "";
  }
}

function validateEmail(email) {
  // Simple but effective email check (no over-strict rules)
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function validateCommentForm() {
  const name = (els.cName?.value || "").trim();
  const email = (els.cEmail?.value || "").trim();
  const text = (els.cText?.value || "").trim();

  let ok = true;

  // Name
  if (!name) {
    setFieldError(els.cName, els.errName, "Name is required.");
    ok = false;
  } else if (name.length < 4) {
    setFieldError(els.cName, els.errName, "Name must be at least 4 characters.");
    ok = false;
  } else {
    setFieldError(els.cName, els.errName, "");
  }

  // Email
  if (!email) {
    setFieldError(els.cEmail, els.errEmail, "Email is required.");
    ok = false;
  } else if (!validateEmail(email)) {
    setFieldError(els.cEmail, els.errEmail, "Please enter a valid email address.");
    ok = false;
  } else {
    setFieldError(els.cEmail, els.errEmail, "");
  }

  // Comment
  if (!text) {
    setFieldError(els.cText, els.errText, "Comment is required.");
    ok = false;
  } else if (text.length < 3) {
    setFieldError(els.cText, els.errText, "Comment must be at least 3 characters.");
    ok = false;
  } else {
    setFieldError(els.cText, els.errText, "");
  }

  return { ok, name, email, text };
}

function hookComments() {
  if (!els.commentForm) return;

  // Live validation on input
  els.cName.addEventListener("input", () => validateCommentForm());
  els.cEmail.addEventListener("input", () => validateCommentForm());
  els.cText.addEventListener("input", () => validateCommentForm());

  els.commentForm.addEventListener("submit", (e) => {
    e.preventDefault();

    const key = currentCommentKey();
    if (!key) return;

    const v = validateCommentForm();
    if (!v.ok) {
      if (els.commentStatus) els.commentStatus.textContent = "Please fix the errors above.";
      return;
    }

    const list = getComments();
    list.push({
      name: v.name,
      email: v.email,
      text: v.text,
      date: new Date().toISOString(),
    });
    saveComments(list);

    // reset fields
    els.cName.value = "";
    els.cEmail.value = "";
    els.cText.value = "";
    validateCommentForm();

    if (els.commentStatus) els.commentStatus.textContent = "Comment posted!";
    renderComments();

    // Clear status after a moment
    setTimeout(() => {
      if (els.commentStatus) els.commentStatus.textContent = "";
    }, 1500);
  });
}

// ---------- BLOG + SIDEBAR ----------
async function loadBlogAndSidebar() {
  const el = els.content;

  const id = (blogId || "").toString().trim();
  const slug = blogSlug;

  if (!id && !slug) {
    el.innerHTML =
      "<h2>Missing blog identifier</h2><a href='index.php' class='back-btn'>Back to Blogs</a>";
    return;
  }

  try {
    let blog;

    if (id) {
      // Load by numeric id
      const res = await fetch(`${API_BASE}/posts/${encodeURIComponent(id)}`);
      if (res.status === 404) {
        el.innerHTML =
          "<h2>Blog not found</h2><a href='index.php' class='back-btn'>Back to Blogs</a>";
        return;
      }
      if (!res.ok) throw new Error("Failed to load post by id");

      const text = await res.text();
      try {
        blog = JSON.parse(text);
      } catch (err) {
        if (text && text.trim().startsWith("<")) {
          throw new Error("Blog API did not return JSON for this post. Check API base URL / proxy.");
        }
        throw err;
      }
    } else if (slug) {
      // Load by slug (pretty URL /blog/<slug> -> post.php?slug=<slug>)
      const res = await fetch(
        `${API_BASE}/posts/slug/${encodeURIComponent(slug)}`
      );
      if (res.status === 404) {
        el.innerHTML =
          "<h2>Blog not found</h2><a href='index.php' class='back-btn'>Back to Blogs</a>";
        return;
      }
      if (!res.ok) throw new Error("Failed to load post by slug");

      const text = await res.text();
      try {
        blog = JSON.parse(text);
      } catch (err) {
        if (text && text.trim().startsWith("<")) {
          throw new Error("Blog API did not return JSON for this post. Check API base URL / proxy.");
        }
        throw err;
      }
    } else {
      el.innerHTML =
        "<h2>Missing blog identifier</h2><a href='index.php' class='back-btn'>Back to Blogs</a>";
      return;
    }

    const img = normalizeImagePath(blog.post_image) || PLACEHOLDER_IMG;

    const dateText = formatDate(blog.post_date);
    const contentHtml = sanitizeContentHtml(blog.post_content || "");

    el.innerHTML = `
      <img src="${img}" class="blog-banner" onerror="this.src='${PLACEHOLDER_IMG}'" />
      <h1 class="blog-title">${esc(blog.post_title || "")}</h1>
      <p class="blog-date">${esc(dateText)}</p>
      <div class="blog-body">${contentHtml}</div>
      <a href="index.php" class="back-btn">Back to Blogs</a>
    `;

    // Load latest posts for sidebar
    await loadLatestSidebar(Number(blog.id));
  } catch (e) {
    el.innerHTML =
      "<h2>Error loading blog</h2><a href='index.php' class='back-btn'>Back to Blogs</a>";
    console.error(e);
  }
}

async function loadLatestSidebar(currentId) {
  if (!els.latest) return;

  try {
    const res = await fetch(`${API_BASE}/posts?status=published`);
    if (!res.ok) throw new Error("Failed to load latest posts");

    const text = await res.text();
    let blogs;
    try {
      blogs = JSON.parse(text);
    } catch (err) {
      if (text && text.trim().startsWith("<")) {
        throw new Error("Blog API did not return JSON for latest posts. Check API base URL / proxy.");
      }
      throw err;
    }

    // Sort newest first
    blogs.sort((a, b) => new Date(b.post_date || 0) - new Date(a.post_date || 0));

    // Exclude current post + take top 10 latest
    blogs = blogs.filter((b) => Number(b.id) !== Number(currentId)).slice(0, 10);

    els.latest.innerHTML = blogs
      .map((b) => {
        const img = normalizeImagePath(b.post_image) || PLACEHOLDER_IMG;
        const dateText = formatDate(b.post_date);
        const slug = (b.post_name || b.slug || b.id || "").toString().trim();

        return `
        <a class="latest-item" href="${BASE_PATH}post.php?id=${encodeURIComponent(
          b.id
        )}&slug=${encodeURIComponent(slug)}">
          <img class="latest-thumb" src="${img}" onerror="this.src='${PLACEHOLDER_IMG}'" />
          <div class="latest-meta">
            <p class="latest-title">${esc(b.post_title || "")}</p>
            <p class="latest-date">${esc(dateText)}</p>
          </div>
        </a>
      `;
      })
      .join("");

    if (!blogs.length) {
      els.latest.innerHTML = `<p style="color:#666;margin:6px 2px;">No other posts.</p>`;
    }
  } catch (e) {
    els.latest.innerHTML = `<p style="color:#b42318;margin:6px 2px;">Failed to load latest blogs.</p>`;
    console.error(e);
  }
}

// Init
hookComments();
renderComments();
loadBlogAndSidebar();
