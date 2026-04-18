<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 9 (Array): Danh lam thắng cảnh</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 20px;
        }
        .container {
            width: 800px;
            margin: 0 auto;
            background-color: #c0c080; /* Màu nền vàng úa giống hình */
            border: 2px solid #808000;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #808040; /* Màu olive đậm */
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
        .main-content {
            display: flex;
            min-height: 500px;
        }
        .sidebar {
            width: 30%;
            background-color: #fdfdfd;
            border-right: 2px solid #808000;
            padding: 15px;
        }
        .sidebar h3 {
            font-size: 16px;
            margin-top: 0;
            color: #404000;
        }
        .sidebar a {
            display: block;
            color: blue;
            text-decoration: underline;
            margin-bottom: 5px;
            font-size: 14px;
        }
        .content-area {
            width: 70%;
            padding: 20px;
            background-color: white;
        }
        .attraction-item {
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 1px dashed #ccc;
            padding-bottom: 20px;
        }
        .attraction-item h3 {
            color: #000;
            font-size: 18px;
        }
        .attraction-item img {
            max-width: 300px;
            border: 1px solid #ddd;
            padding: 5px;
            margin: 10px 0;
        }
        .back-to-top {
            display: block;
            font-size: 12px;
            color: blue;
            text-decoration: underline;
        }
        a[name] {
            display: block;
            position: relative;
            top: -20px;
            visibility: hidden;
        }
    </style>
</head>
<body>

<a name="top"></a>

<?php
$mang_dia_danh = array(
    array("ma" => "nt", "ten" => "Biển Nha Trang", "hinh" => "nha_trang.png"),
    array("ma" => "dl", "ten" => "Thành phố Đà Lạt", "hinh" => "da_lat.png"),
    array("ma" => "vt", "ten" => "Biển Vũng Tàu", "hinh" => "vung_tau.png"),
    array("ma" => "hl", "ten" => "Vịnh Hạ Long", "hinh" => "ha_long.png"),
    array("ma" => "pt", "ten" => "Biển Phan Thiết", "hinh" => "phan_thiet.png"),
    array("ma" => "ht", "ten" => "Biển Hà Tiên", "hinh" => "ha_tien.png"),
    array("ma" => "pq", "ten" => "Đảo Phú Quốc", "hinh" => "phu_quoc.png")
);

// Chuẩn bị danh sách liên kết bên trái
$danh_sach_link = "";
foreach ($mang_dia_danh as $item) {
    $ten = $item['ten'];
    $ma = $item['ma'];
    $danh_sach_link .= "<a href='#$ma'><b>$ten</b></a>";
}

// Chuẩn bị chi tiết bên phải
$nội_dung_chi_tiết = "";
foreach ($mang_dia_danh as $item) {
    $ma = $item['ma'];
    $ten = $item['ten'];
    $hinh = $item['hinh'];
    
    // Đường dẫn hình ảnh - Mặc định trong thư mục thang_canh/
    $duong_dan_hinh = "thang_canh/$hinh";
    
    // Kiểm tra nếu file không tồn tại thì dùng placeholder (trừ 2 cái đã tạo)
    if ($ma != 'nt' && $ma != 'dl') {
        $duong_dan_hinh = "https://via.placeholder.com/300x200?text=" . urlencode($ten);
    }
    
    $nội_dung_chi_tiết .= "
    <div class='attraction-item'>
        <a name='$ma'></a>
        <h3>$ten</h3>
        <img src='$duong_dan_hinh' alt='$ten'>
        <br>
        <a href='#top' class='back-to-top'>Quay về đầu trang</a>
    </div>";
}
?>

<div class="container">
    <div class="header">
        <h2>DANH LAM THẮNG CẢNH</h2>
    </div>
    <div class="main-content">
        <div class="sidebar">
            <h3>Danh sách địa danh</h3>
            <?php echo $danh_sach_link; ?>
        </div>
        <div class="content-area">
            <?php echo $nội_dung_chi_tiết; ?>
        </div>
    </div>
</div>

</body>
</html>
