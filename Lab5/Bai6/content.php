<?php
// Nhận tham số category
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Làm sạch dữ liệu
$category = htmlspecialchars($category, ENT_QUOTES, 'UTF-8');

// Giả lập thời gian xử lý
usleep(500000); // 0.5 giây

// Dữ liệu mẫu cho từng danh mục
$contents = [
    'tintuc' => [
        [
            'title' => 'Kinh tế Việt Nam tăng trưởng mạnh trong quý I/2024',
            'content' => 'Theo số liệu từ Tổng cục Thống kê, GDP quý I/2024 tăng 6.5% so với cùng kỳ năm trước, cao hơn mức dự báo của các chuyên gia kinh tế.'
        ],
        [
            'title' => 'Chính phủ công bố gói hỗ trợ mới cho doanh nghiệp nhỏ',
            'content' => 'Gói hỗ trợ trị giá 50,000 tỷ đồng nhằm giúp các doanh nghiệp vừa và nhỏ vượt qua khó khăn, tập trung vào lĩnh vực công nghệ và xuất khẩu.'
        ],
        [
            'title' => 'Thị trường bất động sản có dấu hiệu phục hồi',
            'content' => 'Số lượng giao dịch bất động sản tăng 25% trong tháng 3, cho thấy niềm tin của nhà đầu tư đang dần trở lại sau thời gian trầm lắng.'
        ]
    ],
    'thethao' => [
        [
            'title' => 'Đội tuyển Việt Nam thắng đậm 3-0 trước đối thủ',
            'content' => 'Trong trận đấu vòng loại World Cup 2026, đội tuyển Việt Nam đã có chiến thắng thuyết phục với tỷ số 3-0, qua đó củng cố vị trí đầu bảng.'
        ],
        [
            'title' => 'VĐV Nguyễn Văn A giành HCV SEA Games',
            'content' => 'Với thành tích xuất sắc 9.85 giây ở nội dung chạy 100m, VĐV Nguyễn Văn A đã mang về tấm HCV thứ 10 cho đoàn thể thao Việt Nam.'
        ],
        [
            'title' => 'Giải bóng đá V-League 2024 khởi tranh sôi nổi',
            'content' => 'Mùa giải mới hứa hẹn nhiều bất ngờ với sự tham gia của các ngoại binh chất lượng và đầu tư mạnh mẽ từ các CLB.'
        ]
    ],
    'congnghe' => [
        [
            'title' => 'AI ChatGPT-5 chính thức ra mắt với nhiều cải tiến',
            'content' => 'OpenAI công bố phiên bản ChatGPT-5 với khả năng xử lý ngôn ngữ tự nhiên vượt trội, hỗ trợ đa phương thức và tốc độ phản hồi nhanh hơn 40%.'
        ],
        [
            'title' => 'Apple ra mắt iPhone 16 với chip A18 Bionic',
            'content' => 'Sản phẩm mới nhất của Apple được trang bị chip A18 Bionic mạnh mẽ, camera 50MP và pin có thời lượng sử dụng lên đến 30 giờ.'
        ],
        [
            'title' => 'Công nghệ 6G bắt đầu được thử nghiệm tại Việt Nam',
            'content' => 'Các nhà mạng lớn đã bắt đầu triển khai thử nghiệm mạng 6G với tốc độ truyền tải dữ liệu lên đến 1 Tbps, nhanh gấp 100 lần 5G.'
        ]
    ]
];

// Kiểm tra category có tồn tại không
if (!isset($contents[$category])) {
    echo '<p style="color: red; text-align: center;">Danh mục không tồn tại!</p>';
    exit;
}

// Hiển thị nội dung
$items = $contents[$category];
$categoryNames = [
    'tintuc' => 'Tin tức',
    'thethao' => 'Thể thao',
    'congnghe' => 'Công nghệ'
];

echo '<h2>Danh mục: ' . $categoryNames[$category] . '</h2>';

foreach ($items as $item) {
    echo '<div class="content-item">';
    echo '<h3>' . $item['title'] . '</h3>';
    echo '<p>' . $item['content'] . '</p>';
    echo '<p class="timestamp">Cập nhật: ' . date('H:i:s d/m/Y') . '</p>';
    echo '</div>';
}
?>
