<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 3: Tính diện tích và chu vi hình tròn</title>
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
            background-color: #ffcc80; /* Màu cam vàng nhạt */
            padding: 15px;
            text-align: center;
        }
        .header h2 {
            margin: 0;
            color: #795548; /* Màu nâu */
            font-family: "Times New Roman", Times, serif;
            font-style: italic;
            text-transform: uppercase;
            font-size: 24px;
            line-height: 1.2;
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
        input[type="text"] {
            flex: 2;
            padding: 5px;
            border: 1px solid #999;
            outline: none;
            font-size: 16px;
        }
        .readonly {
            background-color: #f8bbd0; /* Màu hồng nhạt cho ô kết quả */
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
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #d0d0d0;
        }
    </style>
</head>
<body>

<?php
define("PI", 3.14);

$ban_kinh = "";
$dien_tich = "";
$chu_vi = "";

if (isset($_POST["ban_kinh"])) {
    $ban_kinh = $_POST["ban_kinh"];
    
    if (is_numeric($ban_kinh)) {
        $dien_tich = PI * pow($ban_kinh, 2);
        $chu_vi = 2 * PI * $ban_kinh;
    }
}
?>

<div class="container">
    <div class="header">
        <h2>DIỆN TÍCH và CHU VI<br>HÌNH TRÒN</h2>
    </div>
    <form action="Bai3.php" method="post" name="form_tron">
        <div class="form-group">
            <label for="ban_kinh">Bán kính:</label>
            <input type="text" name="ban_kinh" id="ban_kinh" value="<?php echo htmlspecialchars($ban_kinh); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="dien_tich">Diện tích:</label>
            <input type="text" name="dien_tich" id="dien_tich" value="<?php echo htmlspecialchars($dien_tich); ?>" class="readonly" readonly>
        </div>
        
        <div class="form-group">
            <label for="chu_vi">Chu vi:</label>
            <input type="text" name="chu_vi" id="chu_vi" value="<?php echo htmlspecialchars($chu_vi); ?>" class="readonly" readonly>
        </div>
        
        <div class="button-group">
            <input type="submit" name="btn_tinh" value="Tính">
        </div>
    </form>
</div>

</body>
</html>
