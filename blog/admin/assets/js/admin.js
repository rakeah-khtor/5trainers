const BLOG_CONFIG = window.__BLOG_CONFIG || { apiBase: "/api", basePath: "/blog/" };
const API_BASE = (BLOG_CONFIG.apiBase || "/api").replace(/\/$/, "");
const BASE_PATH = (BLOG_CONFIG.basePath || "/blog/").replace(/([^\/])$/, "$1/");
const ADMIN_TOKEN = window.__ADMIN_TOKEN || '';
function authHeaders(extra = {}) {
  const h = { ...extra };
  if (ADMIN_TOKEN) h['Authorization'] = `Bearer ${ADMIN_TOKEN}`;
  return h;
}

// Admin Dashboard logic (CRUD + image upload)

// ---------- Modal must be declared BEFORE hook() runs ----------
const modal = {
  root: document.getElementById("postModal"),
  closeBtn: document.getElementById("modalCloseBtn"),
};

function openModal() {
  modal.root.classList.add("is-open");
  modal.root.setAttribute("aria-hidden", "false");
  document.body.classList.add("modal-open");
}

function closeModal() {
  modal.root.classList.remove("is-open");
  modal.root.setAttribute("aria-hidden", "true");
  document.body.classList.remove("modal-open");
}

// ----------------------------------------------------------------

const PLACEHOLDER_IMG = "../assets/images/placeholder.svg";

function normalizeImagePath(v) {
  if (!v) return "";
  const s = String(v).trim();
  if (!s) return "";
  // Existing JSON may contain assets/... whereas uploads may return /assets/...
  if (s.startsWith("/blog/")) return `${BASE_PATH}${s.replace(/^\/blog\//, "")}`;
  if (s.startsWith("/assets/")) return `${BASE_PATH}${s.replace(/^\/+/, "")}`;
  if (s.startsWith("/")) return s;
  if (s.startsWith("assets/")) return `${BASE_PATH}${s}`;
  if (s.startsWith("blog/assets/")) return `/${s}`;

  return s;
}

const els = {
  tbody: document.getElementById("postsTbody"),
  status: document.getElementById("statusBar"),
  search: document.getElementById("searchInput"),
  sort: document.getElementById("sortSelect"),
  statusFilter: document.getElementById("statusFilter"),
  newBtn: document.getElementById("newBtn"),

  formTitle: document.getElementById("formTitle"),
  form: document.getElementById("postForm"),
  postId: document.getElementById("postId"),
  title: document.getElementById("postTitle"),
  slug: document.getElementById("postSlug"),
  date: document.getElementById("postDate"),

  // Image URL/path (stored to DB)
  image: document.getElementById("postImage"),
  // File input (uploads into assets/images)
  imageFile: document.getElementById("postImageFile"),

  // CKEditor content field
  content: document.getElementById("postContent"),

  author: document.getElementById("postAuthor"),
  statusField: document.getElementById("postStatus"),

  saveBtn: document.getElementById("saveBtn"),
  resetBtn: document.getElementById("resetBtn"),
  deleteBtn: document.getElementById("deleteBtn"),
  preview: document.getElementById("imagePreview")
};

let postsCache = [];
let selectedId = null;

function showStatus(msg, type = "") {
  els.status.className = "status-bar" + (type ? ` ${type}` : "");
  els.status.textContent = msg || "";
}

function makeSlug(input) {
  return (input || "")
    .toString()
    .trim()
    .toLowerCase()
    .replace(/[^a-z0-9]+/g, "-")
    .replace(/^-+|-+$/g, "")
    .slice(0, 120);
}

function toDatetimeLocal(iso) {
  if (!iso) return "";
  const d = new Date(iso);
  if (isNaN(d.getTime())) return "";
  const pad = (n) => String(n).padStart(2, "0");
  return `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(d.getDate())}T${pad(d.getHours())}:${pad(d.getMinutes())}`;
}

function fromDatetimeLocal(v) {
  if (!v) return "";
  const d = new Date(v);
  return isNaN(d.getTime()) ? "" : d.toISOString();
}

async function api(url, opts = {}) {
  const { headers, ...rest } = opts;
  const res = await fetch(url, {
    ...rest,
    headers: authHeaders({
      "Content-Type": "application/json",
      ...(headers || {}),
    }),
  });
  const body = await res.json().catch(() => ({}));
  if (!res.ok) {
    const err = new Error(body.error || "Request failed");
    err.status = res.status;
    throw err;
  }
  return body;
}

