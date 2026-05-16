<?php
require_once __DIR__ . '/includes/db.php';

if (!empty($_SESSION['user_id'])) {
    redirect('product.php');
}

$pageTitle = 'Đăng ký tài khoản';
$errors = [];
$old = [
    'fullname' => '',
    'email' => '',
    'birthday' => '',
    'address' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old['fullname'] = trim($_POST['fullname'] ?? '');
    $old['email'] = trim($_POST['email'] ?? '');
    $old['birthday'] = trim($_POST['birthday'] ?? '');
    $old['address'] = trim($_POST['address'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($old['fullname'] === '') {
        $errors[] = 'Vui lòng nhập họ tên.';
    }

    if (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email không hợp lệ.';
    }

    if ($password === '') {
        $errors[] = 'Vui lòng nhập mật khẩu.';
    }

    if ($old['birthday'] === '') {
        $errors[] = 'Vui lòng chọn ngày sinh.';
    }

    if ($old['address'] === '') {
        $errors[] = 'Vui lòng nhập địa chỉ.';
    }

    if (!$errors) {
        try {
            $conn = db_connect();

            $stmt = $conn->prepare('SELECT id FROM users WHERE email = ? LIMIT 1');
            $stmt->bind_param('s', $old['email']);
            $stmt->execute();
            $exists = $stmt->get_result()->fetch_assoc();

            if ($exists) {
                $errors[] = 'Email đã được sử dụng.';
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare('INSERT INTO users (fullname, email, password, birthday, address) VALUES (?, ?, ?, ?, ?)');
                $stmt->bind_param('sssss', $old['fullname'], $old['email'], $hash, $old['birthday'], $old['address']);
                $stmt->execute();

                flash('success', 'Đăng ký thành công. Vui lòng đăng nhập.');
                redirect('login.php');
            }
        } catch (Throwable $e) {
            $errors[] = $e->getMessage() . ' Hãy chạy init.php trước.';
        }
    }
}

require_once __DIR__ . '/includes/header.php';
?>
<section class="panel">
    <h1>Đăng ký tài khoản</h1>
    <?php foreach ($errors as $error): ?>
        <div class="alert error"><?php echo h($error); ?></div>
    <?php endforeach; ?>

    <form method="post">
        <div class="grid">
            <div class="form-row">
                <label for="fullname">Họ tên</label>
                <input id="fullname" name="fullname" type="text" value="<?php echo h($old['fullname']); ?>" required>
            </div>
            <div class="form-row">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" value="<?php echo h($old['email']); ?>" required>
            </div>
            <div class="form-row">
                <label for="password">Mật khẩu</label>
                <input id="password" name="password" type="password" required>
            </div>
            <div class="form-row">
                <label for="birthday">Ngày sinh</label>
                <input id="birthday" name="birthday" type="date" value="<?php echo h($old['birthday']); ?>" required>
            </div>
        </div>
        <div class="form-row">
            <label for="address">Địa chỉ</label>
            <input id="address" name="address" type="text" value="<?php echo h($old['address']); ?>" required>
        </div>
        <div class="actions">
            <button class="btn" type="submit">Đăng ký</button>
            <a class="btn light" href="login.php">Đã có tài khoản</a>
        </div>
    </form>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
