<?php
require_once __DIR__ . '/includes/db.php';

if (!empty($_SESSION['user_id'])) {
    redirect('product.php');
}

$pageTitle = 'Đăng nhập';
$error = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    try {
        $conn = db_connect();
        $stmt = $conn->prepare('SELECT id, fullname, email, password FROM users WHERE email = ? LIMIT 1');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = (int) $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['email'] = $user['email'];
            redirect('product.php');
        }

        $error = 'Email hoặc mật khẩu không đúng.';
    } catch (Throwable $e) {
        $error = $e->getMessage() . ' Hãy chạy init.php trước.';
    }
}

require_once __DIR__ . '/includes/header.php';
?>
<section class="panel">
    <h1>Đăng nhập</h1>
    <?php if ($error): ?>
        <div class="alert error"><?php echo h($error); ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="form-row">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="<?php echo h($email); ?>" required>
        </div>
        <div class="form-row">
            <label for="password">Mật khẩu</label>
            <input id="password" name="password" type="password" required>
        </div>
        <div class="actions">
            <button class="btn" type="submit">Đăng nhập</button>
            <a class="btn light" href="signup.php">Đăng ký tài khoản</a>
        </div>
    </form>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
