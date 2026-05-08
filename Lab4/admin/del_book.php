<?php
require_once __DIR__ . "/../include/connect.inc.php";
if (empty($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}

$idBook = (int) ($_GET["id_book"] ?? 0);
if ($idBook > 0) {
    $stmt = $conn->prepare("SELECT images FROM tblbooks WHERE id_book = ? LIMIT 1");
    $stmt->bind_param("i", $idBook);
    $stmt->execute();
    $book = $stmt->get_result()->fetch_assoc();

    if ($book && !empty($book["images"])) {
        $imageFile = __DIR__ . "/../uploads/" . $book["images"];
        if (is_file($imageFile)) {
            unlink($imageFile);
        }
    }

    $del = $conn->prepare("DELETE FROM tblbooks WHERE id_book = ?");
    $del->bind_param("i", $idBook);
    $del->execute();
}

header("Location: list_books.php");
exit;

