<?php
$pageTitle = $pageTitle ?? 'Quản lý sản phẩm';
$flashMessage = get_flash();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo h($pageTitle); ?></title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f5f7;
            color: #263238;
        }

        a {
            color: #1565c0;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .topbar {
            background: #263238;
            color: #fff;
            padding: 14px 24px;
        }

        .topbar-inner {
            max-width: 1120px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }

        .brand {
            font-size: 20px;
            font-weight: 700;
            color: #fff;
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .nav a {
            color: #fff;
            opacity: .9;
        }

        .nav .user {
            color: #cfd8dc;
        }

        .container {
            max-width: 1120px;
            margin: 24px auto;
            padding: 0 16px;
        }

        .panel {
            background: #fff;
            border: 1px solid #dfe5ea;
            border-radius: 8px;
            padding: 22px;
            margin-bottom: 18px;
            box-shadow: 0 2px 10px rgba(38, 50, 56, .06);
        }

        h1, h2 {
            margin: 0 0 18px;
            color: #1f2d35;
        }

        h1 {
            font-size: 28px;
        }

        h2 {
            font-size: 20px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .form-row {
            margin-bottom: 14px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 700;
            color: #37474f;
        }

        input, textarea, select {
            width: 100%;
            min-height: 42px;
            padding: 10px 12px;
            border: 1px solid #bcc8d1;
            border-radius: 6px;
            font-size: 15px;
            font-family: inherit;
            background: #fff;
        }

        textarea {
            min-height: 88px;
            resize: vertical;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #1976d2;
            box-shadow: 0 0 0 3px rgba(25, 118, 210, .12);
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 9px 14px;
            border: 1px solid transparent;
            border-radius: 6px;
            background: #1976d2;
            color: #fff;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .btn:hover {
            background: #115293;
            text-decoration: none;
        }

        .btn.secondary {
            background: #607d8b;
        }

        .btn.secondary:hover {
            background: #455a64;
        }

        .btn.danger {
            background: #c62828;
        }

        .btn.danger:hover {
            background: #8e1b1b;
        }

        .btn.light {
            color: #263238;
            background: #eceff1;
            border-color: #cfd8dc;
        }

        .btn.light:hover {
            background: #dfe5ea;
        }

        .alert {
            padding: 12px 14px;
            border-radius: 6px;
            margin-bottom: 18px;
            border: 1px solid transparent;
        }

        .alert.success {
            background: #e8f5e9;
            color: #1b5e20;
            border-color: #a5d6a7;
        }

        .alert.error {
            background: #ffebee;
            color: #b71c1c;
            border-color: #ef9a9a;
        }

        .alert.info {
            background: #e3f2fd;
            color: #0d47a1;
            border-color: #90caf9;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #dfe5ea;
            text-align: left;
            vertical-align: middle;
        }

        th {
            background: #f5f7f9;
            color: #37474f;
        }

        .muted {
            color: #607d8b;
        }

        .search-bar {
            display: grid;
            grid-template-columns: minmax(180px, 1fr) 220px auto;
            gap: 12px;
            align-items: end;
        }

        .search-bar .form-row {
            margin-bottom: 0;
        }

        .search-bar .actions {
            align-items: end;
        }

        td .actions {
            align-items: center;
            flex-wrap: nowrap;
        }

        td form {
            margin: 0;
        }

        td .btn {
            min-width: 62px;
            white-space: nowrap;
        }

        .pagination {
            display: flex;
            gap: 8px;
            margin-top: 16px;
            flex-wrap: wrap;
        }

        .pagination a,
        .pagination span {
            min-width: 36px;
            padding: 8px 10px;
            border-radius: 6px;
            border: 1px solid #cfd8dc;
            text-align: center;
            background: #fff;
        }

        .pagination .active {
            background: #1976d2;
            color: #fff;
            border-color: #1976d2;
        }

        @media (max-width: 760px) {
            .grid,
            .search-bar {
                grid-template-columns: 1fr;
            }

            .topbar-inner {
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <header class="topbar">
        <div class="topbar-inner">
            <a class="brand" href="product.php">Lab6</a>
            <nav class="nav">
                <a href="init.php">Khởi tạo</a>
                <?php if (!empty($_SESSION['user_id'])): ?>
                    <span class="user">Xin chào, <?php echo h($_SESSION['fullname'] ?? 'User'); ?></span>
                    <a href="product.php">Sản phẩm</a>
                    <a href="logout.php">Đăng xuất</a>
                <?php else: ?>
                    <a href="signup.php">Đăng ký</a>
                    <a href="login.php">Đăng nhập</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
    <main class="container">
        <?php if ($flashMessage): ?>
            <div class="alert <?php echo h($flashMessage['type']); ?>">
                <?php echo h($flashMessage['message']); ?>
            </div>
        <?php endif; ?>
