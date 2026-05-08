<?php
require_once __DIR__ . "/../include/connect.inc.php";
if (empty($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}

$idSubject = (int) ($_GET["id_subject"] ?? 0);
if ($idSubject <= 0) {
    header("Location: list_subjects.php");
    exit;
}

$stmt = $conn->prepare("SELECT id_subject, name_subject FROM tblsubject WHERE id_subject = ? LIMIT 1");
$stmt->bind_param("i", $idSubject);
$stmt->execute();
$subject = $stmt->get_result()->fetch_assoc();

if (!$subject) {
    header("Location: list_subjects.php");
    exit;
}

$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nameSubject = trim($_POST["name_subject"] ?? "");
    if ($nameSubject === "") {
        $message = "Noi dung khong ton tai, khong cap nhat.";
    } else {
        $update = $conn->prepare("UPDATE tblsubject SET name_subject = ? WHERE id_subject = ?");
        $update->bind_param("si", $nameSubject, $idSubject);
        $update->execute();
        header("Location: list_subjects.php");
        exit;
    }
}
?>
<!doctype html>
<html lang="vi">
<head><meta charset="UTF-8"><title>Sua chu de</title></head>
<body style="font-family:Arial,sans-serif;max-width:700px;margin:40px auto;">
    <h2>Sua chu de sach</h2>
    <?php if ($message !== ""): ?><p style="color:#b00020;"><?= h($message) ?></p><?php endif; ?>
    <form method="post">
        <p>
            <label>Ten chu de</label><br>
            <input type="text" name="name_subject" value="<?= h($subject["name_subject"]) ?>" style="width:100%;padding:8px;">
        </p>
        <button type="submit">Cap nhat</button>
        <a href="list_subjects.php">Quay lai</a>
    </form>
</body>
</html>

