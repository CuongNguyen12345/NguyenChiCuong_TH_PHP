CREATE DATABASE IF NOT EXISTS ajax_lab CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ajax_lab;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    price VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY idx_product_title (title)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO products (title, price, description, created_at) VALUES
('Laptop Dell XPS 13', '25990000', 'Laptop cao cap, man hinh 13.3 inch, CPU Intel Core i7 the he moi', NOW() - INTERVAL 1 HOUR),
('iPhone 15 Pro Max', '34990000', 'Smartphone flagship cua Apple, chip A17 Pro, camera 48MP', NOW() - INTERVAL 2 HOUR),
('Samsung Galaxy S24 Ultra', '31990000', 'Dien thoai Android cao cap, man hinh 6.8 inch, S Pen tich hop', NOW() - INTERVAL 3 HOUR),
('MacBook Pro M3', '42990000', 'Laptop Apple voi chip M3, hieu nang cao cho cong viec sang tao', NOW() - INTERVAL 4 HOUR),
('iPad Air M2', '16990000', 'May tinh bang da nang, chip M2, ho tro Apple Pencil the he 2', NOW() - INTERVAL 5 HOUR),
('Tai nghe Sony WH-1000XM5', '7990000', 'Tai nghe chong on cao cap, pin lau, ket noi Bluetooth', NOW() - INTERVAL 6 HOUR)
ON DUPLICATE KEY UPDATE
price = VALUES(price),
description = VALUES(description),
created_at = VALUES(created_at);
