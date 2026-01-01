const BLOG_CONFIG = window.__BLOG_CONFIG || { apiBase: "/api", basePath: "/blog/" };
const API_BASE = (BLOG_CONFIG.apiBase || "/api").replace(/\/$/, "");
const BASE_PATH = (BLOG_CONFIG.basePath || "/blog/").replace(/([^\/])$/, "$1/");

const BLOGS_PER_PAGE = 6;

let allBlogs = [];
let visibleCount = 0;

const PLACEHOLDER_IMG = `${BASE_PATH}assets/images/placeholder.svg`;

function normalizeImagePath(v) {
  if (!v) return "";
  const s = String(v).trim();
  if (!s) return "";
  if (s.startsWith("/blog/")) return `${BASE_PATH}${s.replace(/^\/blog\//, "")}`;
  if (s.startsWith("/assets/")) return `${BASE_PATH}${s.replace(/^\/+/, "")}`;
  if (s.startsWith("/")) return s;
  if (s.startsWith("assets/")) return `${BASE_PATH}${s}`;
  if (s.startsWith("blog/assets/")) return `/${s}`;
  return s;
}

async function loadBlogs() {
  const container = document.getElementById("blogList");
  const loadMoreBtn = document.getElementById("loadMoreBtn");

  try {
    const res = await fetch(`${API_BASE}/posts?status=published`);
    if (!res.ok) throw new Error("Failed to load posts");

    const text = await res.text();
    let data;
    try {
      data = JSON.parse(text);
    } catch (err) {
      // If API accidentally returns HTML (e.g. PHP error page), avoid JSON parse crash
      if (text && text.trim().startsWith("<")) {
        throw new Error("Blog API did not return JSON. Check API base URL / proxy.");
      }
      throw err;
    }

    if (!Array.isArray(data)) {
      throw new Error("Unexpected blog API response");
    }

    allBlogs = data;
    visibleCount = 0;
    container.innerHTML = "";

    renderNextBlogs();
    toggleLoadMoreButton();
  } catch (e) {
    container.innerHTML = `
      <p style="padding:12px;">
        No blog found
      </p>
    `;
    console.error(e);
  }

  if (loadMoreBtn) {
    loadMoreBtn.addEventListener("click", renderNextBlogs);
  }
}

function renderNextBlogs() {
  const container = document.getElementById("blogList");
  if (!container) return;

  const nextBlogs = allBlogs.slice(
    visibleCount,
    visibleCount + BLOGS_PER_PAGE
  );

  nextBlogs.forEach((blog) => {
    const img = normalizeImagePath(blog.post_image) || PLACEHOLDER_IMG;
    const dateText = blog.post_date
      ? new Date(blog.post_date).toLocaleString()
      : "";
    const slug = (blog.post_name || blog.slug || blog.id || "").toString().trim();

    const href = `${BASE_PATH}post.php?id=${encodeURIComponent(
      blog.id
    )}&slug=${encodeURIComponent(slug)}`;

    const card = document.createElement("a");
    card.className = "card";
    card.href = href;
    card.innerHTML = `
      <img src="${img}" class="card-img"
           onerror="this.src='${PLACEHOLDER_IMG}'" />
      <div class="card-body">
        <p class="card-date">${dateText}</p>
        <h3 class="card-title">${blog.post_title || ""}</h3>
      </div>
    `;

    container.appendChild(card);
  });

  visibleCount += nextBlogs.length;
  toggleLoadMoreButton();
}

function toggleLoadMoreButton() {
  const loadMoreBtn = document.getElementById("loadMoreBtn");
  if (!loadMoreBtn) return;

  loadMoreBtn.style.display =
    visibleCount < allBlogs.length ? "inline-block" : "none";
}

loadBlogs();
