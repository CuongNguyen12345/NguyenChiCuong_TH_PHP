<?php
if (session_status() === PHP_SESSION_NONE) {
    $sessionPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'sessions';
    if (!is_dir($sessionPath)) {
        mkdir($sessionPath, 0777, true);
    }
    if (is_writable($sessionPath)) {
        session_save_path($sessionPath);
    }
    session_start();
}

define('DB_HOST', 'localhost');
define('DB_PORT', 3306);
define('DB_USER', 'root');
define('DB_PASS', '123456');
define('DB_NAME', 'db_products');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function db_connect($useDatabase = true)
{
    try {
        $database = $useDatabase ? DB_NAME : null;
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, $database, DB_PORT);
        $conn->set_charset('utf8mb4');
        return $conn;
    } catch (mysqli_sql_exception $e) {
        throw new RuntimeException('Không thể kết nối cơ sở dữ liệu: ' . $e->getMessage());
    }
}

function h($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function redirect($url)
{
    header('Location: ' . $url);
    exit;
}

function require_login()
{
    if (empty($_SESSION['user_id'])) {
        redirect('../login.php');
    }
}

function flash($type, $message)
{
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message,
    ];
}

function get_flash()
{
    if (empty($_SESSION['flash'])) {
        return null;
    }

    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $flash;
}

function current_user_id()
{
    return (int) ($_SESSION['user_id'] ?? 0);
}

function bind_params(mysqli_stmt $stmt, $types, array &$params)
{
    $refs = [];
    foreach ($params as $key => &$value) {
        $refs[$key] = &$value;
    }

    array_unshift($refs, $types);
    return $stmt->bind_param(...$refs);
}
