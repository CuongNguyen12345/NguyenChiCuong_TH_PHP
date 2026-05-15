<?php
// Cấu hình kết nối database
define('DB_HOST', 'localhost:3306');
define('DB_USER', 'root');
define('DB_PASS', '123456');
define('DB_NAME', 'ajax_lab');

// Tạo kết nối
function getConnection() {
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }
        
        $conn->set_charset("utf8mb4");
        return $conn;
        
    } catch (Exception $e) {
        die("Lỗi: " . $e->getMessage());
    }
}
?>
