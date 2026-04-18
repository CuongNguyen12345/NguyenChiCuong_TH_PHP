<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 7: Chào theo giờ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        .container {
            width: 400px;
            background-color: #d1f2eb; /* Màu xanh nhạt giống hình */
            border: 1px solid #ccc;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #a9cce3; /* Màu xanh dương nhạt */
            color: #1b4f72;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            font-size: 22px;
            text-transform: uppercase;
        }
        form {
            padding: 20px;
        }
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        label {
            width: 100px;
            font-size: 16px;
        }
        input[type="text"] {
            flex: 1;
            padding: 5px;
            border: 1px solid #999;
            outline: none;
            font-size: 16px;
        }
        .result {
            text-align: center;
            margin-bottom: 20px;
            font-size: 18px;
            color: #333;
            min-height: 1.2em;
        }
        .footer {
            background-color: #a9cce3;
            padding: 10px;
            text-align: center;
        }
        input[type="submit"] {
            padding: 5px 20px;
            cursor: pointer;
            background-color: #e0e0e0;
            border: 1px solid #999;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #d0d0d0;
        }
    </style>
</head>
<body>

<?php
$gio_nhap = "";
$loi_chao = "";

if (isset($_POST["gio_nhap"])) {
    $gio_nhap = $_POST["gio_nhap"];
    
    if ($gio_nhap !== "") {
        // Sử dụng explode() như yêu cầu (đề phòng trường hợp nhập dạng HH:mm)
        $tach_gio = explode(":", $gio_nhap);
        $gio = (int)$tach_gio[0];
        
        if ($gio >= 0 && $gio < 13) {
            $loi_chao = "Chào buổi sáng!";
        } elseif ($gio >= 13 && $gio <= 18) {
            $loi_chao = "Chào buổi chiều!";
        } elseif ($gio >= 19 && $gio <= 24) {
            $loi_chao = "Chào buổi tối!";
        } else {
            $loi_chao = "Giờ không hợp lệ (0-24)!";
        }
    }
}
?>

<div class="container">
    <div class="header">CHÀO THEO GIỜ</div>
    <form action="Bai7.php" method="post" name="form_chao_gio">
        <div class="form-group">
            <label for="gio_nhap">Nhập giờ:</label>
            <input type="text" name="gio_nhap" id="gio_nhap" value="<?php echo htmlspecialchars($gio_nhap); ?>">
        </div>
        
        <div class="result">
            <?php echo $loi_chao; ?>
        </div>
        
        <div class="footer">
            <input type="submit" name="btn_chao" value="Chào">
        </div>
    </form>
</div>

</body>
</html>
