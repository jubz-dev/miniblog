<?php
require_once __DIR__ . '/db.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $message = 'Both username and password are required.';
    } else {
        $pdo = getPDO();
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare('INSERT INTO admin_users (username, password_hash) VALUES (?, ?)');
        try {
            $stmt->execute([$username, $hash]);
            $message = 'Admin user created. Delete or protect this file after use.';
        } catch (PDOException $e) {
            $message = 'Error: ' . $e->getMessage();
        }
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Setup Admin</title></head>
<body>
  <h2>Setup Admin User (run once)</h2>
  <?php if ($message): ?>
    <p><?php echo htmlspecialchars($message); ?></p>
  <?php endif; ?>
  <form method="post">
    <div>
      <label>Username: <input name="username" required></label>
    </div>
    <div>
      <label>Password: <input name="password" type="password" required></label>
    </div>
    <button type="submit">Create Admin</button>
  </form>
</body>
</html>