function initRichEditor() {
  if (window.CKEDITOR && els.content) {
    CKEDITOR.replace("postContent", {
      height: 320,
      removePlugins: "elementspath",
      resize_enabled: true,
      toolbar: [
        { name: "basicstyles", items: ["Bold", "Italic", "Underline", "-", "RemoveFormat"] },
        { name: "paragraph", items: ["NumberedList", "BulletedList", "-", "Outdent", "Indent", "-", "Blockquote"] },
        { name: "links", items: ["Link", "Unlink"] },
        { name: "insert", items: ["Table"] },
        { name: "styles", items: ["Format"] },
        { name: "clipboard", items: ["Undo", "Redo"] }
      ],
      format_tags: "p;h2;h3;h4;h5;h6" // no H1 inside content
    });
  }
}

function getEditorHtml() {
  if (window.CKEDITOR && CKEDITOR.instances && CKEDITOR.instances.postContent) {
    return CKEDITOR.instances.postContent.getData() || "";
  }
  return (els.content && els.content.value) ? els.content.value : "";
}

function setEditorHtml(html) {
  const safe = (html || "").toString();
  if (window.CKEDITOR && CKEDITOR.instances && CKEDITOR.instances.postContent) {
    CKEDITOR.instances.postContent.setData(safe);
  } else if (els.content) {
    els.content.value = safe;
  }
}

function sanitizeHtml(html) {
  const container = document.createElement("div");
  container.innerHTML = html || "";

  const allowedTags = new Set([
    "p", "br", "strong", "b", "em", "i", "u",
    "a", "ul", "ol", "li",
    "h2", "h3", "h4", "h5", "h6",
    "blockquote", "code", "pre", "span"
  ]);

  const allowedAttrs = {
    a: new Set(["href", "title", "target", "rel"]),
    span: new Set([]),
    code: new Set([]),
    pre: new Set([])
  };

  function clean(node) {
    if (node.nodeType === Node.ELEMENT_NODE) {
      const tag = node.tagName.toLowerCase();

      if (tag === "h1") {
        const h2 = document.createElement("h2");
        while (node.firstChild) h2.appendChild(node.firstChild);
        node.replaceWith(h2);
        clean(h2);
        return;
      }

      if (!allowedTags.has(tag)) {
        const parent = node.parentNode;
        while (node.firstChild) parent.insertBefore(node.firstChild, node);
        parent.removeChild(node);
        return;
      }

      const allowedForTag = allowedAttrs[tag] || new Set();
      for (const attr of Array.from(node.attributes)) {
        const name = attr.name.toLowerCase();
        if (name.startsWith("on")) {
          node.removeAttribute(attr.name);
          continue;
        }
        if (name === "style") {
          node.removeAttribute(attr.name);
          continue;
        }
        if (!allowedForTag.has(name)) {
          node.removeAttribute(attr.name);
        }
      }
    }

    for (const child of Array.from(node.childNodes)) {
      clean(child);
    }
  }

  for (const child of Array.from(container.childNodes)) {
    clean(child);
  }

  return container.innerHTML.trim();
}

function escapeHtmlInline(str) {
  return (str || "")
    .toString()
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#039;");
}

// Uploads a file and returns an exact url like: assets/images/<auto>.jpg
async function uploadImageAndGetUrl(file) {
  const formData = new FormData();
  formData.append("image", file);

  const res = await fetch(`${API_BASE}/upload/image`, {
    method: "POST",
    headers: authHeaders(),
    body: formData
  });

  const body = await res.json().catch(() => ({}));
  if (!res.ok) throw new Error(body.error || "Image upload failed");
  if (!body.imageUrl) throw new Error("Upload succeeded but imageUrl missing");
  return body.imageUrl;
}

async function loadPosts() {
  showStatus("Loading...", "");
  const q = els.search.value.trim();
  const status = els.statusFilter ? els.statusFilter.value.trim() : "";

  const params = [];
  if (q) params.push(`q=${encodeURIComponent(q)}`);
  if (status) params.push(`status=${encodeURIComponent(status)}`);

  const url = params.length
    ? `${API_BASE}/posts?${params.join("&")}`
    : `${API_BASE}/posts`;
  postsCache = await api(url);
  renderTable();
  showStatus(`Loaded ${postsCache.length} post(s).`, "ok");
}

