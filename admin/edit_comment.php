<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../inc/admin_header.php';

$pdo = getPDO();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$id) {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $content = trim($_POST['content'] ?? '');
    if ($name !== '' && $content !== '') {
        $stmt = $pdo->prepare("UPDATE comments SET name = ?, email = ?, content = ?, updated_at = NOW() WHERE id = ?");
        $stmt->execute([$name, $email ?: null, $content, $id]);
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Name and content are required.';
    }
}

// fetch current
$stmt = $pdo->prepare("SELECT id, name, email, content FROM comments WHERE id = ?");
$stmt->execute([$id]);
$comment = $stmt->fetch();
if (!$comment) {
    header('Location: dashboard.php');
    exit;
}
?>
<div class="row">
  <div class="col-md-8 offset-md-2">
    <h4>Edit Comment</h4>
    <?php if (!empty($error)): ?><div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>
    <form method="post">
      <div class="mb-2"><input name="name" class="form-control" required value="<?php echo htmlspecialchars($comment['name']); ?>"></div>
      <div class="mb-2"><input name="email" type="email" class="form-control" value="<?php echo htmlspecialchars($comment['email']); ?>"></div>
      <div class="mb-2"><textarea name="content" class="form-control" rows="5" required><?php echo htmlspecialchars($comment['content']); ?></textarea></div>
      <button class="btn btn-primary">Save</button>
      <a href="dashboard.php" class="btn btn-link">Cancel</a>
    </form>
  </div>
</div>
</div>
</body>
</html>
