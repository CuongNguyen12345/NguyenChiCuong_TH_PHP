<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 8 (Array): Sắp xếp mảng</title>
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
            font-size: 15px;
            color: #1b2631;
        }
        .subtitle {
            color: #c0392b; /* Màu đỏ */
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 10px;
            font-size: 16px;
        }
        .input-wrapper {
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
            background-color: #cdf19d; /* Xanh nhẹ cho mảng hiển thị */
            color: #1b2631;
        }
        .button-group {
            text-align: center;
            margin: 15px 0;
            padding-left: 120px;
            display: flex;
        }
        input[type="submit"] {
            padding: 5px 25px;
            cursor: pointer;
            background-color: #ffffff;
            border: 1px solid #7f8c8d;
            color: #1b2631;
            font-size: 15px;
        }
        .footer-note {
            text-align: center;
            font-size: 14px;
            padding-bottom: 10px;
        }
    </style>
</head>
<body>

<?php
function hoan_vi(&$a, &$b) {
    $temp = $a;
    $a = $b;
    $b = $temp;
}

function sap_tang($mang) {
    $n = count($mang);
    for ($i = 0; $i < $n - 1; $i++) {
        for ($j = $i + 1; $j < $n; $j++) {
            if ((float)$mang[$i] > (float)$mang[$j]) {
                hoan_vi($mang[$i], $mang[$j]);
            }
        }
    }
    return $mang;
}

function sap_giam($mang) {
    $n = count($mang);
    for ($i = 0; $i < $n - 1; $i++) {
        for ($j = $i + 1; $j < $n; $j++) {
            if ((float)$mang[$i] < (float)$mang[$j]) {
                hoan_vi($mang[$i], $mang[$j]);
            }
        }
    }
    return $mang;
}

$nhap_mang = "";
$tang_dan = "";
$giam_dan = "";

if (isset($_POST["nhap_mang"])) {
    $nhap_mang = $_POST["nhap_mang"];
    
    if (!empty($nhap_mang)) {
        $mang = explode(",", $nhap_mang);
        
        // Sắp xếp tăng dần
        $mang_tang = sap_tang($mang);
        $tang_dan = implode(",  ", $mang_tang);
        
        // Sắp xếp giảm dần
        $mang_giam = sap_giam($mang);
        $giam_dan = implode(",  ", $mang_giam);
    }
}
?>

<div class="container">
    <div class="header">
        <h2>SẮP XẾP MẢNG</h2>
    </div>
    <form action="Bai8.php" method="post">
        <div class="form-group">
            <label for="nhap_mang">Nhập mảng:</label>
            <div class="input-wrapper">
                <input type="text" name="nhap_mang" id="nhap_mang" value="<?php echo htmlspecialchars($nhap_mang); ?>" required>
                <span class="asterisk">(*)</span>
            </div>
        </div>
        
        <div class="button-group">
            <input type="submit" value="Sắp xếp tăng/giảm">
        </div>
        
        <div class="subtitle">Sau khi sắp xếp:</div>
        
        <div class="form-group">
            <label for="tang_dan">Tăng dần:</label>
            <input type="text" name="tang_dan" id="tang_dan" value="<?php echo htmlspecialchars($tang_dan); ?>" class="readonly" readonly>
        </div>
        
        <div class="form-group">
            <label for="giam_dan">Giảm dần:</label>
            <input type="text" name="giam_dan" id="giam_dan" value="<?php echo htmlspecialchars($giam_dan); ?>" class="readonly" readonly>
        </div>
        
        <div class="footer-note">
            <span class="asterisk">(*)</span> Các số được nhập cách nhau bằng dấu ","
        </div>
    </form>
</div>

</body>
</html>
