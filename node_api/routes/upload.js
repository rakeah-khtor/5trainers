const express = require("express");
const multer = require("multer");
const path = require("path");
const fs = require("fs");

const router = express.Router();
const { requireAdmin } = require("../middleware/auth");
const config = require("../config");

// Upload directory on disk (default: this project's blog/assets/images)
const UPLOAD_DIR = config.uploadDir;

fs.mkdirSync(UPLOAD_DIR, { recursive: true });

function fileFilter(req, file, cb) {
  const allowed = ["image/png", "image/jpeg", "image/jpg", "image/webp"];
  if (!allowed.includes(file.mimetype)) {
    return cb(new Error("Only PNG/JPG/JPEG/WEBP images are allowed"), false);
  }
  cb(null, true);
}

function autoImageName(originalName) {
  const ext = path.extname(originalName || "").toLowerCase();
  const safeExt = [".png", ".jpg", ".jpeg"].includes(ext) ? ext : ".jpg";
  const unique = `${Date.now()}-${Math.random().toString(16).slice(2)}`;
  return `blog-${unique}${safeExt}`;
}

const storage = multer.diskStorage({
  destination: (req, file, cb) => cb(null, UPLOAD_DIR),
  filename: (req, file, cb) => cb(null, autoImageName(file.originalname)),
});

const upload = multer({
  storage,
  fileFilter,
  limits: { fileSize: 5 * 1024 * 1024 }, // 5MB
});

// POST /api/upload/image  (multipart/form-data with field name: image)
router.post("/image", requireAdmin, upload.single("image"), (req, res) => {
  if (!req.file) return res.status(400).json({ error: "No image uploaded" });

  // Public URL base returned to the PHP blog/admin
  const publicBase = config.publicUploadBase.replace(/\/$/, "");
  const imageUrl = `${publicBase}/${req.file.filename}`;
  res.json({ ok: true, imageUrl });
});

module.exports = router;