function sortPosts(list) {
  const mode = els.sort.value;
  const arr = [...list];
  if (mode === "oldest") {
    arr.sort((a, b) => new Date(a.post_date || 0) - new Date(b.post_date || 0));
  } else if (mode === "title") {
    arr.sort((a, b) => (a.post_title || "").localeCompare(b.post_title || ""));
  } else {
    arr.sort((a, b) => new Date(b.post_date || 0) - new Date(a.post_date || 0));
  }
  return arr;
}

function renderTable() {
  const list = sortPosts(postsCache);
  els.tbody.innerHTML = "";

  list.forEach((p) => {
    const tr = document.createElement("tr");
    const img = normalizeImagePath(p.post_image) || PLACEHOLDER_IMG;
    const dateText = p.post_date ? new Date(p.post_date).toLocaleString() : "";
    tr.innerHTML = `
      <td><img class="thumb" src="${img}" onerror="this.src='${PLACEHOLDER_IMG}'"/></td>
      <td>${escapeHtml(p.post_title || "")}</td>
      <td><code>${escapeHtml(p.post_name || "")}</code></td>
      <td>${escapeHtml(dateText)}</td>
      <td>
        <div class="row-actions">
          <button class="primary" data-action="edit" data-id="${p.id}">Edit</button>
          <button data-action="view" data-id="${p.id}">View</button>
          <button class="danger" data-action="del" data-id="${p.id}">Delete</button>
        </div>
      </td>
    `;
    els.tbody.appendChild(tr);
  });
}

function escapeHtml(str) {
  return (str || "")
    .toString()
    .replaceAll("&", "&amp;")
    .replaceAll("<", "&lt;")
    .replaceAll(">", "&gt;")
    .replaceAll('"', "&quot;")
    .replaceAll("'", "&#039;");
}

function resetForm() {
  selectedId = null;
  els.formTitle.textContent = "Create Post";
  els.postId.value = "";
  els.title.value = "";
  els.slug.value = "";
  els.date.value = "";
  els.image.value = "";
  if (els.author) els.author.value = "";
  if (els.statusField) els.statusField.value = "draft";
  els.deleteBtn.style.display = "none";
  els.preview.src = PLACEHOLDER_IMG;
  if (els.imageFile) els.imageFile.value = "";
  setEditorHtml("");
}

function fillForm(post) {
  selectedId = post.id;
  els.formTitle.textContent = `Edit Post #${post.id}`;
  els.postId.value = post.id;
  els.title.value = post.post_title || "";
  els.slug.value = post.post_name || "";
  els.date.value = toDatetimeLocal(post.post_date);
  els.image.value = post.post_image || "";
  els.deleteBtn.style.display = "inline-block";
  els.preview.src = normalizeImagePath(post.post_image) || PLACEHOLDER_IMG;
  if (els.imageFile) els.imageFile.value = "";
  if (els.author) els.author.value = post.author || "";
  if (els.statusField) {
    const status = (post.status || "").toString().trim().toLowerCase();
    els.statusField.value = status === "draft" || status === "published" ? status : "published";
  }
  setEditorHtml(post.post_content || "");
}

async function onTableClick(e) {
  const btn = e.target.closest("button");
  if (!btn) return;
  const id = Number(btn.dataset.id);
  const action = btn.dataset.action;

  if (action === "view") {
    const post = postsCache.find(p => Number(p.id) === id);
    if (post) {
      const slug = (post.post_name || post.slug || post.id || "").toString().trim();
      const url = `${BASE_PATH}post.php?id=${encodeURIComponent(post.id)}&slug=${encodeURIComponent(slug)}`;
      window.open(url, "_blank");
    }
    return;
  }

  if (action === "edit") {
    const post = postsCache.find(p => Number(p.id) === id);
    if (post) {
      fillForm(post);
      openModal();
      els.title.focus();
    }
    return;
  }

  if (action === "del") {
    if (!confirm("Delete this post? This cannot be undone.")) return;
    try {
      await api(`${API_BASE}/posts/${id}`, { method: "DELETE" });
      showStatus("Deleted.", "ok");
      await loadPosts();
      if (selectedId === id) resetForm();
    } catch (err) {
      showStatus(err.message, "err");
    }
  }
}

