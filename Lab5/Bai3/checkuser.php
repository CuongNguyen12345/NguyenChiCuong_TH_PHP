<?php
require_once 'config.php';

// Nhận dữ liệu từ AJAX
$user = isset($_GET['user']) ? $_GET['user'] : '';

// Làm sạch dữ liệu đầu vào
$user = trim($user);

if (empty($user)) {
    echo '<span class="unavailable">Vui lòng nhập tên đăng nhập</span>';
    exit;
}

// Kết nối database
$conn = getConnection();

// Sử dụng Prepared Statement để chống SQL Injection
$stmt = $conn->prepare("SELECT * FROM members WHERE user = ?");
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();

// Kiểm tra số dòng trả về
if ($result->num_rows > 0) {
    echo '<span class="unavailable">✗ Tên đăng nhập đã tồn tại</span>';
} else {
    echo '<span class="available">✓ Tên đăng nhập khả dụng</span>';
}

// Đóng kết nối
$stmt->close();
$conn->close();
?>
