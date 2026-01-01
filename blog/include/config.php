<?php
// Shared blog configuration for public pages and admin.
// Adjust these values on deployment if your API base changes.

// Base path for the blog section as seen by the browser.
// On production this is "/blog/". On localhost it will be the actual folder path
// such as "/5Trainers Institution/5trainers/blog/". We normalise so both
// /blog/index.php and /blog/admin/index.php resolve to the same base.
$script = $_SERVER['SCRIPT_NAME'] ?? '/blog/index.php';
$dir = rtrim(dirname($script), '/');
// Ensure we cut at "/blog" even if we're inside /blog/admin/...
$blogPos = stripos($dir, '/blog');
if ($blogPos !== false) {
    $blogBasePath = substr($dir, 0, $blogPos + strlen('/blog')) . '/';
} else {
    $blogBasePath = '/blog/';
}

// Base path for the Node API as seen by the browser / PHP.
// On production, Nginx will proxy "/api" -> Node.
// On localhost (WAMP), talk directly to Node on port 3001.
$host = $_SERVER['HTTP_HOST'] ?? '';
$apiBase = '/api';
if (stripos($host, 'localhost') !== false) {
    $apiBase = 'http://localhost:3001/api';
}

return [
    'basePath' => $blogBasePath,
    'apiBase'  => $apiBase,
];
