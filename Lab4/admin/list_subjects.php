<?php
require_once __DIR__ . "/../include/connect.inc.php";
if (empty($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}

$perPage = 5;
$page = max(1, (int) ($_GET["page"] ?? 1));
$offset = ($page - 1) * $perPage;

$totalRow = $conn->query("SELECT COUNT(*) AS total FROM tblsubject")->fetch_assoc();
$total = (int) ($totalRow["total"] ?? 0);
$totalPages = max(1, (int) ceil($total / $perPage));

$stmt = $conn->prepare("SELECT id_subject, name_subject FROM tblsubject ORDER BY id_subject DESC LIMIT ? OFFSET ?");
$stmt->bind_param("ii", $perPage, $offset);
$stmt->execute();
$subjects = $stmt->get_result();
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh muc chu de sach</title>
    <style>
        body { margin:0; font-family:Arial,sans-serif; background:#f6f8fb; }
        .top { background:#1f3b57; color:#fff; padding:14px 24px; display:flex; justify-content:space-between; }
        .wrap { display:grid; grid-template-columns:260px 1fr; gap:20px; padding:20px; }
        .panel { background:#fff; border-radius:8px; padding:20px; }
        table { width:100%; border-collapse:collapse; }
        th, td { border:1px solid #ddd; padding:8px; text-align:left; }
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
            <h2>Danh muc chu de sach</h2>
            <p><a href="insert_subject.php">+ Them chu de</a></p>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ten chu de</th>
                        <th>Hanh dong</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($subjects->num_rows > 0): ?>
                        <?php while ($row = $subjects->fetch_assoc()): ?>
                            <tr>
                                <td><?= (int) $row["id_subject"] ?></td>
                                <td><?= h($row["name_subject"]) ?></td>
                                <td>
                                    <a href="edit_subject.php?id_subject=<?= (int) $row["id_subject"] ?>">Sua</a> |
                                    <a href="del_subject.php?id_subject=<?= (int) $row["id_subject"] ?>"
                                       onclick="return confirm('Ban co chac muon xoa chu de nay?')">Xoa</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="3">Chua co du lieu.</td></tr>
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

