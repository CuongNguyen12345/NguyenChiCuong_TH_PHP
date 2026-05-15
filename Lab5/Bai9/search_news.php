<?php
session_start();
require_once 'config.php';

header('Content-Type: application/json; charset=utf-8');

if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) ||
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
    http_response_code(403);
    echo json_encode([
        'error' => true,
        'message' => 'Request khong hop le'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$requestToken = isset($_SERVER['HTTP_X_CSRF_TOKEN']) ? $_SERVER['HTTP_X_CSRF_TOKEN'] : (isset($_GET['token']) ? $_GET['token'] : '');
if (!verifyToken($requestToken)) {
    http_response_code(403);
    echo json_encode([
        'error' => true,
        'message' => 'Token bao mat khong hop le'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$category = isset($_GET['category']) ? trim($_GET['category']) : '';
$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 5;

if ($limit > 20) $limit = 20;
if ($limit < 1) $limit = 5;
if ($offset < 0) $offset = 0;

try {
    $pdo = getConnection();

    $sql = "SELECT id, title, summary, category, DATE_FORMAT(created_at, '%d/%m/%Y %H:%i') as created_at
            FROM news WHERE 1=1";
    $countSql = "SELECT COUNT(*) as total FROM news WHERE 1=1";
    $params = [];

    if ($search !== '') {
        $condition = " AND (title LIKE :search OR summary LIKE :search OR content LIKE :search)";
        $sql .= $condition;
        $countSql .= $condition;
        $params[':search'] = '%' . $search . '%';
    }

    if ($category !== '') {
        $condition = " AND category = :category";
        $sql .= $condition;
        $countSql .= $condition;
        $params[':category'] = $category;
    }

    $countStmt = $pdo->prepare($countSql);
    foreach ($params as $key => $value) {
        $countStmt->bindValue($key, $value);
    }
    $countStmt->execute();
    $total = (int)$countStmt->fetch()['total'];

    $sql .= " ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
    $stmt = $pdo->prepare($sql);

    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    echo json_encode([
        'error' => false,
        'data' => $stmt->fetchAll(),
        'total' => $total,
        'offset' => $offset,
        'limit' => $limit
    ], JSON_UNESCAPED_UNICODE);
} catch (PDOException $e) {
    echo json_encode([
        'error' => true,
        'message' => 'Loi truy van: ' . $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
?>
