const path = require("path");
const { withLock, readJson, writeJson } = require("../utils/fileStore");

const DATA_FILE = path.join(__dirname, "..", "data", "blogData.json");

async function list() {
  return withLock(async () => {
    const posts = await readJson(DATA_FILE);
    return Array.isArray(posts) ? posts : [];
  });
}

async function saveAll(posts) {
  return withLock(async () => {
    await writeJson(DATA_FILE, posts);
    return true;
  });
}

module.exports = { list, saveAll, DATA_FILE };
