<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 4 (Array): Mua Hoa</title>
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
            background-color: #f5b7b1; /* Màu hồng cam nhạt */
            border: 1px solid #e74c3c;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #f39c12; /* Màu vàng cam */
            padding: 10px;
            text-align: center;
        }
        .header h2 {
            margin: 0;
            color: #c0392b; /* Màu đỏ đậm */
            font-family: "Times New Roman", Times, serif;
            font-style: italic;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 26px;
        }
        form {
            padding: 20px;
        }
        .input-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        label {
            font-size: 16px;
            font-weight: bold;
            color: #7b241c;
        }
        .label-block {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"] {
            flex: 1;
            padding: 6px;
            border: 1px solid #7f8c8d;
            outline: none;
            font-size: 16px;
        }
        input[type="submit"] {
            padding: 6px 15px;
            cursor: pointer;
            background-color: #d5dbdb;
            border: 1px solid #7f8c8d;
            font-size: 14px;
        }
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #7f8c8d;
            outline: none;
            font-size: 14px;
            background-color: white;
            box-sizing: border-box;
            line-height: 1.6;
        }
        .status {
            color: #c0392b;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<?php
function tim_hoa($ten_hoa, $mang_hoa) {
    $found = 0;
    foreach ($mang_hoa as $hoa) {
        // Sử dụng strcasecmp để so sánh không phân biệt hoa thường
        if (strcasecmp(trim($hoa), trim($ten_hoa)) == 0) {
            $found = 1;
            break;
        }
    }
    return $found;
}

$loai_hoa = "";
$gio_hoa = "";
$status_msg = "";

// Lấy giá trị từ form
if (isset($_POST["gio_hoa"])) {
    $gio_hoa = $_POST["gio_hoa"];
}

if (isset($_POST["btn_them"])) {
    $loai_hoa = trim($_POST["loai_hoa"]);
    
    if (!empty($loai_hoa)) {
        // Tách chuỗi giỏ hoa thành mảng để kiểm tra
        $mang_hoa = explode(" -- ", $gio_hoa);
        // Loại bỏ phần tử trống nếu có
        $mang_hoa = array_filter($mang_hoa);
        
        if (tim_hoa($loai_hoa, $mang_hoa)) {
            $status_msg = "Hoa " . $loai_hoa . " đã có trong giỏ";
        } else {
            // Thêm hoa vào giỏ hoa
            if (empty($gio_hoa)) {
                $gio_hoa = $loai_hoa;
            } else {
                $gio_hoa .= " -- " . $loai_hoa;
            }
        }
    }
}
?>

<div class="container">
    <div class="header">
        <h2>MUA HOA</h2>
    </div>
    <form action="Bai4.php" method="post">
        <div class="input-row">
            <label for="loai_hoa">Loại hoa bạn chọn:</label>
            <input type="text" name="loai_hoa" id="loai_hoa" value="<?php echo htmlspecialchars($loai_hoa); ?>">
            <input type="submit" name="btn_them" value="Thêm vào giỏ hoa">
        </div>
        
        <?php if ($status_msg !== ""): ?>
        <div class="status"><?php echo $status_msg; ?></div>
        <?php endif; ?>
        
        <div class="basket-row">
            <label class="label-block">Giỏ hoa của bạn có:</label>
            <textarea name="gio_hoa" id="gio_hoa" rows="4" readonly><?php echo htmlspecialchars($gio_hoa); ?></textarea>
        </div>
    </form>
</div>

</body>
</html>
