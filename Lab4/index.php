<?php
require_once __DIR__ . "/include/connect.inc.php";

$books = $conn->query(
    "SELECT b.id_book, b.name_book, b.price, b.images, s.name_subject
     FROM tblbooks b
     LEFT JOIN tblsubject s ON b.id_subject = s.id_subject
     ORDER BY b.id_book DESC"
);
?>

<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Website ban sach</title>
    <style>
        body { margin:0; font-family:Arial,sans-serif; background:#f5f7fb; }
        .top { background:#1f3b57; color:#fff; padding:14px 24px; display:flex; justify-content:space-between; }
        .wrap { display:grid; grid-template-columns:260px 1fr; gap:20px; padding:20px; }
        .grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(190px,1fr)); gap:16px; }
        .card { background:#fff; border-radius:8px; padding:12px; box-shadow:0 4px 12px rgba(0,0,0,.06); }
        .card img { width:100%; height:220px; object-fit:cover; border-radius:6px; }
        .price { color:#cc0000; font-weight:700; }
        a { text-decoration:none; color:#0b58b6; }
    </style>
</head>
<body>
    <div class="top">
        <div>WEBSITE BAN SACH</div>
        <div><a href="admin/index.php" style="color:#fff;">Dang nhap quan tri</a></div>
    </div>
    <div class="wrap">
        <div><?php include __DIR__ . "/include/left.php"; ?></div>
        <div>
            <h2>Danh sach sach</h2>
            <div class="grid">
                <?php if ($books && $books->num_rows > 0): ?>
                    <?php while ($row = $books->fetch_assoc()): ?>
                        <div class="card">
                            <?php if (!empty($row["images"])): ?>
                                <img src="uploads/<?= h($row["images"]) ?>" alt="<?= h($row["name_book"]) ?>">
                            <?php else: ?>
                                <div style="height:220px;background:#eee;border-radius:6px;display:flex;align-items:center;justify-content:center;">No image</div>
                            <?php endif; ?>
                            <h4><?= h($row["name_book"]) ?></h4>
                            <p style="margin:8px 0; color:#666;"><?= h($row["name_subject"] ?? "Khong ro chu de") ?></p>
                            <p class="price"><?= number_format((float) $row["price"], 0, ",", ".") ?> VND</p>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>Chua co sach.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>

