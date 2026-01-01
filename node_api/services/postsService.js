const postsRepo = require("../repositories/postsRepository");
const config = require("../config");

function normalizeString(v) {
  return (v ?? "").toString().trim();
}

function makeSlug(input) {
  return normalizeString(input)
    .toLowerCase()
    .replace(/[^a-z0-9]+/g, "-")
    .replace(/^-+|-+$/g, "")
    .slice(0, 120);
}

function nowIso() {
  return new Date().toISOString();
}

function ensureGuid(post) {
  const siteBase = config.publicSiteBase;
  const blogBasePath = config.blogBasePath;
  const slug = normalizeString(post.post_name || post.slug || "");
  if (post.guid && normalizeString(post.guid)) return post.guid;
  if (slug) return `${siteBase}${blogBasePath}${encodeURIComponent(slug)}`;
  // fallback
  return `${siteBase}${blogBasePath}?id=${encodeURIComponent(post.id || "")}`;
}

function validateInput(input, { partial = false } = {}) {
  const out = {};
  const title = input.post_title;
  const name = input.post_name;

  if (!partial || title !== undefined) {
    out.post_title = normalizeString(title);
    if (!out.post_title) {
      const err = new Error("post_title is required");
      err.code = "VALIDATION";
      throw err;
    }
  }

  if (!partial || name !== undefined) {
    out.post_name = makeSlug(name || out.post_title || input.post_title || "");
    if (!out.post_name) {
      const err = new Error("post_name (slug) is required");
      err.code = "VALIDATION";
      throw err;
    }
  }

  if (!partial || input.post_content !== undefined) {
    out.post_content = (input.post_content ?? "").toString();
  }

  if (!partial || input.post_date !== undefined) {
    // accept either ISO or legacy "YYYY-MM-DD HH:mm:ss" strings; store as ISO
    const raw = normalizeString(input.post_date);
    if (!raw) {
      out.post_date = nowIso();
    } else {
      const d = new Date(raw.replace(" ", "T"));
      out.post_date = isNaN(d.getTime()) ? nowIso() : d.toISOString();
    }
  }

  if (!partial || input.guid !== undefined) {
    out.guid = normalizeString(input.guid);
  }

  if (!partial || input.post_image !== undefined) {
    out.post_image = normalizeString(input.post_image);
  }

  if (!partial || input.status !== undefined) {
    const rawStatus = normalizeString(input.status).toLowerCase();
    if (rawStatus && rawStatus !== "draft" && rawStatus !== "published") {
      const err = new Error("status must be draft or published");
      err.code = "VALIDATION";
      throw err;
    }
    if (rawStatus) out.status = rawStatus;
  }

  return out;
}

async function listPosts({ q = "", status } = {}) {
  const posts = await postsRepo.list();
  const qq = normalizeString(q).toLowerCase();
  const targetStatus = normalizeString(status).toLowerCase();

  const filtered = posts.filter((p) => {
    if (qq) {
      const hay = `${p.post_title || ""} ${p.post_name || ""} ${p.post_content || ""}`.toLowerCase();
      if (!hay.includes(qq)) return false;
    }

    if (targetStatus) {
      const s = normalizeString(p.status).toLowerCase() || "published";
      if (s !== targetStatus) return false;
    }

    return true;
  });

  // Sort newest first by date
  filtered.sort((a, b) => {
    const da = new Date(a.post_date || 0).getTime();
    const db = new Date(b.post_date || 0).getTime();
    return db - da;
  });

  return filtered;
}

async function getPost(id) {
  const posts = await postsRepo.list();
  return posts.find(p => Number(p.id) === Number(id)) || null;
}

async function getPostBySlug(slug) {
  const s = makeSlug(slug || "");
  if (!s) return null;
  const posts = await postsRepo.list();
  return posts.find(p => (p.post_name || "") === s) || null;
}

async function createPost(input) {
  const posts = await postsRepo.list();
  const cleaned = validateInput(input, { partial: false });

  // enforce unique slug
  if (posts.some(p => (p.post_name || "") === cleaned.post_name)) {
    const err = new Error("post_name already exists (must be unique)");
    err.code = "CONFLICT";
    throw err;
  }

  const maxId = posts.reduce((m, p) => Math.max(m, Number(p.id) || 0), 0);
  const newPost = {
    id: maxId + 1,
    post_name: cleaned.post_name,
    post_title: cleaned.post_title,
    post_content: cleaned.post_content || "",
    post_date: cleaned.post_date || nowIso(),
    guid: cleaned.guid || "",
    post_image: cleaned.post_image || "",
    status: cleaned.status || "published"
  };

  newPost.guid = ensureGuid(newPost);

  posts.push(newPost);
  await postsRepo.saveAll(posts);
  return newPost;
}

async function updatePost(id, input) {
  const posts = await postsRepo.list();
  const idx = posts.findIndex(p => Number(p.id) === Number(id));
  if (idx === -1) return null;

  const cleaned = validateInput(input, { partial: true });
  const current = posts[idx];

  // if slug changes, enforce uniqueness
  if (cleaned.post_name && cleaned.post_name !== current.post_name) {
    if (posts.some(p => Number(p.id) !== Number(id) && (p.post_name || "") === cleaned.post_name)) {
      const err = new Error("post_name already exists (must be unique)");
      err.code = "CONFLICT";
      throw err;
    }
  }

  const updated = { ...current, ...cleaned };
  updated.guid = ensureGuid(updated);

  posts[idx] = updated;
  await postsRepo.saveAll(posts);
  return updated;
}

async function deletePost(id) {
  const posts = await postsRepo.list();
  const next = posts.filter(p => Number(p.id) !== Number(id));
  if (next.length === posts.length) return false;
  await postsRepo.saveAll(next);
  return true;
}

module.exports = { getPostBySlug, listPosts, getPost, createPost, updatePost, deletePost, makeSlug };
