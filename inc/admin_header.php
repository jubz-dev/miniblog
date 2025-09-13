<?php
require_once __DIR__ . '/../config.php';
if (empty($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Miniblog Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand bg-light">
  <div class="container">
    <a class="navbar-brand" href="dashboard.php">Miniblog Admin</a>
    <div class="ms-auto">
      <span class="me-2 small text-muted">Signed in as <?php echo htmlspecialchars($_SESSION['admin_username']); ?></span>
      <a class="btn btn-sm btn-outline-secondary" href="logout.php">Logout</a>
    </div>
  </div>
</nav>
<div class="container py-4">
