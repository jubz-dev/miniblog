<?php
$base = defined('BASE_URL') ? BASE_URL : '';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Miniblog — One Page Blog</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo $base; ?>assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="<?php echo $base; ?>index.php">Blogify</a>
    <div class="ms-auto">
      <a class="btn btn-outline-primary btn-sm" href="<?php echo $base; ?>admin/login.php">Admin</a>
    </div>
  </div>
</nav>
<div class="container py-4">