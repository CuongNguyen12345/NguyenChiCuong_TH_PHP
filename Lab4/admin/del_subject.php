<?php
require_once __DIR__ . "/../include/connect.inc.php";
if (empty($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}

$idSubject = (int) ($_GET["id_subject"] ?? 0);
if ($idSubject > 0) {
    $getImages = $conn->prepare("SELECT images FROM tblbooks WHERE id_subject = ?");
    $getImages->bind_param("i", $idSubject);
    $getImages->execute();
    $images = $getImages->get_result();
    while ($img = $images->fetch_assoc()) {
        $file = __DIR__ . "/../uploads/" . $img["images"];
        if (!empty($img["images"]) && is_file($file)) {
            unlink($file);
        }
    }

    $delBooks = $conn->prepare("DELETE FROM tblbooks WHERE id_subject = ?");
    $delBooks->bind_param("i", $idSubject);
    $delBooks->execute();

    $delSubject = $conn->prepare("DELETE FROM tblsubject WHERE id_subject = ?");
    $delSubject->bind_param("i", $idSubject);
    $delSubject->execute();
}

header("Location: list_subjects.php");
exit;

