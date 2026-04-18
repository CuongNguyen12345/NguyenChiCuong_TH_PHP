<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 6 (Array): Tìm kiếm</title>
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
            width: 150px;
            font-size: 15px;
            color: #1b2631;
        }
        input[type="text"] {
            flex: 1;
            padding: 5px;
            border: 1px solid #7f8c8d;
            outline: none;
            font-size: 15px;
        }
        .readonly {
            background-color: #e8f8f5; /* Xanh nhẹ cho mảng hiển thị */
            color: #1b2631;
        }
        .result-input {
            background-color: #d1f2eb;
            color: #c0392b; /* Chữ đỏ cho kết quả */
            font-weight: bold;
        }
        .button-group {
            text-align: center;
            margin: 15px 0;
            padding-left: 150px;
            display: flex;
        }
        input[type="submit"] {
            padding: 5px 25px;
            cursor: pointer;
            background-color: #5dade2; /* Màu xanh dương */
            border: 1px solid #2e86c1;
            color: #1b2631;
            font-size: 15px;
        }
        .footer-note {
            text-align: center;
            background-color: #16a085;
            color: white;
            padding: 5px;
            font-size: 13px;
        }
    </style>
</head>
<body>

<?php
function tim_kiem($mang, $gia_tri) {
    for ($i = 0; $i < count($mang); $i++) {
        if (trim($mang[$i]) == trim($gia_tri)) {
            return $i; // Trả về vị trí index
        }
    }
    return -1; // Không tìm thấy
}

$nhap_mang = "";
$so_tim = "";
$mang_hien_thi = "";
$ket_qua = "";

if (isset($_POST["nhap_mang"]) && isset($_POST["so_tim"])) {
    $nhap_mang = $_POST["nhap_mang"];
    $so_tim = $_POST["so_tim"];
    
    if (!empty($nhap_mang)) {
        // Tách chuỗi thành mảng
        $mang = explode(",", $nhap_mang);
        $mang_hien_thi = implode(", ", $mang);
        
        // Gọi hàm tìm kiếm
        $vi_tri = tim_kiem($mang, $so_tim);
        
        if ($vi_tri !== -1) {
            $stt = $vi_tri + 1;
            $ket_qua = "Tìm thấy " . $so_tim . " tại vị trí thứ " . $stt . " của mảng";
        } else {
            $ket_qua = "Không tìm thấy " . $so_tim . " trong mảng";
        }
    }
}
?>

<div class="container">
    <div class="header">
        <h2>TÌM KIẾM</h2>
    </div>
    <form action="Bai6.php" method="post">
        <div class="form-group">
            <label for="nhap_mang">Nhập mảng:</label>
            <input type="text" name="nhap_mang" id="nhap_mang" value="<?php echo htmlspecialchars($nhap_mang); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="so_tim">Nhập số cần tìm:</label>
            <input type="text" name="so_tim" id="so_tim" style="max-width: 100px;" value="<?php echo htmlspecialchars($so_tim); ?>" required>
        </div>
        
        <div class="button-group">
            <input type="submit" value="Tìm kiếm">
        </div>
        
        <div class="form-group">
            <label for="mang_hien_thi">Mảng:</label>
            <input type="text" name="mang_hien_thi" id="mang_hien_thi" value="<?php echo htmlspecialchars($mang_hien_thi); ?>" class="readonly" readonly>
        </div>
        
        <div class="form-group">
            <label for="ket_qua">Kết quả tìm kiếm:</label>
            <input type="text" name="ket_qua" id="ket_qua" value="<?php echo htmlspecialchars($ket_qua); ?>" class="result-input" readonly>
        </div>
    </form>
    <div class="footer-note">
        (Các phần tử trong mảng sẽ cách nhau bằng dấu ",")
    </div>
</div>

</body>
</html>
