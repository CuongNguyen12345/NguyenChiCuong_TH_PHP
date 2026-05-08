<?php
require_once __DIR__ . "/../include/connect.inc.php";
if (empty($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}

$nameSubject = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nameSubject = trim($_POST["name_subject"] ?? "");
    if ($nameSubject === "") {
        $message = "Noi dung chu de khong duoc de trong.";
    } else {
        $stmt = $conn->prepare("INSERT INTO tblsubject(name_subject) VALUES(?)");
        $stmt->bind_param("s", $nameSubject);
        $stmt->execute();
        header("Location: list_subjects.php");
        exit;
    }
}
?>
<!doctype html>
<html lang="vi">
<head><meta charset="UTF-8"><title>Them chu de</title></head>
<body style="font-family:Arial,sans-serif;max-width:700px;margin:40px auto;">
    <h2>Them chu de sach</h2>
    <?php if ($message !== ""): ?><p style="color:#b00020;"><?= h($message) ?></p><?php endif; ?>
    <form method="post">
        <p>
            <label>Ten chu de</label><br>
            <input type="text" name="name_subject" value="<?= h($nameSubject) ?>" style="width:100%;padding:8px;">
        </p>
        <button type="submit">Luu</button>
        <a href="list_subjects.php">Quay lai</a>
    </form>
</body>
</html>

