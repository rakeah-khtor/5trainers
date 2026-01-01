const express = require("express");
const router = express.Router();

const postsService = require("../services/postsService");
const { requireAdmin } = require("../middleware/auth");

// GET /api/posts?q=search&status=published|draft
router.get("/", async (req, res) => {
  try {
    const q = (req.query.q || "").toString().trim();
    const status = (req.query.status || "").toString().trim();
    const posts = await postsService.listPosts({ q, status });
    res.json(posts);
  } catch (err) {
    console.error(err);
    res.status(500).json({ error: "Failed to list posts" });
  }
});

// GET /api/posts/:id

// GET /api/posts/slug/:slug
router.get("/slug/:slug", async (req, res) => {
  try {
    const slug = (req.params.slug || "").toString().trim();
    const post = await postsService.getPostBySlug(slug);
    if (!post) return res.status(404).json({ ok: false, message: "Post not found" });
    res.json(post);
  } catch (err) {
    console.error(err);
    res.status(500).json({ ok: false, message: "Server error" });
  }
});

router.get("/:id", async (req, res) => {
  try {
    const id = Number(req.params.id);
    const post = await postsService.getPost(id);
    if (!post) return res.status(404).json({ error: "Post not found" });
    res.json(post);
  } catch (err) {
    console.error(err);
    res.status(500).json({ error: "Failed to get post" });
  }
});

// POST /api/posts
router.post("/", requireAdmin, async (req, res) => {
  try {
    const created = await postsService.createPost(req.body || {});
    res.status(201).json(created);
  } catch (err) {
    if (err.code === "VALIDATION") return res.status(400).json({ error: err.message });
    if (err.code === "CONFLICT") return res.status(409).json({ error: err.message });
    console.error(err);
    res.status(500).json({ error: "Failed to create post" });
  }
});

// PUT /api/posts/:id
router.put("/:id", requireAdmin, async (req, res) => {
  try {
    const id = Number(req.params.id);
    const updated = await postsService.updatePost(id, req.body || {});
    if (!updated) return res.status(404).json({ error: "Post not found" });
    res.json(updated);
  } catch (err) {
    if (err.code === "VALIDATION") return res.status(400).json({ error: err.message });
    if (err.code === "CONFLICT") return res.status(409).json({ error: err.message });
    console.error(err);
    res.status(500).json({ error: "Failed to update post" });
  }
});

// DELETE /api/posts/:id
router.delete("/:id", requireAdmin, async (req, res) => {
  try {
    const id = Number(req.params.id);
    const removed = await postsService.deletePost(id);
    if (!removed) return res.status(404).json({ error: "Post not found" });
    res.json({ ok: true });
  } catch (err) {
    console.error(err);
    res.status(500).json({ error: "Failed to delete post" });
  }
});

module.exports = router;
