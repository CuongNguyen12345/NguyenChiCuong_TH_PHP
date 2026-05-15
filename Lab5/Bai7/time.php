<?php
// Thiết lập múi giờ Việt Nam
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Lấy thời gian hiện tại
$time = date('H:i:s');
$date = date('d/m/Y');
$dayOfWeek = date('l');

// Chuyển đổi tên ngày sang tiếng Việt
$daysVN = [
    'Monday' => 'Thứ Hai',
    'Tuesday' => 'Thứ Ba',
    'Wednesday' => 'Thứ Tư',
    'Thursday' => 'Thứ Năm',
    'Friday' => 'Thứ Sáu',
    'Saturday' => 'Thứ Bảy',
    'Sunday' => 'Chủ Nhật'
];

$dayVN = $daysVN[$dayOfWeek];

// Trả về dữ liệu dạng JSON
header('Content-Type: application/json; charset=utf-8');

echo json_encode([
    'time' => $time,
    'date' => $dayVN . ', ' . $date,
    'timestamp' => time()
], JSON_UNESCAPED_UNICODE);
?>
