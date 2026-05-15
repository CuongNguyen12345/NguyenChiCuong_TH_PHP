-- Tạo cơ sở dữ liệu
CREATE DATABASE IF NOT EXISTS web_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE web_db;

-- Tạo bảng news
CREATE TABLE IF NOT EXISTS news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    summary TEXT NOT NULL,
    content LONGTEXT NOT NULL,
    category VARCHAR(50) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_category (category),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Thêm dữ liệu mẫu (15 bài viết)
INSERT INTO news (title, summary, content, category, created_at) VALUES
('AI và Machine Learning đang thay đổi thế giới', 
 'Trí tuệ nhân tạo đang tạo ra cuộc cách mạng trong mọi lĩnh vực từ y tế đến giáo dục.',
 'Công nghệ AI và Machine Learning đang phát triển với tốc độ chóng mặt. Các ứng dụng từ nhận diện khuôn mặt, xe tự lái đến chẩn đoán y khoa đều sử dụng AI. Theo dự báo, thị trường AI toàn cầu sẽ đạt 500 tỷ USD vào năm 2024.',
 'Công nghệ', NOW() - INTERVAL 1 HOUR),

('Smartphone 5G giá rẻ tràn ngập thị trường', 
 'Các hãng điện thoại Trung Quốc đang tung ra hàng loạt smartphone 5G với giá dưới 5 triệu đồng.',
 'Thị trường smartphone 5G đang chứng kiến sự cạnh tranh gay gắt. Xiaomi, Realme, OPPO đều tung ra các mẫu máy 5G giá rẻ với cấu hình mạnh mẽ, thách thức các thương hiệu cao cấp như Samsung và Apple.',
 'Công nghệ', NOW() - INTERVAL 2 HOUR),

('Bóng đá Việt Nam vươn tầm châu lục', 
 'Đội tuyển Việt Nam đang có phong độ ấn tượng tại vòng loại World Cup 2026.',
 'Với chiến thắng 3-0 trước đối thủ mạnh, đội tuyển Việt Nam đã chứng tỏ sức mạnh và quyết tâm. HLV Park Hang-seo đã xây dựng được một đội hình vững chắc với lối chơi tấn công hấp dẫn.',
 'Thể thao', NOW() - INTERVAL 3 HOUR),

('Kinh tế số Việt Nam tăng trưởng 25%', 
 'Báo cáo mới nhất cho thấy kinh tế số Việt Nam đạt mức tăng trưởng ấn tượng trong năm 2024.',
 'Thương mại điện tử, fintech và các dịch vụ số đang bùng nổ tại Việt Nam. Doanh thu thương mại điện tử đạt 20 tỷ USD, tăng 30% so với năm trước. Các startup công nghệ Việt Nam cũng thu hút được nhiều vốn đầu tư nước ngoài.',
 'Đời sống', NOW() - INTERVAL 4 HOUR),

('Công nghệ blockchain ứng dụng trong y tế', 
 'Các bệnh viện lớn bắt đầu triển khai blockchain để quản lý hồ sơ bệnh án điện tử.',
 'Blockchain giúp bảo mật thông tin bệnh nhân tuyệt đối và cho phép chia sẻ dữ liệu y tế an toàn giữa các cơ sở y tế. Bệnh viện Chợ Rẫy và Bạch Mai đã thí điểm thành công hệ thống này.',
 'Công nghệ', NOW() - INTERVAL 5 HOUR),

('SEA Games 2024: Việt Nam dẫn đầu bảng xếp hạng', 
 'Đoàn thể thao Việt Nam đã giành được 50 huy chương vàng sau 5 ngày thi đấu.',
 'Các VĐV Việt Nam thi đấu xuất sắc ở nhiều môn như bơi lội, điền kinh, võ thuật. Đặc biệt, đội tuyển bóng đá nam đã vào chung kết sau chiến thắng kịch tính 2-1 trước Thái Lan.',
 'Thể thao', NOW() - INTERVAL 6 HOUR),

