<?php
// File xử lý đăng ký (demo)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    
    // Làm sạch dữ liệu
    $username = htmlspecialchars(trim($username), ENT_QUOTES, 'UTF-8');
    
    if (empty($username) || empty($password)) {
        echo "Vui lòng điền đầy đủ thông tin!";
        exit;
    }
    
    // Trong thực tế, bạn sẽ lưu vào database
    // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    // INSERT INTO members...
    
    echo "Đăng ký thành công! Tên đăng nhập: " . $username;
} else {
    echo "Phương thức không hợp lệ!";
}
?>
