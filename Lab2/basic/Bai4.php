<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 4: Thanh toán tiền điện</title>
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
            width: 500px;
            background-color: #fef5c8; /* Màu vàng nhạt giống hình */
            border: 1px solid #dcdcdc;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #ffcc80; /* Màu cam vàng nhạt */
            padding: 10px;
            text-align: center;
        }
        .header h2 {
            margin: 0;
            color: #795548; /* Màu nâu */
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
            width: 150px;
            font-size: 14px;
            color: #333;
        }
        .input-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
        }
        input[type="text"] {
            flex: 1;
            padding: 4px;
            border: 1px solid #999;
            outline: none;
            font-size: 14px;
        }
        .unit {
            margin-left: 10px;
            font-size: 14px;
            width: 50px;
        }
        .readonly {
            background-color: #f8bbd0; /* Màu hồng nhạt cho ô thanh toán */
        }
        .button-group {
            text-align: center;
            margin-top: 15px;
        }
        input[type="submit"] {
            padding: 5px 25px;
            cursor: pointer;
            background-color: #e0e0e0;
            border: 1px solid #999;
            font-size: 14px;
        }
        input[type="submit"]:hover {
            background-color: #d0d0d0;
        }
    </style>
</head>
<body>

<?php
$ten_chu_ho = "";
$chi_so_cu = "";
$chi_so_moi = "";
$don_gia = 2000; // Giá trị mặc định
$so_tien = "";

if (isset($_POST["ten_chu_ho"])) {
    $ten_chu_ho = $_POST["ten_chu_ho"];
    $chi_so_cu = $_POST["chi_so_cu"];
    $chi_so_moi = $_POST["chi_so_moi"];
    $don_gia = $_POST["don_gia"];
    
    if (is_numeric($chi_so_cu) && is_numeric($chi_so_moi) && is_numeric($don_gia)) {
        // Số tiền = (Chỉ số mới - Chỉ số cũ) * Đơn giá
        $so_tien = ($chi_so_moi - $chi_so_cu) * $don_gia;
    }
}
?>

<div class="container">
    <div class="header">
        <h2>THANH TOÁN TIỀN ĐIỆN</h2>
    </div>
    <form action="Bai4.php" method="post" name="form_tien_dien">
        <div class="form-group">
            <label for="ten_chu_ho">Tên chủ hộ:</label>
            <div class="input-wrapper">
                <input type="text" name="ten_chu_ho" id="ten_chu_ho" value="<?php echo htmlspecialchars($ten_chu_ho); ?>" required>
            </div>
        </div>
        
        <div class="form-group">
            <label for="chi_so_cu">Chỉ số cũ:</label>
            <div class="input-wrapper">
                <input type="text" name="chi_so_cu" id="chi_so_cu" value="<?php echo htmlspecialchars($chi_so_cu); ?>" required>
                <span class="unit">(Kw)</span>
            </div>
        </div>
        
        <div class="form-group">
            <label for="chi_so_moi">Chỉ số mới:</label>
            <div class="input-wrapper">
                <input type="text" name="chi_so_moi" id="chi_so_moi" value="<?php echo htmlspecialchars($chi_so_moi); ?>" required>
                <span class="unit">(Kw)</span>
            </div>
        </div>
        
        <div class="form-group">
            <label for="don_gia">Đơn giá:</label>
            <div class="input-wrapper">
                <input type="text" name="don_gia" id="don_gia" value="<?php echo htmlspecialchars($don_gia); ?>" required>
                <span class="unit">(VNĐ)</span>
            </div>
        </div>
        
        <div class="form-group">
            <label for="so_tien">Số tiền thanh toán:</label>
            <div class="input-wrapper">
                <input type="text" name="so_tien" id="so_tien" value="<?php echo htmlspecialchars($so_tien); ?>" class="readonly" readonly>
                <span class="unit">(VNĐ)</span>
            </div>
        </div>
        
        <div class="button-group">
            <input type="submit" name="btn_tinh" value="Tính">
        </div>
    </form>
</div>

</body>
</html>
