<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 8: Kết quả học tập</title>
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
            background-color: #fce4ec; /* Hồng nhạt */
            border: 1px solid #d81b60;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #d81b60; /* Hồng đậm */
            padding: 15px;
            text-align: center;
        }
        .header h2 {
            margin: 0;
            color: white;
            font-family: "Times New Roman", Times, serif;
            font-style: italic;
            text-transform: uppercase;
            font-size: 26px;
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
            width: 150px;
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
$hk1 = "";
$hk2 = "";
$dtb = "";
$ket_qua = "";
$xep_loai = "";

if (isset($_POST["hk1"]) && isset($_POST["hk2"])) {
    $hk1 = $_POST["hk1"];
    $hk2 = $_POST["hk2"];
    
    if (is_numeric($hk1) && is_numeric($hk2)) {
        // Tính ĐTB = (HK1 + HK2 * 2) / 3
        $dtb = ($hk1 + ($hk2 * 2)) / 3;
        $dtb = round($dtb, 1); // Làm tròn 1 chữ số thập phân
        
        // Xét kết quả
        if ($dtb >= 5) {
            $ket_qua = "Được lên lớp";
        } else {
            $ket_qua = "Ở lại lớp";
        }
        
        // Xét xếp loại
        if ($dtb >= 8) {
            $xep_loai = "Giỏi";
        } elseif ($dtb >= 6.5) {
            $xep_loai = "Khá";
        } elseif ($dtb >= 5) {
            $xep_loai = "Trung bình";
        } else {
            $xep_loai = "Yếu";
        }
    }
}
?>

<div class="container">
    <div class="header">
        <h2>KẾT QUẢ HỌC TẬP</h2>
    </div>
    <form action="Bai8.php" method="post" name="form_ket_qua">
        <div class="form-group">
            <label for="hk1">Điểm HK1:</label>
            <input type="text" name="hk1" id="hk1" value="<?php echo htmlspecialchars($hk1); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="hk2">Điểm HK2:</label>
            <input type="text" name="hk2" id="hk2" value="<?php echo htmlspecialchars($hk2); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="dtb">Điểm trung bình:</label>
            <input type="text" name="dtb" id="dtb" value="<?php echo htmlspecialchars($dtb); ?>" class="readonly" readonly>
        </div>
        
        <div class="form-group">
            <label for="ket_qua">Kết quả:</label>
            <input type="text" name="ket_qua" id="ket_qua" value="<?php echo htmlspecialchars($ket_qua); ?>" class="readonly" readonly>
        </div>
        
        <div class="form-group">
            <label for="xep_loai">Xếp loại học lực:</label>
            <input type="text" name="xep_loai" id="xep_loai" value="<?php echo htmlspecialchars($xep_loai); ?>" class="readonly" readonly>
        </div>
        
        <div class="button-group">
            <input type="submit" name="btn_xem" value="Xem kết quả">
        </div>
    </form>
</div>

</body>
</html>
