<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$dbHost = "localhost:3306";
$dbUser = "root";
$dbPass = "123456";
$dbName = "book";

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($conn->connect_error) {
    die("Khong the ket noi CSDL: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

function h($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, "UTF-8");
}