async function onSubmit(e) {
  e.preventDefault();

  const title = els.title.value.trim();
  if (!title) {
    showStatus("Title is required.", "err");
    return;
  }

  const slug = els.slug.value.trim() || makeSlug(title);

  // If user selected a main image file, upload first and store returned URL
  let img = els.image.value.trim();
  if (els.imageFile && els.imageFile.files && els.imageFile.files[0]) {
    try {
      showStatus("Uploading image...", "");
      const imageUrl = await uploadImageAndGetUrl(els.imageFile.files[0]);
      els.image.value = imageUrl;
      img = imageUrl;
      els.preview.src = imageUrl;
    } catch (err) {
      showStatus(err.message, "err");
      return;
    }
  }

  const payload = {
    post_title: title,
    post_name: slug,
    post_date: fromDatetimeLocal(els.date.value),
    post_image: img,
    author: els.author ? (els.author.value || "").trim() : "",
    status: els.statusField ? (els.statusField.value || "").trim() : "",
    post_content: sanitizeHtml(getEditorHtml())
  };

  try {
    if (!selectedId) {
      const created = await api(`${API_BASE}/posts`, { method: "POST", body: JSON.stringify(payload) });
      showStatus(`Created post #${created.id}`, "ok");
      await loadPosts();
      fillForm(created);
      closeModal(); // ✅ only close on success
    } else {
      const updated = await api(`${API_BASE}/posts/${selectedId}`, { method: "PUT", body: JSON.stringify(payload) });
      showStatus(`Updated post #${updated.id}`, "ok");
      await loadPosts();
      fillForm(updated);
      closeModal(); // ✅ only close on success
    }
  } catch (err) {
    showStatus(err.message, "err");
  }
}

async function onDelete() {
  if (!selectedId) return;
  if (!confirm("Delete this post? This cannot be undone.")) return;

  try {
    await api(`${API_BASE}/posts/${selectedId}`, { method: "DELETE" });
    showStatus("Deleted.", "ok");
    await loadPosts();
    resetForm();
    closeModal(); // optional: close after delete
  } catch (err) {
    showStatus(err.message, "err");
  }
}

function hook() {
  initRichEditor();
  els.tbody.addEventListener("click", onTableClick);
  els.form.addEventListener("submit", onSubmit);
  els.resetBtn.addEventListener("click", () => {
    resetForm();
    showStatus("");
  });
  els.deleteBtn.addEventListener("click", onDelete);

  els.search.addEventListener("input", debounce(loadPosts, 250));
  els.sort.addEventListener("change", renderTable);
  if (els.statusFilter) {
    els.statusFilter.addEventListener("change", loadPosts);
  }

  els.newBtn.addEventListener("click", () => {
    resetForm();
    openModal();
    els.title.focus();
  });

  els.title.addEventListener("input", () => {
    if (!selectedId && !els.slug.value.trim()) {
      els.slug.value = makeSlug(els.title.value);
    }
  });

  // Manual URL entry updates preview
  els.image.addEventListener("input", () => {
    const v = els.image.value.trim();
    els.preview.src = normalizeImagePath(v) || PLACEHOLDER_IMG;
  });

  // Local preview when file is chosen (before upload)
  if (els.imageFile) {
    els.imageFile.addEventListener("change", () => {
      const file = els.imageFile.files && els.imageFile.files[0];
      if (!file) return;
      const localUrl = URL.createObjectURL(file);
      els.preview.src = localUrl;
    });
  }

  // Close on X button
  modal.closeBtn.addEventListener("click", closeModal);

  // Close on overlay click
  modal.root.addEventListener("click", (e) => {
    if (e.target && e.target.hasAttribute("data-modal-close")) closeModal();
  });

  // Close on Escape
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && modal.root.classList.contains("is-open")) closeModal();
  });
}

function debounce(fn, ms) {
  let t;
  return (...args) => {
    clearTimeout(t);
    t = setTimeout(() => fn(...args), ms);
  };
}

// ✅ run after everything is declared
hook();
resetForm();
loadPosts().catch((err) => showStatus(err.message, "err"));
