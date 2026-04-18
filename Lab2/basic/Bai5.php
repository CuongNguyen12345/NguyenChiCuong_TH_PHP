<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 5: Tính cạnh huyền tam giác vuông</title>
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
            background-color: #ffb74d; /* Màu cam đậm hơn một chút */
            padding: 10px;
            text-align: center;
        }
        .header h2 {
            margin: 0;
            color: #795548; /* Màu nâu */
            font-family: "Times New Roman", Times, serif;
            font-size: 20px;
            text-transform: uppercase;
            font-weight: bold;
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
            font-size: 15px;
            color: #333;
        }
        input[type="text"] {
            flex: 1;
            padding: 5px;
            border: 1px solid #999;
            outline: none;
            font-size: 15px;
        }
        .readonly {
            background-color: #f8bbd0; /* Màu hồng nhạt cho ô cạnh huyền */
        }
        .button-group {
            text-align: center;
            margin-top: 20px;
        }
        input[type="submit"] {
            padding: 5px 20px;
            cursor: pointer;
            background-color: #e0e0e0;
            border: 1px solid #999;
            font-size: 15px;
        }
        input[type="submit"]:hover {
            background-color: #d0d0d0;
        }
    </style>
</head>
<body>

<?php
$canh_a = "";
$canh_b = "";
$canh_huyen = "";

if (isset($_POST["canh_a"]) && isset($_POST["canh_b"])) {
    $canh_a = $_POST["canh_a"];
    $canh_b = $_POST["canh_b"];
    
    if (is_numeric($canh_a) && is_numeric($canh_b)) {
        // Áp dụng định lý Pytago: c = sqrt(a^2 + b^2)
        $canh_huyen = sqrt(pow($canh_a, 2) + pow($canh_b, 2));
        
        // Làm tròn kết quả nếu cần (ví dụ 2 chữ số thập phân)
        // $canh_huyen = round($canh_huyen, 2);
    }
}
?>

<div class="container">
    <div class="header">
        <h2>CẠNH HUYỀN TAM GIÁC VUÔNG</h2>
    </div>
    <form action="Bai5.php" method="post" name="form_pytago">
        <div class="form-group">
            <label for="canh_a">Cạnh A:</label>
            <input type="text" name="canh_a" id="canh_a" value="<?php echo htmlspecialchars($canh_a); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="canh_b">Cạnh B:</label>
            <input type="text" name="canh_b" id="canh_b" value="<?php echo htmlspecialchars($canh_b); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="canh_huyen">Cạnh huyền:</label>
            <input type="text" name="canh_huyen" id="canh_huyen" value="<?php echo htmlspecialchars($canh_huyen); ?>" class="readonly" readonly>
        </div>
        
        <div class="button-group">
            <input type="submit" name="btn_tinh" value="Tính">
        </div>
    </form>
</div>

</body>
</html>
