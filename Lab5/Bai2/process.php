<?php
// Nhận dữ liệu từ GET hoặc POST
$name = "";
$method = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $method = "POST";
} else {
    $name = isset($_GET['name']) ? $_GET['name'] : '';
    $method = "GET";
}

// Làm sạch dữ liệu
$name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');

// Trả về kết quả
echo "<h3>Kết quả xử lý:</h3>";
echo "<p><strong>Phương thức:</strong> " . $method . "</p>";
echo "<p><strong>Họ tên nhận được:</strong> " . $name . "</p>";
echo "<p><strong>Thời gian xử lý:</strong> " . date('H:i:s d/m/Y') . "</p>";
?>
