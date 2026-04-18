<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 10: Giải phương trình bậc nhất</title>
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
            background-color: #ffb74d; /* Màu cam */
            padding: 10px;
            text-align: center;
        }
        .header h2 {
            margin: 0;
            color: #795548; /* Màu nâu */
            font-family: "Times New Roman", Times, serif;
            font-style: italic;
            text-transform: uppercase;
            font-size: 22px;
        }
        form {
            padding: 20px;
        }
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .equation-group {
            display: flex;
            align-items: center;
            gap: 5px;
            flex: 1;
        }
        label {
            width: 120px;
            font-size: 16px;
            color: #333;
        }
        .input-short {
            width: 80px;
            padding: 5px;
            border: 1px solid #999;
            outline: none;
            font-size: 16px;
            text-align: center;
        }
        .input-full {
            flex: 1;
            padding: 5px;
            border: 1px solid #999;
            outline: none;
            font-size: 16px;
        }
        .symbol {
            font-weight: bold;
            font-size: 16px;
        }
        .readonly {
            background-color: #fff9c4; /* Vàng nhạt cho ô kết quả */
        }
        .button-group {
            text-align: center;
            margin-top: 20px;
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
$a = "";
$b = "";
$nghiem = "";

if (isset($_POST["a"]) && isset($_POST["b"])) {
    $a = $_POST["a"];
    $b = $_POST["b"];
    
    if (is_numeric($a) && is_numeric($b)) {
        if ($a == 0) {
            if ($b == 0) {
                $nghiem = "Phương trình có vô số nghiệm";
            } else {
                $nghiem = "Phương trình vô nghiệm";
            }
        } else {
            // Nghiệm x = -b/a
            $x = - $b / $a;
            // Làm tròn nếu cần, ví dụ 2 chữ số thập phân
            $x = round($x, 2);
            $nghiem = "x = " . $x;
        }
    } else {
        $nghiem = "Vui lòng nhập số hợp lệ!";
    }
}
?>

<div class="container">
    <div class="header">
        <h2>GIẢI PHƯƠNG TRÌNH BẬC NHẤT</h2>
    </div>
    <form action="Bai10.php" method="post" name="form_giai_pt">
        <div class="form-group">
            <label>Phương trình:</label>
            <div class="equation-group">
                <input type="text" name="a" id="a" value="<?php echo htmlspecialchars($a); ?>" class="input-short" required>
                <span class="symbol">x +</span>
                <input type="text" name="b" id="b" value="<?php echo htmlspecialchars($b); ?>" class="input-short" required>
                <span class="symbol">= 0</span>
            </div>
        </div>
        
        <div class="form-group">
            <label for="nghiem">Nghiệm:</label>
            <input type="text" name="nghiem" id="nghiem" value="<?php echo htmlspecialchars($nghiem); ?>" class="input-full readonly" readonly>
        </div>
        
        <div class="button-group">
            <input type="submit" name="btn_giai" value="Giải phương trình">
        </div>
    </form>
</div>

</body>
</html>
