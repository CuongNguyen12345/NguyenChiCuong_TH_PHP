CREATE DATABASE IF NOT EXISTS ajax_lab CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ajax_lab;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users (email) VALUES
('admin@example.com'),
('user@test.com'),
('contact@company.com'),
('info@website.vn'),
('support@service.com')
ON DUPLICATE KEY UPDATE email = VALUES(email);
