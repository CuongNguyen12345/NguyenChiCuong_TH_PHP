<?php
require_once __DIR__ . '/../includes/db.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('../product.php');
}

$id = (int) ($_POST['id'] ?? 0);

if ($id <= 0) {
    flash('error', 'Sản phẩm không hợp lệ.');
    redirect('../product.php');
}

try {
    $conn = db_connect();
    $userId = current_user_id();
    $stmt = $conn->prepare('DELETE FROM products WHERE id = ? AND user_id = ?');
    $stmt->bind_param('ii', $id, $userId);
    $stmt->execute();
    flash('success', 'Đã xóa sản phẩm.');
} catch (Throwable $e) {
    flash('error', $e->getMessage());
}

redirect('../product.php');
