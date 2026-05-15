<?php
header('Content-Type: application/json; charset=utf-8');

$email = isset($_GET['email']) ? trim($_GET['email']) : '';
$email = filter_var($email, FILTER_SANITIZE_EMAIL);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        'status' => 'invalid',
        'message' => 'Dinh dang email khong hop le'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

require_once '../Bai3/config.php';
$conn = getConnection();

$stmt = $conn->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode([
        'status' => 'exists',
        'message' => 'Email da ton tai trong he thong'
    ], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode([
        'status' => 'valid',
        'message' => 'Email hop le va kha dung'
    ], JSON_UNESCAPED_UNICODE);
}

$stmt->close();
$conn->close();
?>
