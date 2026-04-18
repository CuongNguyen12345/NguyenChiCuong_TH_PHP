<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 5 (Array): Phát sinh mảng và tính toán</title>
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
            background-color: #f5eef8; /* Màu tím nhạt */
            border: 1px solid #8e44ad;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #a93226; /* Màu đỏ đô / Magenta đậm */
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
            width: 180px;
            font-size: 15px;
            color: #5b2c6f;
            font-weight: bold;
        }
        input[type="text"] {
            flex: 1;
            padding: 5px;
            border: 1px solid #8e44ad;
            outline: none;
            font-size: 15px;
        }
        .readonly {
            background-color: #f1948a; /* Màu hồng đậm hơn cho kết quả */
            color: #1b2631;
            font-weight: bold;
        }
        .button-group {
            text-align: center;
            margin-bottom: 15px;
            padding-left: 180px;
        }
        input[type="submit"] {
            padding: 5px 20px;
            cursor: pointer;
            background-color: #f7dc6f; /* Màu vàng */
            border: 1px solid #d4ac0d;
            font-size: 15px;
            font-weight: bold;
        }
        .footer-note {
            text-align: center;
            font-size: 14px;
            color: #5b2c6f;
        }
        .footer-note b {
            color: red;
        }
    </style>
</head>
<body>

<?php
function tao_mang($n) {
    $mang = array();
    for ($i = 0; $i < $n; $i++) {
        $mang[] = rand(0, 20);
    }
    return $mang;
}

function xuat_mang($mang) {
    return implode("  ", $mang);
}

function tinh_tong($mang) {
    $tong = 0;
    foreach ($mang as $v) {
        $tong += $v;
    }
    return $tong;
}

function tim_max($mang) {
    if (empty($mang)) return "";
    $max = $mang[0];
    for ($i = 1; $i < count($mang); $i++) {
        if ($mang[$i] > $max) {
            $max = $mang[$i];
        }
    }
    return $max;
}

function tim_min($mang) {
    if (empty($mang)) return "";
    $min = $mang[0];
    for ($i = 1; $i < count($mang); $i++) {
        if ($mang[$i] < $min) {
            $min = $mang[$i];
        }
    }
    return $min;
}

$n = "";
$mang_str = "";
$max_val = "";
$min_val = "";
$tong_val = "";

if (isset($_POST["n"])) {
    $n = $_POST["n"];
    if (is_numeric($n) && $n > 0) {
        $mang = tao_mang($n);
        $mang_str = xuat_mang($mang);
        $tong_val = tinh_tong($mang);
        $max_val = tim_max($mang);
        $min_val = tim_min($mang);
    }
}
?>

<div class="container">
    <div class="header">
        <h2>PHÁT SINH MẢNG VÀ TÍNH TOÁN</h2>
    </div>
    <form action="Bai5.php" method="post">
        <div class="form-group">
            <label for="n">Nhập số phần tử:</label>
            <input type="text" name="n" id="n" value="<?php echo htmlspecialchars($n); ?>" required>
        </div>
        
        <div class="button-group">
            <input type="submit" value="Phát sinh và tính toán">
        </div>
        
        <div class="form-group">
            <label for="mang">Mảng:</label>
            <input type="text" name="mang" id="mang" value="<?php echo htmlspecialchars($mang_str); ?>" class="readonly" readonly>
        </div>
        
        <div class="form-group">
            <label for="max">GTLN (MAX) trong mảng:</label>
            <input type="text" name="max" id="max" value="<?php echo htmlspecialchars($max_val); ?>" class="readonly" readonly>
        </div>
        
        <div class="form-group">
            <label for="min">TTNN (MIN) trong mảng:</label>
            <input type="text" name="min" id="min" value="<?php echo htmlspecialchars($min_val); ?>" class="readonly" readonly>
        </div>
        
        <div class="form-group">
            <label for="tong">Tổng mảng:</label>
            <input type="text" name="tong" id="tong" value="<?php echo htmlspecialchars($tong_val); ?>" class="readonly" readonly>
        </div>
        
        <div class="footer-note">
            (<b>Ghi chú:</b> Các phần tử trong mảng sẽ có giá trị từ 0 đến 20)
        </div>
    </form>
</div>

</body>
</html>
