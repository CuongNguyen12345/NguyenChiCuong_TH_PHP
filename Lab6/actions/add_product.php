<?php
require_once __DIR__ . '/../includes/db.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('../product.php');
}

$name = trim($_POST['name'] ?? '');
$description = trim($_POST['description'] ?? '');
$price = (float) ($_POST['price'] ?? 0);

if ($name === '' || $price < 0) {
    flash('error', 'Thông tin sản phẩm không hợp lệ.');
    redirect('../product.php');
}

try {
    $conn = db_connect();
    $userId = current_user_id();
    $stmt = $conn->prepare('INSERT INTO products (user_id, name, description, price, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())');
    $stmt->bind_param('issd', $userId, $name, $description, $price);
    $stmt->execute();
    flash('success', 'Đã thêm sản phẩm mới.');
} catch (Throwable $e) {
    flash('error', $e->getMessage());
}

redirect('../product.php');
