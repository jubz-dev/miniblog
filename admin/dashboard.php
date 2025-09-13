<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../inc/admin_header.php';

$pdo = getPDO();
$stmt = $pdo->query("SELECT id, name, email, content, created_at FROM comments ORDER BY created_at DESC");
$comments = $stmt->fetchAll();
?>
<div class="row">
  <div class="col-md-10 offset-md-1">
    <h3>Comments Management</h3>

    <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title">Add comment as Admin</h5>
        <form method="post" action="add_comment.php">
          <div class="mb-2"><input name="name" class="form-control" placeholder="Name" required></div>
          <div class="mb-2"><input name="email" type="email" class="form-control" placeholder="Email (optional)"></div>
          <div class="mb-2"><textarea name="content" class="form-control" rows="3" placeholder="Comment" required></textarea></div>
          <button class="btn btn-success">Add Comment</button>
        </form>
      </div>
    </div>

    <div class="mb-3">
      <h5>All comments</h5>
      <?php if (!$comments): ?>
        <p class="text-muted">No comments</p>
      <?php else: ?>
        <?php foreach ($comments as $c): ?>
          <div class="card mb-2">
            <div class="card-body">
              <div class="d-flex justify-content-between">
                <div>
                  <strong><?php echo htmlspecialchars($c['name']); ?></strong>
                  <div class="small text-muted"><?php echo htmlspecialchars($c['email']); ?></div>
                </div>
                <div class="text-end">
                  <div class="small text-muted"><?php echo date('Y-m-d H:i', strtotime($c['created_at'])); ?></div>
                  <a href="edit_comment.php?id=<?php echo (int)$c['id']; ?>" class="btn btn-sm btn-outline-primary mt-2">Edit</a>
                  <a href="delete_comment.php?id=<?php echo (int)$c['id']; ?>" class="btn btn-sm btn-outline-danger mt-2">Delete</a>
                </div>
              </div>
              <div class="mt-2"><?php echo nl2br(htmlspecialchars($c['content'])); ?></div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</div>
</div>
</body>
</html>