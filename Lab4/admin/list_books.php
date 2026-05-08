<?php
require_once __DIR__ . "/../include/connect.inc.php";
if (empty($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}

$perPage = 5;
$page = max(1, (int) ($_GET["page"] ?? 1));
$offset = ($page - 1) * $perPage;

$totalRow = $conn->query("SELECT COUNT(*) AS total FROM tblbooks")->fetch_assoc();
$total = (int) ($totalRow["total"] ?? 0);
$totalPages = max(1, (int) ceil($total / $perPage));

$stmt = $conn->prepare(
    "SELECT b.id_book, b.name_book, b.price, b.images, s.name_subject
     FROM tblbooks b
     LEFT JOIN tblsubject s ON b.id_subject = s.id_subject
     ORDER BY b.id_book DESC
     LIMIT ? OFFSET ?"
);
$stmt->bind_param("ii", $perPage, $offset);
$stmt->execute();
$books = $stmt->get_result();
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh muc sach</title>
    <style>
        body { margin:0; font-family:Arial,sans-serif; background:#f6f8fb; }
        .top { background:#1f3b57; color:#fff; padding:14px 24px; display:flex; justify-content:space-between; }
        .wrap { display:grid; grid-template-columns:260px 1fr; gap:20px; padding:20px; }
        .panel { background:#fff; border-radius:8px; padding:20px; }
        table { width:100%; border-collapse:collapse; }
        th, td { border:1px solid #ddd; padding:8px; text-align:left; }
        img { width:70px; height:90px; object-fit:cover; }
        .pagination a { margin-right:8px; }
    </style>
</head>
<body>
    <div class="top">
        <div>QUAN TRI WEBSITE BAN SACH</div>
        <div><?= h($_SESSION["username"]) ?></div>
    </div>
    <div class="wrap">
        <div><?php include __DIR__ . "/../include/left_admin.php"; ?></div>
        <div class="panel">
            <h2>Danh muc sach</h2>
            <p><a href="insert_book.php">+ Them sach</a></p>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hinh</th>
                        <th>Ten sach</th>
                        <th>Chu de</th>
                        <th>Gia</th>
                        <th>Hanh dong</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($books->num_rows > 0): ?>
                        <?php while ($row = $books->fetch_assoc()): ?>
                            <tr>
                                <td><?= (int) $row["id_book"] ?></td>
                                <td>
                                    <?php if (!empty($row["images"])): ?>
                                        <img src="../uploads/<?= h($row["images"]) ?>" alt="">
                                    <?php endif; ?>
                                </td>
                                <td><?= h($row["name_book"]) ?></td>
                                <td><?= h($row["name_subject"] ?? "Khong ro") ?></td>
                                <td><?= number_format((float) $row["price"], 0, ",", ".") ?> VND</td>
                                <td>
                                    <a href="edit_book.php?id_book=<?= (int) $row["id_book"] ?>">Sua</a> |
                                    <a href="del_book.php?id_book=<?= (int) $row["id_book"] ?>"
                                       onclick="return confirm('Ban co chac muon xoa sach nay?')">Xoa</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="6">Chua co du lieu.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="pagination" style="margin-top:14px;">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?= $i ?>"><?= $i === $page ? "<b>$i</b>" : $i ?></a>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</body>
</html>

