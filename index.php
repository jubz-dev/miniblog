<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/inc/header.php';
?>
<div class="row">
  <div class="col-md-8 offset-md-2">
    <div class="blog-post">
      <h1>Welcome to Miniblog</h1>
      <p class="lead">A minimal one-page blog for demo purposes. This single page shows a blog post and a comment area.</p>
      <hr>
      <p>This is sample static content for the blog post.</p>
    </div>

    <div id="comments-section" class="mt-4">
      <h4>Comments</h4>
      <p>Loading comments…</p>
    </div>

    <div id="add-comment" class="mt-4">
      <h5>Add a comment</h5>
      <p>Comment form.</p>
    </div>
  </div>
</div>
<?php require_once __DIR__ . '/inc/footer.php'; ?>
