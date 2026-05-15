-- Tạo cơ sở dữ liệu
CREATE DATABASE IF NOT EXISTS ajax_lab CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE ajax_lab;

-- Tạo bảng members
CREATE TABLE IF NOT EXISTS members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user VARCHAR(50) NOT NULL UNIQUE,
    pass VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Thêm dữ liệu mẫu
INSERT INTO members (user, pass) VALUES 
('admin', MD5('admin123')),
('user1', MD5('password1')),
('nguyenvana', MD5('123456'));
