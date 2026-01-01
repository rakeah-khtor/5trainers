<?php
// blog/admin/auth.php
session_start();
if (empty($_SESSION['blog_admin_logged_in'])) {
  header('Location: login.php');
  exit;
}
?>