<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 9: Kết quả thi đại học</title>
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
        .diem-chuan {
            color: red;
            font-weight: bold;
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
$toan = "";
$ly = "";
$hoa = "";
$diem_chuan = "";
$tong_diem = "";
$ket_qua = "";

if (isset($_POST["toan"]) && isset($_POST["ly"]) && isset($_POST["hoa"]) && isset($_POST["diem_chuan"])) {
    $toan = $_POST["toan"];
    $ly = $_POST["ly"];
    $hoa = $_POST["hoa"];
    $diem_chuan = $_POST["diem_chuan"];
    
    if (is_numeric($toan) && is_numeric($ly) && is_numeric($hoa) && is_numeric($diem_chuan)) {
        // Tính tổng điểm
        $tong_diem = $toan + $ly + $hoa;
        
        // Xét kết quả
        // Điều kiện: Không môn nào bằng 0 VÀ tổng điểm >= điểm chuẩn
        if ($toan > 0 && $ly > 0 && $hoa > 0 && $tong_diem >= $diem_chuan) {
            $ket_qua = "Đậu";
        } else {
            $ket_qua = "Rớt";
        }
    }
}
?>

<div class="container">
    <div class="header">
        <h2>KẾT QUẢ THI ĐẠI HỌC</h2>
    </div>
    <form action="Bai9.php" method="post" name="form_thi_dai_hoc">
        <div class="form-group">
            <label for="toan">Toán:</label>
            <input type="text" name="toan" id="toan" value="<?php echo htmlspecialchars($toan); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="ly">Lý:</label>
            <input type="text" name="ly" id="ly" value="<?php echo htmlspecialchars($ly); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="hoa">Hoá:</label>
            <input type="text" name="hoa" id="hoa" value="<?php echo htmlspecialchars($hoa); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="diem_chuan">Điểm chuẩn:</label>
            <input type="text" name="diem_chuan" id="diem_chuan" class="diem-chuan" value="<?php echo htmlspecialchars($diem_chuan); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="tong_diem">Tổng điểm:</label>
            <input type="text" name="tong_diem" id="tong_diem" value="<?php echo htmlspecialchars($tong_diem); ?>" class="readonly" readonly>
        </div>
        
        <div class="form-group">
            <label for="ket_qua">Kết quả thi:</label>
            <input type="text" name="ket_qua" id="ket_qua" value="<?php echo htmlspecialchars($ket_qua); ?>" class="readonly" readonly>
        </div>
        
        <div class="button-group">
            <input type="submit" name="btn_xem" value="Xem kết quả">
        </div>
    </form>
</div>

</body>
</html>
