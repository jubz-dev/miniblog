<?php
require_once __DIR__ . '/../db.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$content = trim($_POST['content'] ?? '');

$errors = [];
if ($name === '') $errors[] = 'Name is required';
if ($content === '') $errors[] = 'Comment content is required';
if (strlen($name) > 100) $errors[] = 'Name too long';
if (strlen($email) > 150) $errors[] = 'Email too long';
if (strlen($content) > 2000) $errors[] = 'Comment too long';

if ($errors) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

try {
    $pdo = getPDO();
    $stmt = $pdo->prepare("INSERT INTO comments (name, email, content) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email ?: null, $content]);

    $id = $pdo->lastInsertId();
    $created_at = date('Y-m-d H:i:s');

    // Return the formatted comment HTML to append client-side
    $html = '<div class="comment" data-id="'.(int)$id.'">';
    $html .= '<div class="d-flex justify-content-between"><strong>'.htmlspecialchars($name).'</strong>';
    $html .= '<span class="small-muted">'.date('Y-m-d H:i', strtotime($created_at)).'</span></div>';
    $html .= '<div class="mt-1">'.nl2br(htmlspecialchars($content)).'</div>';
    $html .= '</div>';

    echo json_encode(['success' => true, 'id' => $id, 'html' => $html]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'DB error: ' . $e->getMessage()]);
}
