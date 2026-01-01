const path = require("path");
require("dotenv").config();

function normalizeBasePath(v, fallback) {
  const raw = (v || fallback || "").toString().trim();
  if (!raw) return "/";
  // ensure starts with /
  let out = raw.startsWith("/") ? raw : `/${raw}`;
  // ensure ends with /
  if (!out.endsWith("/")) out += "/";
  return out;
}

const PORT = process.env.PORT || 3001;

const PUBLIC_SITE_BASE = (process.env.PUBLIC_SITE_BASE || "https://www.5trainers.com").replace(/\/$/, "");
const BLOG_BASEPATH = normalizeBasePath(process.env.BLOG_BASEPATH, "/blog/");

// Upload destination: default to this project's blog/assets/images
const UPLOAD_DIR =
  process.env.UPLOAD_DIR ||
  path.join(__dirname, "..", "blog", "assets", "images");

// Public URL base returned after upload
const PUBLIC_UPLOAD_BASE = (process.env.PUBLIC_UPLOAD_BASE || "/blog/assets/images").replace(/\/$/, "");

const ADMIN_TOKEN = (process.env.ADMIN_TOKEN || "").toString().trim();

const ALLOWED_ORIGINS = (process.env.ALLOWED_ORIGINS || "")
  .split(",")
  .map((s) => s.trim())
  .filter(Boolean);

module.exports = {
  port: PORT,
  publicSiteBase: PUBLIC_SITE_BASE,
  blogBasePath: BLOG_BASEPATH,
  uploadDir: UPLOAD_DIR,
  publicUploadBase: PUBLIC_UPLOAD_BASE,
  adminToken: ADMIN_TOKEN,
  allowedOrigins: ALLOWED_ORIGINS,
};

