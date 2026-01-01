const BLOG_CONFIG = window.__BLOG_CONFIG || { apiBase: '/api', basePath: '/blog/' };
const API_BASE = (BLOG_CONFIG.apiBase || '/api').replace(/\/$/, '');
const BASE_PATH = (BLOG_CONFIG.basePath || '/blog/').replace(/([^\/])$/, '$1/');

const BLOGS_PER_PAGE = 6;

let allBlogs = [];
let visibleCount = 0;

const PLACEHOLDER_IMG = `${BASE_PATH}assets/images/placeholder.svg`;

function normalizeImagePath(v) {
  if (!v) return "";
  const s = String(v).trim();
  if (!s) return "";
  if (s.startsWith('/blog/')) return `${BASE_PATH}${s.replace(/^\/blog\//, '')}`;
  if (s.startsWith('/assets/')) return `${BASE_PATH}${s.replace(/^\/+/, '')}`;
  if (s.startsWith('/')) return s;
  if (s.startsWith('assets/')) return `${BASE_PATH}${s}`;
  if (s.startsWith('blog/assets/')) return `/${s}`;
  
  return s;
}

async function loadBlogs() {
  const container = document.getElementById("blogList");
  const loadMoreBtn = document.getElementById("loadMoreBtn");

  try {
    const res = await fetch(`${API_BASE}/posts`);
    if (!res.ok) throw new Error("Failed to load posts");

    allBlogs = await res.json();
    visibleCount = 0;
    container.innerHTML = "";

    renderNextBlogs();

    // Hide button if not needed
    toggleLoadMoreButton();
  } catch (e) {
    container.innerHTML = `
      <p style="padding:12px;">
        No blog found
      </p>
    `;
    console.error(e);
  }

  loadMoreBtn.addEventListener("click", renderNextBlogs);
}

function renderNextBlogs() {
  const container = document.getElementById("blogList");

  const nextBlogs = allBlogs.slice(
    visibleCount,
    visibleCount + BLOGS_PER_PAGE
  );

  nextBlogs.forEach(blog => {
    const img = normalizeImagePath(blog.post_image) || PLACEHOLDER_IMG;

    const dateText = blog.post_date
      ? new Date(blog.post_date).toLocaleString()
      : "";

    const card = document.createElement("div");
    card.className = "card";
    card.innerHTML = `
      <img src="${img}" class="card-img"
           onerror="this.src='${PLACEHOLDER_IMG}'" />
      <div class="card-body">
        <p class="card-date">${dateText}</p>
        <h3 class="card-title">${blog.post_title || ""}</h3>
        <a href="${BASE_PATH}${encodeURIComponent(blog.post_name || blog.slug || blog.id)}" class="read-more-btn">
          Read More →
        </a>
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

// Initial load
loadBlogs();
