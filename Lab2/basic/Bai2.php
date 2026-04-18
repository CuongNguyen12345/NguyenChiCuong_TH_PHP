<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 2: Tính diện tích hình chữ nhật</title>
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
            width: 450px;
            background-color: #fef5c8; /* Màu vàng nhạt giống hình */
            border: 1px solid #dcdcdc;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #ffeb3b; /* Màu vàng đậm */
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
            flex: 1;
            font-size: 16px;
            color: #333;
        }
        input[type="text"], input[type="number"] {
            flex: 2;
            padding: 5px;
            border: 1px solid #999;
            outline: none;
            font-size: 16px;
        }
        .readonly {
            background-color: #ffcdd2; /* Màu hồng nhạt cho ô diện tích */
        }
        .button-group {
            text-align: center;
            margin-top: 15px;
        }
        input[type="submit"] {
            padding: 5px 25px;
            cursor: pointer;
            background-color: #f0f0f0;
            border: 1px solid #999;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #e0e0e0;
        }
    </style>
</head>
<body>

<?php
$chieu_dai = "";
$chieu_rong = "";
$dien_tich = "";

if (isset($_POST["chieu_dai"]) && isset($_POST["chieu_rong"])) {
    $chieu_dai = $_POST["chieu_dai"];
    $chieu_rong = $_POST["chieu_rong"];
    
    if (is_numeric($chieu_dai) && is_numeric($chieu_rong)) {
        $dien_tich = $chieu_dai * $chieu_rong;
    }
}
?>

<div class="container">
    <div class="header">
        <h2>DIỆN TÍCH HÌNH CHỮ NHẬT</h2>
    </div>
    <form action="Bai2.php" method="post" name="form_hcn">
        <div class="form-group">
            <label for="chieu_dai">Chiều dài:</label>
            <input type="text" name="chieu_dai" id="chieu_dai" value="<?php echo htmlspecialchars($chieu_dai); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="chieu_rong">Chiều rộng:</label>
            <input type="text" name="chieu_rong" id="chieu_rong" value="<?php echo htmlspecialchars($chieu_rong); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="dien_tich">Diện tích:</label>
            <input type="text" name="dien_tich" id="dien_tich" value="<?php echo htmlspecialchars($dien_tich); ?>" class="readonly" readonly>
        </div>
        
        <div class="button-group">
            <input type="submit" name="btn_tinh" value="Tính">
        </div>
    </form>
</div>

</body>
</html>
