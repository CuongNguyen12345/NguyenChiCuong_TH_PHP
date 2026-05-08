<?php
require_once __DIR__ . "/../include/connect.inc.php";
if (empty($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}

$idBook = (int) ($_GET["id_book"] ?? 0);
if ($idBook <= 0) {
    header("Location: list_books.php");
    exit;
}

$subjects = $conn->query("SELECT id_subject, name_subject FROM tblsubject ORDER BY name_subject ASC");

$stmt = $conn->prepare("SELECT * FROM tblbooks WHERE id_book = ? LIMIT 1");
$stmt->bind_param("i", $idBook);
$stmt->execute();
$book = $stmt->get_result()->fetch_assoc();
if (!$book) {
    header("Location: list_books.php");
    exit;
}

$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nameBook = trim($_POST["name_book"] ?? "");
    $price = trim($_POST["price"] ?? "");
    $idSubject = (int) ($_POST["id_subject"] ?? 0);
    $des = trim($_POST["des"] ?? "");

    if ($nameBook === "" || $price === "" || $idSubject <= 0) {
        $message = "Vui long nhap day du ten sach, gia va chu de.";
    } else {
        $imageName = $book["images"] ?? "";

        if (!empty($_FILES["images"]["name"])) {
            $ext = strtolower(pathinfo($_FILES["images"]["name"], PATHINFO_EXTENSION));
            $allow = ["jpg", "jpeg", "png", "gif", "webp"];
            if (!in_array($ext, $allow, true)) {
                $message = "Dinh dang anh khong hop le.";
            } else {
                $newImage = time() . "_" . mt_rand(1000, 9999) . "." . $ext;
                move_uploaded_file($_FILES["images"]["tmp_name"], __DIR__ . "/../uploads/" . $newImage);
                if (!empty($book["images"])) {
                    $old = __DIR__ . "/../uploads/" . $book["images"];
                    if (is_file($old)) {
                        unlink($old);
                    }
                }
                $imageName = $newImage;
            }
        }

        if ($message === "") {
            $update = $conn->prepare(
                "UPDATE tblbooks SET id_subject = ?, name_book = ?, price = ?, images = ?, des = ? WHERE id_book = ?"
            );
            $priceFloat = (float) str_replace(",", "", $price);
            $update->bind_param("isdssi", $idSubject, $nameBook, $priceFloat, $imageName, $des, $idBook);
            $update->execute();
            header("Location: list_books.php");
            exit;
        }
    }
}
?>
<!doctype html>
<html lang="vi">
<head><meta charset="UTF-8"><title>Sua sach</title></head>
<body style="font-family:Arial,sans-serif;max-width:900px;margin:30px auto;">
    <h2>Sua sach</h2>
    <?php if ($message !== ""): ?><p style="color:#b00020;"><?= h($message) ?></p><?php endif; ?>
    <form method="post" enctype="multipart/form-data">
        <p>
            <label>Ten sach</label><br>
            <input type="text" name="name_book" value="<?= h($book["name_book"]) ?>" style="width:100%;padding:8px;">
        </p>
        <p>
            <label>Chu de</label><br>
            <select name="id_subject" style="width:100%;padding:8px;">
                <?php if ($subjects): while ($s = $subjects->fetch_assoc()): ?>
                    <option value="<?= (int) $s["id_subject"] ?>" <?= (int) $book["id_subject"] === (int) $s["id_subject"] ? "selected" : "" ?>>
                        <?= h($s["name_subject"]) ?>
                    </option>
                <?php endwhile; endif; ?>
            </select>
        </p>
        <p>
            <label>Gia</label><br>
            <input type="text" name="price" value="<?= h($book["price"]) ?>" style="width:100%;padding:8px;">
        </p>
        <p>
            <label>Hinh hien tai</label><br>
            <?php if (!empty($book["images"])): ?>
                <img src="../uploads/<?= h($book["images"]) ?>" style="width:90px;height:120px;object-fit:cover;" alt="">
            <?php else: ?>
                <span>Khong co hinh</span>
            <?php endif; ?>
        </p>
        <p>
            <label>Doi hinh moi (khong chon thi giu nguyen)</label><br>
            <input type="file" name="images" accept=".jpg,.jpeg,.png,.gif,.webp">
        </p>
        <p>
            <label>Mo ta</label><br>
            <textarea name="des" id="des" rows="8" style="width:100%;padding:8px;"><?= h($book["des"]) ?></textarea>
        </p>
        <button type="submit">Cap nhat</button>
        <a href="list_books.php">Quay lai</a>
    </form>
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>CKEDITOR.replace('des');</script>
</body>
</html>

