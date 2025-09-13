<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../config.php';

if (empty($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id) {
    $pdo = getPDO();
    $stmt = $pdo->prepare("DELETE FROM comments WHERE id = ?");
    $stmt->execute([$id]);
}

header('Location: dashboard.php');
exit;