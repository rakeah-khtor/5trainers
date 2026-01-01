const config = require("../config");
const ADMIN_TOKEN = config.adminToken;

function extractToken(req) {
  const auth = (req.get("Authorization") || "").toString();
  if (auth.toLowerCase().startsWith("bearer ")) return auth.slice(7).trim();
  const x = (req.get("X-Admin-Token") || "").toString().trim();
  return x;
}

function requireAdmin(req, res, next) {
  // Dev-friendly: if no ADMIN_TOKEN is configured, allow all admin calls
  // instead of failing with 500. For production, set ADMIN_TOKEN in .env.
  if (!ADMIN_TOKEN) {
    return next();
  }

  const token = extractToken(req);
  if (token && token === ADMIN_TOKEN) return next();
  return res.status(401).json({ ok: false, message: "Unauthorized" });
}

module.exports = { requireAdmin };
