<?php
require_once __DIR__ . '/includes/db.php';

$pageTitle = 'Khởi tạo cơ sở dữ liệu';
$message = 'Khởi tạo cơ sở dữ liệu cho hệ thống quản lý sản phẩm.';
$messageType = 'info';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $conn = db_connect(false);
        $conn->query("CREATE DATABASE IF NOT EXISTS " . DB_NAME . " CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        $conn->select_db(DB_NAME);

        $conn->query("
            CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                fullname VARCHAR(100) NOT NULL,
                email VARCHAR(100) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                address VARCHAR(255) NOT NULL,
                birthday DATE NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");

        $conn->query("
            CREATE TABLE IF NOT EXISTS products (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                name VARCHAR(150) NOT NULL,
                description TEXT,
                price DECIMAL(10,2) NOT NULL DEFAULT 0,
                created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                CONSTRAINT fk_products_users
                    FOREIGN KEY (user_id) REFERENCES users(id)
                    ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");

        $message = 'Tạo database và bảng thành công!';
        $messageType = 'success';
    } catch (Throwable $e) {
        $message = $e->getMessage();
        $messageType = 'error';
    }
}

require_once __DIR__ . '/includes/header.php';
?>
<section class="panel">
    <h1>Khởi tạo dữ liệu</h1>
    <div class="alert <?php echo h($messageType); ?>"><?php echo h($message); ?></div>
    <form method="post">
        <button class="btn" type="submit">Khởi tạo dữ liệu</button>
        <a class="btn light" href="signup.php">Đăng ký tài khoản</a>
    </form>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
