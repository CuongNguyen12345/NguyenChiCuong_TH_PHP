<?php
require_once __DIR__ . "/../include/connect.inc.php";
if (empty($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang quan tri</title>
    <style>
        body { margin:0; font-family: Arial, sans-serif; background:#f6f8fb; }
        .top { background:#1f3b57; color:#fff; padding:14px 24px; display:flex; justify-content:space-between; }
        .wrap { display:grid; grid-template-columns:260px 1fr; gap:20px; padding:20px; }
        .panel { background:#fff; border-radius:8px; padding:20px; }
    </style>
</head>
<body>
    <div class="top">
        <div>QUAN TRI WEBSITE BAN SACH</div>
        <div>Xin chao: <b><?= h($_SESSION["username"]) ?></b></div>
    </div>
    <div class="wrap">
        <div><?php include __DIR__ . "/../include/left_admin.php"; ?></div>
        <div class="panel">
            <h2>Trang chinh</h2>
            <p>Chon chuc nang ben trai de quan ly chu de sach va san pham sach.</p>
        </div>
    </div>
</body>
</html>

