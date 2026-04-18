<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 1 (Array): Nhập và tính trên dãy số</title>
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
            background-color: #ccd1d1; /* Màu xám xanh nhạt */
            border: 1px solid #7f8c8d;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #16a085; /* Màu teal đậm */
            padding: 10px;
            text-align: center;
        }
        .header h2 {
            margin: 0;
            color: white;
            font-family: "Times New Roman", Times, serif;
            font-style: italic;
            text-transform: uppercase;
            font-size: 22px;
            letter-spacing: 1px;
        }
        form {
            padding: 20px;
        }
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        label {
            width: 120px;
            font-size: 15px;
        }
        .input-group {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        input[type="text"] {
            flex: 1;
            padding: 5px;
            border: 1px solid #7f8c8d;
            outline: none;
            font-size: 15px;
        }
        .asterisk {
            color: red;
            font-weight: bold;
        }
        .readonly {
            background-color: #cdf19d; /* Màu xanh lá nhạt cho ô kết quả */
            font-weight: bold;
            color: red;
        }
        .button-group {
            text-align: center;
            margin-bottom: 15px;
            padding-left: 120px;
        }
        input[type="submit"] {
            padding: 5px 20px;
            cursor: pointer;
            background-color: #f1c40f; /* Màu vàng giống hình */
            border: 1px solid #d4ac0d;
            font-size: 15px;
        }
        .note {
            text-align: center;
            font-size: 14px;
            padding-bottom: 10px;
        }
    </style>
</head>
<body>

<?php
$day_so = "";
$tong = "";

if (isset($_POST["day_so"])) {
    $day_so = $_POST["day_so"];
    
    if (!empty($day_so)) {
        // Tách chuỗi thành mảng bằng dấu phẩy
        $mang_so = explode(",", $day_so);
        $count = count($mang_so);
        $tong_so = 0;
        
        // Duyệt mảng bằng vòng lập For để tính tổng
        for ($i = 0; $i < $count; $i++) {
            $tong_so += (float)$mang_so[$i];
        }
        
        $tong = $tong_so;
    }
}
?>

<div class="container">
    <div class="header">
        <h2>NHẬP VÀ TÍNH TRÊN DÃY SỐ</h2>
    </div>
    <form action="Bai1.php" method="post" name="form_array">
        <div class="form-group">
            <label for="day_so">Nhập dãy số:</label>
            <div class="input-group">
                <input type="text" name="day_so" id="day_so" value="<?php echo htmlspecialchars($day_so); ?>" required>
                <span class="asterisk">(*)</span>
            </div>
        </div>
        
        <div class="button-group">
            <input type="submit" name="btn_tong" value="Tổng dãy số">
        </div>
        
        <div class="form-group">
            <label for="tong">Tổng dãy số:</label>
            <input type="text" name="tong" id="tong" value="<?php echo htmlspecialchars($tong); ?>" class="readonly" readonly>
        </div>
        
        <div class="note">
            <span class="asterisk">(*)</span> Các số được nhập cách nhau bằng dấu ","
        </div>
    </form>
</div>

</body>
</html>
