<?php
require_once __DIR__ . '/../includes/db.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('../product.php');
}

$id = (int) ($_POST['id'] ?? 0);
$name = trim($_POST['name'] ?? '');
$description = trim($_POST['description'] ?? '');
$price = (float) ($_POST['price'] ?? 0);

if ($id <= 0 || $name === '' || $price < 0) {
    flash('error', 'Thông tin cập nhật không hợp lệ.');
    redirect('../product.php');
}

try {
    $conn = db_connect();
    $userId = current_user_id();
    $stmt = $conn->prepare('UPDATE products SET name = ?, description = ?, price = ?, updated_at = NOW() WHERE id = ? AND user_id = ?');
    $stmt->bind_param('ssdii', $name, $description, $price, $id, $userId);
    $stmt->execute();

    if ($stmt->affected_rows >= 0) {
        flash('success', 'Đã cập nhật sản phẩm.');
    }
} catch (Throwable $e) {
    flash('error', $e->getMessage());
}

redirect('../product.php');
