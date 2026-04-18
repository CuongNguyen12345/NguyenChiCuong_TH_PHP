<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 3 (Array): Tính năm âm lịch</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f4f8;
        }
        .container {
            width: 550px;
            background-color: #a9dcef; /* Màu xanh da trời nhạt */
            border: 1px solid #3498db;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        .header {
            background-color: #1a5276; /* Màu xanh đậm */
            padding: 12px;
        }
        .header h2 {
            margin: 0;
            color: white;
            font-family: "Times New Roman", Times, serif;
            font-style: italic;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 26px;
        }
        form {
            padding: 20px;
        }
        .form-row {
            display: flex;
            align-items: center;
            justify-content: space-around;
            margin-bottom: 20px;
        }
        .input-group, .output-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        label {
            font-size: 16px;
            color: #1a5276;
            font-weight: bold;
        }
        input[type="text"] {
            width: 140px;
            padding: 8px;
            border: 1px solid #3498db;
            outline: none;
            font-size: 18px;
            text-align: center;
        }
        .readonly {
            background-color: #fff9c4; /* Vàng nhạt */
            color: #b03a2e; /* Màu đỏ đậm */
            font-weight: bold;
        }
        input[type="submit"] {
            padding: 5px 15px;
            cursor: pointer;
            background-color: #f7dc6f;
            border: 1px solid #d4ac0d;
            font-size: 18px;
            font-weight: bold;
            color: #b03a2e;
        }
        .animal-img {
            margin-top: 10px;
            background-color: white;
            display: inline-block;
            padding: 10px;
            border-radius: 8px;
            width: 180px;
            height: 180px;
        }
        .animal-img img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>

<?php
$mang_can = array("Quý", "Giáp", "Ất", "Bính", "Đinh", "Mậu", "Kỷ", "Canh", "Tân", "Nhâm");
$mang_chi = array("Hợi", "Tý", "Sửu", "Dần", "Mão", "Thìn", "Tỵ", "Ngọ", "Mùi", "Thân", "Dậu", "Tuất");
$mang_hinh = array("hoi.png", "ty.png", "suu.png", "dan.png", "mao.png", "thin.png", "ran.png", "ngo.png", "mui.png", "than.png", "dau.png", "tuat.png");

$nam_dl = "";
$nam_al = "";
$hinh_anh = "";

if (isset($_POST["nam_dl"])) {
    $nam_dl = $_POST["nam_dl"];
    
    if (is_numeric($nam_dl)) {
        $nam = (int)$nam_dl;
        
        // Công thức tính Can Chi
        $temp_nam = $nam - 3;
        $can = $temp_nam % 10;
        $chi = $temp_nam % 12;
        
        $nam_al = $mang_can[$can] . " " . $mang_chi[$chi];
        $hinh = $mang_hinh[$chi];
        
        // Lưu ý: Đường dẫn ảnh cần tồn tại trong thư mục 12con_giap/
        $hinh_anh = "12con_giap/" . $hinh;
    }
}
?>

<div class="container">
    <div class="header">
        <h2>TÍNH NĂM ÂM LỊCH</h2>
    </div>
    <form action="Bai3.php" method="post">
        <div class="form-row">
            <div class="input-group">
                <label for="nam_dl">Năm dương lịch</label>
                <input type="text" name="nam_dl" id="nam_dl" value="<?php echo htmlspecialchars($nam_dl); ?>" required>
            </div>
            
            <input type="submit" value="=>">
            
            <div class="output-group">
                <label for="nam_al">Năm âm lịch</label>
                <input type="text" name="nam_al" id="nam_al" value="<?php echo htmlspecialchars($nam_al); ?>" class="readonly" readonly>
            </div>
        </div>
        
        <div class="result-image">
            <?php if ($hinh_anh !== ""): ?>
            <div class="animal-img">
                <img src="<?php echo $hinh_anh; ?>" alt="Con giáp">
            </div>
            <?php endif; ?>
        </div>
    </form>
</div>

</body>
</html>
