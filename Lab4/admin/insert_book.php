<?php
require_once __DIR__ . "/../include/connect.inc.php";
if (empty($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}

$subjects = $conn->query("SELECT id_subject, name_subject FROM tblsubject ORDER BY name_subject ASC");
$message = "";
$nameBook = "";
$price = "";
$idSubject = 0;
$des = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nameBook = trim($_POST["name_book"] ?? "");
    $price = trim($_POST["price"] ?? "");
    $idSubject = (int) ($_POST["id_subject"] ?? 0);
    $des = trim($_POST["des"] ?? "");

    if ($nameBook === "" || $price === "" || $idSubject <= 0) {
        $message = "Vui long nhap day du ten sach, gia va chu de.";
    } else {
        $imageName = "";
        if (!empty($_FILES["images"]["name"])) {
            $ext = strtolower(pathinfo($_FILES["images"]["name"], PATHINFO_EXTENSION));
            $allow = ["jpg", "jpeg", "png", "gif", "webp"];
            if (!in_array($ext, $allow, true)) {
                $message = "Dinh dang anh khong hop le.";
            } else {
                $imageName = time() . "_" . mt_rand(1000, 9999) . "." . $ext;
                move_uploaded_file($_FILES["images"]["tmp_name"], __DIR__ . "/../uploads/" . $imageName);
            }
        }

        if ($message === "") {
            $stmt = $conn->prepare(
                "INSERT INTO tblbooks(id_subject, name_book, price, images, des) VALUES(?, ?, ?, ?, ?)"
            );
            $priceFloat = (float) str_replace(",", "", $price);
            $stmt->bind_param("isdss", $idSubject, $nameBook, $priceFloat, $imageName, $des);
            $stmt->execute();
            header("Location: list_books.php");
            exit;
        }
    }
}
?>
<!doctype html>
<html lang="vi">
<head><meta charset="UTF-8"><title>Them sach</title></head>
<body style="font-family:Arial,sans-serif;max-width:900px;margin:30px auto;">
    <h2>Them sach</h2>
    <?php if ($message !== ""): ?><p style="color:#b00020;"><?= h($message) ?></p><?php endif; ?>
    <form method="post" enctype="multipart/form-data">
        <p>
            <label>Ten sach</label><br>
            <input type="text" name="name_book" value="<?= h($nameBook) ?>" style="width:100%;padding:8px;">
        </p>
        <p>
            <label>Chu de</label><br>
            <select name="id_subject" style="width:100%;padding:8px;">
                <option value="0">-- Chon chu de --</option>
                <?php if ($subjects): while ($s = $subjects->fetch_assoc()): ?>
                    <option value="<?= (int) $s["id_subject"] ?>" <?= $idSubject === (int) $s["id_subject"] ? "selected" : "" ?>>
                        <?= h($s["name_subject"]) ?>
                    </option>
                <?php endwhile; endif; ?>
            </select>
        </p>
        <p>
            <label>Gia</label><br>
            <input type="text" name="price" value="<?= h($price) ?>" style="width:100%;padding:8px;">
        </p>
        <p>
            <label>Hinh anh</label><br>
            <input type="file" name="images" accept=".jpg,.jpeg,.png,.gif,.webp">
        </p>
        <p>
            <label>Mo ta</label><br>
            <textarea name="des" id="des" rows="8" style="width:100%;padding:8px;"><?= h($des) ?></textarea>
        </p>
        <button type="submit">Luu</button>
        <a href="list_books.php">Quay lai</a>
    </form>
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>CKEDITOR.replace('des');</script>
</body>
</html>

