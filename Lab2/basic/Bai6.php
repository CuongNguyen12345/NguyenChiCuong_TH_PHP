<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 6: Tìm số lớn hơn</title>
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
            margin-bottom: 12px;
        }
        label {
            width: 120px;
            font-size: 16px;
            color: #333;
        }
        input[type="text"] {
            flex: 1;
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
$so_a = "";
$so_b = "";
$so_lon_hon = "";

if (isset($_POST["so_a"]) && isset($_POST["so_b"])) {
    $so_a = $_POST["so_a"];
    $so_b = $_POST["so_b"];
    
    if (is_numeric($so_a) && is_numeric($so_b)) {
        // Tìm số lớn hơn
        if ($so_a > $so_b) {
            $so_lon_hon = $so_a;
        } else {
            $so_lon_hon = $so_b;
        }
        // Hoặc dùng hàm max(): $so_lon_hon = max($so_a, $so_b);
    }
}
?>

<div class="container">
    <div class="header">
        <h2>TÌM SỐ LỚN HƠN</h2>
    </div>
    <form action="Bai6.php" method="post" name="form_so_lon">
        <div class="form-group">
            <label for="so_a">Số A:</label>
            <input type="text" name="so_a" id="so_a" value="<?php echo htmlspecialchars($so_a); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="so_b">Số B:</label>
            <input type="text" name="so_b" id="so_b" value="<?php echo htmlspecialchars($so_b); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="so_lon_hon">Số lớn hơn:</label>
            <input type="text" name="so_lon_hon" id="so_lon_hon" value="<?php echo htmlspecialchars($so_lon_hon); ?>" class="readonly" readonly>
        </div>
        
        <div class="button-group">
            <input type="submit" name="btn_tim" value="Tìm">
        </div>
    </form>
</div>

</body>
</html>
