const fs = require("fs/promises");
const path = require("path");

// Simple in-process mutex to avoid concurrent writes corrupting the JSON file.
let lock = Promise.resolve();

function withLock(fn) {
  lock = lock.then(fn, fn);
  return lock;
}

async function readJson(filePath) {
  const abs = path.resolve(filePath);
  const raw = await fs.readFile(abs, "utf-8");
  return JSON.parse(raw);
}

// Atomic write: write to temp file then rename
async function writeJson(filePath, data) {
  const abs = path.resolve(filePath);
  const dir = path.dirname(abs);
  const tmp = path.join(dir, `${path.basename(abs)}.${Date.now()}.tmp`);
  const json = JSON.stringify(data, null, 2);

  await fs.writeFile(tmp, json, "utf-8");
  await fs.rename(tmp, abs);
}

module.exports = { withLock, readJson, writeJson };
