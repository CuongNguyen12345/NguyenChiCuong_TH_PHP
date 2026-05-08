<?php
require_once __DIR__ . "/include/connect.inc.php";

$idSubject = (int) ($_GET["id_subject"] ?? 0);
if ($idSubject <= 0) {
    header("Location: index.php");
    exit;
}

$subjectStmt = $conn->prepare("SELECT name_subject FROM tblsubject WHERE id_subject = ? LIMIT 1");
$subjectStmt->bind_param("i", $idSubject);
$subjectStmt->execute();
$subject = $subjectStmt->get_result()->fetch_assoc();
if (!$subject) {
    header("Location: index.php");
    exit;
}

$booksStmt = $conn->prepare(
    "SELECT id_book, name_book, price, images FROM tblbooks WHERE id_subject = ? ORDER BY id_book DESC"
);
$booksStmt->bind_param("i", $idSubject);
$booksStmt->execute();
$books = $booksStmt->get_result();
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sach theo chu de</title>
    <style>
        body { margin:0; font-family:Arial,sans-serif; background:#f5f7fb; }
        .top { background:#1f3b57; color:#fff; padding:14px 24px; }
        .wrap { display:grid; grid-template-columns:260px 1fr; gap:20px; padding:20px; }
        .grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(190px,1fr)); gap:16px; }
        .card { background:#fff; border-radius:8px; padding:12px; box-shadow:0 4px 12px rgba(0,0,0,.06); }
        .card img { width:100%; height:220px; object-fit:cover; border-radius:6px; }
        .price { color:#cc0000; font-weight:700; }
        a { text-decoration:none; color:#0b58b6; }
    </style>
</head>
<body>
    <div class="top">WEBSITE BAN SACH</div>
    <div class="wrap">
        <div><?php include __DIR__ . "/include/left.php"; ?></div>
        <div>
            <h2>Chu de: <?= h($subject["name_subject"]) ?></h2>
            <?php if ($books->num_rows <= 0): ?>
                <p>Khong co sach ung voi chu de nay.</p>
            <?php else: ?>
                <div class="grid">
                    <?php while ($row = $books->fetch_assoc()): ?>
                        <div class="card">
                            <?php if (!empty($row["images"])): ?>
                                <img src="uploads/<?= h($row["images"]) ?>" alt="<?= h($row["name_book"]) ?>">
                            <?php else: ?>
                                <div style="height:220px;background:#eee;border-radius:6px;display:flex;align-items:center;justify-content:center;">No image</div>
                            <?php endif; ?>
                            <h4><?= h($row["name_book"]) ?></h4>
                            <p class="price"><?= number_format((float) $row["price"], 0, ",", ".") ?> VND</p>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

