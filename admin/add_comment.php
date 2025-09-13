<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../config.php';

if (empty($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $content = trim($_POST['content'] ?? '');

    if ($name !== '' && $content !== '') {
        $pdo = getPDO();
        $stmt = $pdo->prepare("INSERT INTO comments (name, email, content) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email ?: null, $content]);
    }
}
header('Location: dashboard.php');
exit;