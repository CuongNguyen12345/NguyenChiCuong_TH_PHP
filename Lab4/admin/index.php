<?php
require_once __DIR__ . "/../include/connect.inc.php";

if (!empty($_SESSION["username"])) {
    header("Location: main.php");
    exit;
}

$username = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["btn_reset"])) {
        $username = "";
    } elseif (isset($_POST["btn_login"])) {
        $username = trim($_POST["username"] ?? "");
        $password = trim($_POST["password"] ?? "");

        if ($username === "") {
            $error = "Xin vui long nhap tai khoan";
        } elseif ($password === "") {
            $error = "Xin vui long nhap mat khau";
        } else {
            $passwordMd5 = md5($password);
            $stmt = $conn->prepare("SELECT username FROM tblusers WHERE username = ? AND password = ? LIMIT 1");
            $stmt->bind_param("ss", $username, $passwordMd5);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $_SESSION["username"] = $username;
                header("Location: main.php");
                exit;
            }

            $error = "Tai khoan hoac mat khau khong ton tai!";
            $username = "";
        }
    }
}
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Dang nhap quan tri</title>
    <style>
        body { font-family: Arial, sans-serif; background: #eef2f7; }
        .box { width: 420px; margin: 80px auto; background: #fff; padding: 24px; border-radius: 10px; box-shadow: 0 8px 18px rgba(0,0,0,.08); }
        .row { margin-bottom: 12px; }
        input { width: 100%; padding: 10px; box-sizing: border-box; }
        .actions { display: flex; gap: 8px; }
        button { padding: 10px 16px; cursor: pointer; }
        .error { color: #b00020; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Dang nhap quan tri</h2>
        <?php if ($error !== ""): ?>
            <div class="error"><?= h($error) ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="row">
                <label>Tai khoan</label>
                <input type="text" name="username" value="<?= h($username) ?>">
            </div>
            <div class="row">
                <label>Mat khau</label>
                <input type="password" name="password">
            </div>
            <div class="actions">
                <button type="submit" name="btn_login">Dang nhap</button>
                <button type="submit" name="btn_reset">Lam lai</button>
            </div>
        </form>
    </div>
</body>
</html>

