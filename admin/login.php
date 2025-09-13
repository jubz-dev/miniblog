<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../config.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $message = 'Username and password required.';
    } else {
        $pdo = getPDO();
        $stmt = $pdo->prepare('SELECT id, username, password_hash FROM admin_users WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            // success
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_username'] = $user['username'];
            header('Location: dashboard.php');
            exit;
        } else {
            $message = 'Invalid credentials.';
        }
    }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Admin Login - Miniblog</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="col-md-6 offset-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Admin Login</h5>
          <?php if ($message): ?><div class="alert alert-danger small"><?php echo htmlspecialchars($message); ?></div><?php endif; ?>
          <form method="post">
            <div class="mb-2">
              <label class="form-label">Username</label>
              <input name="username" class="form-control" required>
            </div>
            <div class="mb-2">
              <label class="form-label">Password</label>
              <input name="password" class="form-control" type="password" required>
            </div>
            <button class="btn btn-primary" type="submit">Login</button>
            <a href="../index.php" class="btn btn-link">Back to site</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>