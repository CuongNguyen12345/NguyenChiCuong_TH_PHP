<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 7 (Array): Thay thế</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f5f5f5;
        }
        .container {
            width: 550px;
            background-color: #fce4ec; /* Hồng nhạt */
            border: 1px solid #c2185b;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #a2128e; /* Màu tím đậm / Magenta */
            padding: 10px;
            text-align: center;
        }
        .header h2 {
            margin: 0;
            color: white;
            font-family: "Times New Roman", Times, serif;
            font-style: italic;
            text-transform: uppercase;
            font-size: 24px;
        }
        form {
            padding: 20px;
        }
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        label {
            width: 180px;
            font-size: 15px;
            color: #4a235a;
        }
        input[type="text"] {
            flex: 1;
            padding: 5px;
            border: 1px solid #a2128e;
            outline: none;
            font-size: 15px;
        }
        .readonly {
            background-color: #f1948a; /* Màu hồng đậm cho kết quả */
            color: black;
        }
        .button-group {
            text-align: center;
            margin: 15px 0;
            padding-left: 180px;
            display: flex;
        }
        input[type="submit"] {
            padding: 5px 25px;
            cursor: pointer;
            background-color: #f7dc6f; /* Màu vàng */
            border: 1px solid #d4ac0d;
            font-size: 15px;
            font-weight: bold;
        }
        .footer-note {
            text-align: center;
            font-size: 14px;
            color: #c2185b;
            margin-top: 10px;
        }
        .footer-note b {
            color: red;
        }
    </style>
</head>
<body>

<?php
function thay_the($mang, $cu, $moi) {
    for ($i = 0; $i < count($mang); $i++) {
        if (trim($mang[$i]) == trim($cu)) {
            $mang[$i] = $moi;
        }
    }
    return $mang;
}

function xuat_mang($mang) {
    return implode("  ", $mang);
}

$nhap_mang = "";
$gia_tri_cu = "";
$gia_tri_moi = "";
$mang_cu_str = "";
$mang_moi_str = "";

if (isset($_POST["nhap_mang"]) && isset($_POST["gia_tri_cu"]) && isset($_POST["gia_tri_moi"])) {
    $nhap_mang = $_POST["nhap_mang"];
    $gia_tri_cu = $_POST["gia_tri_cu"];
    $gia_tri_moi = $_POST["gia_tri_moi"];
    
    if (!empty($nhap_mang)) {
        // Tách chuỗi thành mảng
        $mang = explode(",", $nhap_mang);
        $mang_cu_str = xuat_mang($mang);
        
        // Gọi hàm thay thế
        $mang_moi = thay_the($mang, $gia_tri_cu, $gia_tri_moi);
        $mang_moi_str = xuat_mang($mang_moi);
    }
}
?>

<div class="container">
    <div class="header">
        <h2>THAY THẾ</h2>
    </div>
    <form action="Bai7.php" method="post">
        <div class="form-group">
            <label for="nhap_mang">Nhập các phần tử:</label>
            <input type="text" name="nhap_mang" id="nhap_mang" value="<?php echo htmlspecialchars($nhap_mang); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="gia_tri_cu">Giá trị cần thay thế:</label>
            <input type="text" name="gia_tri_cu" id="gia_tri_cu" style="max-width: 150px;" value="<?php echo htmlspecialchars($gia_tri_cu); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="gia_tri_moi">Giá trị thay thế:</label>
            <input type="text" name="gia_tri_moi" id="gia_tri_moi" style="max-width: 150px;" value="<?php echo htmlspecialchars($gia_tri_moi); ?>" required>
        </div>
        
        <div class="button-group">
            <input type="submit" value="Thay thế">
        </div>
        
        <div class="form-group">
            <label for="mang_cu">Mảng cũ:</label>
            <input type="text" name="mang_cu" id="mang_cu" value="<?php echo htmlspecialchars($mang_cu_str); ?>" class="readonly" readonly>
        </div>
        
        <div class="form-group">
            <label for="mang_moi">Mảng sau khi thay thế:</label>
            <input type="text" name="mang_moi" id="mang_moi" value="<?php echo htmlspecialchars($mang_moi_str); ?>" class="readonly" readonly>
        </div>
        
        <div class="footer-note">
            (<b>Ghi chú:</b> Các phần tử trong mảng sẽ cách nhau bằng dấu ",")
        </div>
    </form>
</div>

</body>
</html>
