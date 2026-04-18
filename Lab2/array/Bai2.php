<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 2 (Array): Tìm năm nhuận</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        .container {
            width: 450px;
            background-color: #aed6f1; /* Màu xanh dương nhạt */
            border: 1px solid #2e86c1;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #1f618d; /* Màu xanh dương đậm */
            padding: 10px;
            text-align: center;
        }
        .header h2 {
            margin: 0;
            color: white;
            font-family: "Times New Roman", Times, serif;
            font-style: italic;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 24px;
        }
        form {
            padding: 20px;
        }
        .form-group {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 15px;
        }
        label {
            font-size: 16px;
            font-weight: bold;
        }
        input[type="text"] {
            width: 150px;
            padding: 5px;
            border: 1px solid #2e86c1;
            outline: none;
            font-size: 16px;
        }
        .result-panel {
            background-color: #fff9c4; /* Màu vàng nhạt giống hình */
            padding: 10px;
            margin-bottom: 15px;
            text-align: center;
            font-size: 15px;
            border: 1px solid #f9e79f;
            min-height: 1.2em;
        }
        .button-group {
            text-align: center;
        }
        input[type="submit"] {
            padding: 5px 20px;
            cursor: pointer;
            background-color: #5dade2;
            color: white;
            border: 1px solid #2e86c1;
            font-size: 16px;
            border-radius: 4px;
        }
        input[type="submit"]:hover {
            background-color: #3498db;
        }
    </style>
</head>
<body>

<?php
// Mặc định tên file là mang_nam_nhuan.php theo hướng dẫn
// Nhưng tôi đặt trong Bai2.php để đồng nhất với các bài trước

function nam_nhuan($nam) {
    if (($nam % 400 == 0) || ($nam % 4 == 0 && $nam % 100 != 0)) {
        return 1; // Là năm nhuận
    }
    return 0; // Không là năm nhuận
}

$nam_input = "";
$kq = "";

if (isset($_POST["nam_input"])) {
    $nam_input = $_POST["nam_input"];
    
    if (is_numeric($nam_input)) {
        $nam_val = (int)$nam_input;
        $mang_nam_nhuan = array();
        
        // Dùng vòng lặp foreach với hàm range(2000, $nam)
        foreach (range(2000, $nam_val) as $year) {
            if (nam_nhuan($year)) {
                $mang_nam_nhuan[] = $year;
            }
        }
        
        if (count($mang_nam_nhuan) > 0) {
            $kq = implode(" ", $mang_nam_nhuan) . " là năm nhuận";
        } else {
            $kq = "Không có năm nhuận";
        }
    }
}
?>

<div class="container">
    <div class="header">
        <h2>TÌM NĂM NHUẬN</h2>
    </div>
    <form action="Bai2.php" method="post" name="form_nam_nhuan">
        <div class="form-group">
            <label for="nam_input">Năm:</label>
            <input type="text" name="nam_input" id="nam_input" value="<?php echo htmlspecialchars($nam_input); ?>" required>
        </div>
        
        <?php if ($kq !== ""): ?>
        <div class="result-panel">
            <?php echo $kq; ?>
        </div>
        <?php endif; ?>
        
        <div class="button-group">
            <input type="submit" name="btn_tim" value="Tìm năm nhuận">
        </div>
    </form>
</div>

</body>
</html>
