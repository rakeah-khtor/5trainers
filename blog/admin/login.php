<?php
// blog/admin/login.php
session_start();
$cfg = require __DIR__ . '/config.php';
$error = '';
$csrf = '';
if (empty($_SESSION['blog_admin_csrf'])) {
  $_SESSION['blog_admin_csrf'] = bin2hex(random_bytes(16));
}
$csrf = $_SESSION['blog_admin_csrf'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $token = isset($_POST['csrf']) ? $_POST['csrf'] : '';
  if (!hash_equals($_SESSION['blog_admin_csrf'] ?? '', $token)) {
    $error = 'Invalid session token, please try again.';
  } else {
    $u = isset($_POST['username']) ? trim($_POST['username']) : '';
    $p = isset($_POST['password']) ? (string)$_POST['password'] : '';

    $usernameOk = hash_equals($cfg['username'], $u);

    $passwordOk = false;
    if (is_string($cfg['password_hash']) && $cfg['password_hash'] !== '') {
      if (function_exists('password_verify')) {
        $passwordOk = password_verify($p, $cfg['password_hash']);
      }
      if (!$passwordOk && hash_equals($cfg['password_hash'], $p)) {
        $passwordOk = true;
      }
    }

    if ($usernameOk && $passwordOk) {
      $_SESSION['blog_admin_logged_in'] = true;
      header('Location: index.php');
      exit;
    }

    $error = 'Invalid username or password';
  }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blog Admin Login</title>
  <link rel="stylesheet" href="assets/css/admin.css">
  <style>
    body{
      margin:0;
      font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      background:#f3f4f6;
    }
    .login-wrap{
      max-width:420px;
      margin:72px auto;
      padding:28px 24px 24px;
      border:1px solid #e5e7eb;
      border-radius:16px;
      background:#ffffff;
      box-shadow:0 10px 30px rgba(15,23,42,0.08);
    }
    .login-wrap h1{
      margin:0 0 4px;
      font-size:24px;
    }
    .login-wrap p.subtitle{
      margin:0 0 16px;
      font-size:13px;
      color:#6b7280;
    }
    .login-wrap label{
      display:block;
      margin:14px 0 6px;
      font-weight:600;
      font-size:14px;
      color:#111827;
    }
    .login-wrap input{
      width:100%;
      padding:10px 12px;
      border:1px solid #d1d5db;
      border-radius:10px;
      font-size:14px;
      transition:border-color .15s, box-shadow .15s;
      box-sizing:border-box;
    }
    .login-wrap input:focus{
      outline:none;
      border-color:#111827;
      box-shadow:0 0 0 1px #1118271a;
    }
    .login-wrap button[type="submit"]{
      margin-top:18px;
      width:100%;
      padding:10px 12px;
      border:0;
      border-radius:10px;
      cursor:pointer;
      font-weight:600;
      font-size:14px;
      background:#111827;
      color:#ffffff;
      transition:background .15s, transform .05s;
    }
    .login-wrap button[type="submit"]:hover{
      background:#020617;
    }
    .login-wrap button[type="submit"]:active{
      transform:translateY(1px);
    }
    .err{
      color:#b91c1c;
      margin:8px 0 0;
      font-size:13px;
    }
    .password-field{
      position:relative;
    }
    .password-field input{
      padding-right:32px;
    }
    .password-toggle{
      position:absolute;
      right:10px;
      top:50%;
      transform:translateY(-50%);
      border:none;
      background:transparent;
      cursor:pointer;
      font-size:14px;
      padding:0 4px;
      color:#6b7280;
    }
    .password-toggle:focus{
      outline:none;
    }
  </style>
</head>
<body>
  <div class="login-wrap">
    <h1>Admin Login</h1>
    <p class="subtitle">Sign in to manage blog posts</p>
    <?php if ($error): ?>
      <div class="err"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <form method="post">
      <input type="hidden" name="csrf" value="<?php echo htmlspecialchars($csrf, ENT_QUOTES); ?>">
      <label>Username</label>
      <input name="username" autocomplete="username" required>
      <label>Password</label>
      <div class="password-field">
        <input id="passwordInput" name="password" type="password" autocomplete="current-password" required>
        <button type="button" id="passwordToggle" class="password-toggle" aria-label="Show password">👁</button>
      </div>
      <button type="submit">Sign in</button>
    </form>
    <!-- <p style="margin-top:14px;font-size:13px;opacity:.8;">
      Default credentials are set in <code>blog/admin/config.php</code>.
    </p> -->
  </div>
  <script>
    (function(){
      var input = document.getElementById('passwordInput');
      var btn = document.getElementById('passwordToggle');
      if (!input || !btn) return;
      btn.addEventListener('click', function(){
        var isPw = input.type === 'password';
        input.type = isPw ? 'text' : 'password';
        btn.setAttribute('aria-label', isPw ? 'Hide password' : 'Show password');
      });
    })();
  </script>
</body>
</html>