('Du lịch Việt Nam hút khách quốc tế', 
 'Lượng khách quốc tế đến Việt Nam tăng 40% trong quý đầu năm 2024.',
 'Hạ Long, Phú Quốc, Đà Nẵng là những điểm đến được yêu thích nhất. Chính phủ đã nới lỏng visa và đầu tư mạnh vào cơ sở hạ tầng du lịch, thu hút hàng triệu lượt khách mỗi năm.',
 'Đời sống', NOW() - INTERVAL 7 HOUR),

('Xe điện VinFast chinh phục thị trường Mỹ', 
 'VinFast đã bàn giao hơn 5,000 xe điện cho khách hàng Mỹ trong tháng đầu tiên.',
 'Mẫu xe VF8 và VF9 nhận được đánh giá tích cực từ báo chí và người tiêu dùng Mỹ. VinFast đang mở rộng mạng lưới showroom và trạm sạc trên toàn nước Mỹ.',
 'Công nghệ', NOW() - INTERVAL 8 HOUR),

('Giải tennis Vietnam Open 2024 khai mạc', 
 'Giải đấu quy tụ hơn 100 tay vợt hàng đầu thế giới tại Hà Nội.',
 'Đây là lần đầu tiên Việt Nam tổ chức giải tennis quốc tế cấp ATP. Tay vợt số 1 Việt Nam Lý Hoàng Nam sẽ đối đầu với các đối thủ mạnh từ Nhật Bản và Hàn Quốc.',
 'Thể thao', NOW() - INTERVAL 9 HOUR),

('Giá vàng tăng cao kỷ lục', 
 'Giá vàng trong nước vượt mốc 80 triệu đồng/lượng do căng thẳng địa chính trị.',
 'Nhà đầu tư đổ xô mua vàng để trú ẩn an toàn. Các chuyên gia dự báo giá vàng có thể tiếp tục tăng trong thời gian tới do lạm phát và bất ổn kinh tế toàn cầu.',
 'Đời sống', NOW() - INTERVAL 10 HOUR),

('Quantum Computing: Bước đột phá mới', 
 'Google công bố máy tính lượng tử có khả năng giải quyết bài toán trong 200 giây.',
 'Máy tính lượng tử Sycamore của Google đã hoàn thành tác vụ mà siêu máy tính thông thường cần 10,000 năm. Đây là bước tiến quan trọng trong lĩnh vực điện toán lượng tử.',
 'Công nghệ', NOW() - INTERVAL 11 HOUR),

('World Cup 2026: Việt Nam có cơ hội lịch sử', 
 'Đội tuyển Việt Nam đang đứng thứ 2 bảng, rất gần với tấm vé dự World Cup.',
 'Nếu giành chiến thắng trong 2 trận còn lại, Việt Nam sẽ lần đầu tiên góp mặt tại World Cup. Người hâm mộ cả nước đang háo hức chờ đợi kỳ tích này.',
 'Thể thao', NOW() - INTERVAL 12 HOUR),

('Startup Việt gọi vốn thành công 50 triệu USD', 
 'Công ty công nghệ giáo dục ELSA nhận được khoản đầu tư lớn từ quỹ nước ngoài.',
 'ELSA, ứng dụng học tiếng Anh bằng AI, đã có hơn 30 triệu người dùng toàn cầu. Khoản vốn mới sẽ được sử dụng để mở rộng thị trường và phát triển tính năng mới.',
 'Công nghệ', NOW() - INTERVAL 13 HOUR),

('Lễ hội văn hóa ẩm thực Việt Nam', 
 'Hơn 100 gian hàng giới thiệu đặc sản từ 63 tỉnh thành tại Hà Nội.',
 'Lễ hội thu hút hàng nghìn du khách trong và ngoài nước. Phở, bánh mì, bún chả Việt Nam được giới thiệu như những món ăn đặc trưng của ẩm thực Đông Nam Á.',
 'Đời sống', NOW() - INTERVAL 14 HOUR),

('Marathon quốc tế TP.HCM 2024', 
 'Hơn 10,000 vận động viên từ 50 quốc gia tham gia giải chạy marathon.',
 'Giải đấu diễn ra trên các tuyến đường đẹp nhất Sài Gòn. VĐV Kenya giành giải nhất nam với thành tích 2 giờ 8 phút, còn VĐV Việt Nam đứng thứ 5 chung cuộc.',
 'Thể thao', NOW() - INTERVAL 15 HOUR);
