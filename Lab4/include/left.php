<?php
require_once __DIR__ . "/connect.inc.php";
$subjects = $conn->query("SELECT id_subject, name_subject FROM tblsubject ORDER BY name_subject ASC");
?>
<div style="padding:16px; background:#f7f7f7; border-radius:8px;">
    <h3 style="margin-top:0;">Chu de sach</h3>
    <ul style="list-style:none; padding:0; margin:0;">
        <?php if ($subjects && $subjects->num_rows > 0): ?>
            <?php while ($row = $subjects->fetch_assoc()): ?>
                <li style="margin-bottom:10px;">
                    <a href="show_subject.php?id_subject=<?= (int) $row["id_subject"] ?>">
                        <?= h($row["name_subject"]) ?>
                    </a>
                </li>
            <?php endwhile; ?>
        <?php else: ?>
            <li>Chua co chu de.</li>
        <?php endif; ?>
    </ul>
</div>

