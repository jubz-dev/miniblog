<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/inc/header.php';

$pdo = getPDO();

$stmt = $pdo->query("SELECT id, name, email, content, created_at FROM comments ORDER BY created_at DESC LIMIT 200");
$comments = $stmt->fetchAll();
?>
<div class="row">
  <div class="col-md-8 offset-md-2">
    <div class="blog-post">
      <h1>Miniblog: Minimal One-page Blog</h1>
      <p class="lead">This blog demonstrates a simple comments system. Public users can add comments; admins can add/edit/delete.</p>
      <hr>
      <p>Here is the blog post content.</p>
    </div>

    <div id="comments-section" class="mt-4">
      <h4>Comments <small class="text-muted">(<span id="comments-count"><?php echo count($comments); ?></span>)</small></h4>

      <div id="comments-list">
        <?php if (count($comments) === 0): ?>
          <p class="text-muted">No comments yet — be the first to comment!</p>
        <?php else: ?>
          <?php foreach($comments as $c): ?>
            <div class="comment" data-id="<?php echo (int)$c['id']; ?>">
              <div class="d-flex justify-content-between">
                <strong><?php echo htmlspecialchars($c['name']); ?></strong>
                <span class="small-muted"><?php echo date('Y-m-d H:i', strtotime($c['created_at'])); ?></span>
              </div>
              <div class="mt-1"><?php echo nl2br(htmlspecialchars($c['content'])); ?></div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>

    <div id="add-comment" class="mt-4">
      <h5>Add a comment</h5>
      <form id="comment-form" method="post" action="<?php echo (defined('BASE_URL') ? BASE_URL : '') . 'api/add_comment.php'; ?>">
        <div class="mb-2">
          <label class="form-label">Name <small class="text-muted">(required)</small></label>
          <input type="text" name="name" class="form-control" required maxlength="100">
        </div>
        <div class="mb-2">
          <label class="form-label">Email <small class="text-muted">(optional)</small></label>
          <input type="email" name="email" class="form-control" maxlength="150">
        </div>
        <div class="mb-2">
          <label class="form-label">Comment</label>
          <textarea name="content" class="form-control" rows="4" required maxlength="2000"></textarea>
        </div>
        <button class="btn btn-primary" id="submit-comment" type="submit">Post Comment</button>
        <div id="comment-result" class="mt-2"></div>
      </form>
    </div>

  </div>
</div>

<?php require_once __DIR__ . '/inc/footer.php'; ?>