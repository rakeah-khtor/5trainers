const path = require("path");
const express = require("express");
const cors = require("cors");

const postsRouter = require("./routes/posts");
const uploadRouter = require("./routes/upload");
const config = require("./config");

const app = express();

// Config
const PORT = config.port;

// Middleware
if (config.allowedOrigins && config.allowedOrigins.length) {
  const allowed = new Set(config.allowedOrigins);
  app.use(
    cors({
      origin(origin, cb) {
        if (!origin) return cb(null, true);
        if (allowed.has(origin)) return cb(null, true);
        return cb(new Error("Not allowed by CORS"));
      },
    })
  );
} else {
  app.use(cors());
}
app.use(express.json({ limit: "10mb" }));
app.use(express.urlencoded({ extended: true }));

// Quiet Chrome DevTools request (harmless 404 otherwise)
app.get("/.well-known/appspecific/com.chrome.devtools.json", (req, res) => {
  res.status(204).end();
});

// API
app.get("/api/health", (req, res) => res.json({ ok: true }));
app.use("/api/posts", postsRouter);
app.use("/api/upload", uploadRouter);

// Default root route – this server is API-only
app.get("/", (req, res) => {
  res.json({
    ok: true,
    message: "Blog API is running",
    endpoints: ["/api/health", "/api/posts", "/api/upload/image"],
  });
});

// 404 for API
app.use("/api", (req, res) => {
  res.status(404).json({ error: "Not found" });
});

// Error handler
app.use((err, req, res, next) => {
  console.error("Server error:", err);
  res.status(500).json({ error: err.message || "Internal Server Error" });
});

app.listen(PORT, () => {
  console.log(`Server running at http://localhost:${PORT}`);
  console.log(`Health check: http://localhost:${PORT}/api/health`);
});
