<?php
require_once __DIR__ . '/includes/db.php';

if (empty($_SESSION['user_id'])) {
    redirect('login.php');
}

$pageTitle = 'Quản lý sản phẩm';
$search = trim($_GET['search'] ?? '');
$sort = $_GET['sort'] ?? 'created_desc';
$page = max(1, (int) ($_GET['page'] ?? 1));
$limit = 5;
$offset = ($page - 1) * $limit;
$allowedSorts = [
    'price_asc' => 'price ASC',
    'price_desc' => 'price DESC',
    'created_asc' => 'created_at ASC',
    'created_desc' => 'created_at DESC',
];
$orderBy = $allowedSorts[$sort] ?? $allowedSorts['created_desc'];
$sort = array_key_exists($sort, $allowedSorts) ? $sort : 'created_desc';
$products = [];
$editProduct = null;
$totalProducts = 0;
$totalPages = 1;
$loadError = '';

try {
    $conn = db_connect();
    $userId = current_user_id();

    $where = 'WHERE user_id = ?';
    $types = 'i';
    $params = [$userId];

    if ($search !== '') {
        $where .= ' AND name LIKE ?';
        $types .= 's';
        $keyword = '%' . $search . '%';
        $params[] = $keyword;
    }

    $countSql = "SELECT COUNT(*) AS total FROM products $where";
    $stmt = $conn->prepare($countSql);
    bind_params($stmt, $types, $params);
    $stmt->execute();
    $totalProducts = (int) $stmt->get_result()->fetch_assoc()['total'];
    $totalPages = max(1, (int) ceil($totalProducts / $limit));

    if ($page > $totalPages) {
        $page = $totalPages;
        $offset = ($page - 1) * $limit;
    }

    $listSql = "SELECT id, name, description, price, created_at, updated_at
                FROM products
                $where
                ORDER BY $orderBy
                LIMIT ? OFFSET ?";
    $listTypes = $types . 'ii';
    $listParams = $params;
    $listParams[] = $limit;
    $listParams[] = $offset;
    $stmt = $conn->prepare($listSql);
    bind_params($stmt, $listTypes, $listParams);
    $stmt->execute();
    $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    $editId = (int) ($_GET['edit'] ?? 0);
    if ($editId > 0) {
        $stmt = $conn->prepare('SELECT id, name, description, price FROM products WHERE id = ? AND user_id = ? LIMIT 1');
        $stmt->bind_param('ii', $editId, $userId);
        $stmt->execute();
        $editProduct = $stmt->get_result()->fetch_assoc();
    }
} catch (Throwable $e) {
    $loadError = $e->getMessage() . ' Hãy chạy init.php trước.';
}

function product_query(array $extra = [])
{
    $query = array_merge([
        'search' => $_GET['search'] ?? '',
        'sort' => $_GET['sort'] ?? 'created_desc',
    ], $extra);

    return http_build_query(array_filter($query, function ($value) {
        return $value !== '' && $value !== null;
    }));
}

require_once __DIR__ . '/includes/header.php';
?>
<section class="panel">
    <h1>Danh sách sản phẩm</h1>
    <?php if ($loadError): ?>
        <div class="alert error"><?php echo h($loadError); ?></div>
        <a class="btn" href="init.php">Khởi tạo dữ liệu</a>
    <?php else: ?>
        <form class="search-bar" method="get" action="actions/search_product.php">
            <div class="form-row">
                <label for="search">Tìm kiếm theo tên</label>
                <input id="search" name="search" type="text" value="<?php echo h($search); ?>" placeholder="Nhập tên sản phẩm">
            </div>
            <div class="form-row">
                <label for="sort">Sắp xếp</label>
                <select id="sort" name="sort">
                    <option value="created_desc" <?php echo $sort === 'created_desc' ? 'selected' : ''; ?>>Ngày tạo mới nhất</option>
                    <option value="created_asc" <?php echo $sort === 'created_asc' ? 'selected' : ''; ?>>Ngày tạo cũ nhất</option>
                    <option value="price_asc" <?php echo $sort === 'price_asc' ? 'selected' : ''; ?>>Giá tăng dần</option>
                    <option value="price_desc" <?php echo $sort === 'price_desc' ? 'selected' : ''; ?>>Giá giảm dần</option>
                </select>
            </div>
            <div class="actions">
                <button class="btn" type="submit">Tìm kiếm</button>
                <a class="btn light" href="product.php">Làm mới</a>
            </div>
        </form>
    <?php endif; ?>
</section>

<?php if (!$loadError): ?>
    <section class="panel">
        <h2><?php echo $editProduct ? 'Sửa sản phẩm' : 'Thêm sản phẩm mới'; ?></h2>
        <form method="post" action="<?php echo $editProduct ? 'actions/edit_product.php' : 'actions/add_product.php'; ?>">
            <?php if ($editProduct): ?>
                <input type="hidden" name="id" value="<?php echo (int) $editProduct['id']; ?>">
            <?php endif; ?>
            <div class="grid">
                <div class="form-row">
                    <label for="name">Tên sản phẩm</label>
                    <input id="name" name="name" type="text" value="<?php echo h($editProduct['name'] ?? ''); ?>" required>
                </div>
                <div class="form-row">
                    <label for="price">Giá sản phẩm</label>
                    <input id="price" name="price" type="number" min="0" step="0.01" value="<?php echo h($editProduct['price'] ?? ''); ?>" required>
                </div>
            </div>
            <div class="form-row">
                <label for="description">Mô tả sản phẩm</label>
                <textarea id="description" name="description"><?php echo h($editProduct['description'] ?? ''); ?></textarea>
            </div>
            <div class="actions">
                <button class="btn" type="submit"><?php echo $editProduct ? 'Cập nhật sản phẩm' : 'Thêm sản phẩm'; ?></button>
                <?php if ($editProduct): ?>
                    <a class="btn light" href="product.php?<?php echo h(product_query(['page' => $page])); ?>">Hủy sửa</a>
                <?php endif; ?>
            </div>
        </form>
    </section>

    <section class="panel">
        <h2>Sản phẩm của bạn</h2>
        <p class="muted">Tổng cộng: <?php echo $totalProducts; ?> sản phẩm</p>

        <?php if (!$products): ?>
            <div class="alert info">Chưa có sản phẩm phù hợp.</div>
        <?php else: ?>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Tên</th>
                            <th>Mô tả</th>
                            <th>Giá</th>
                            <th>Ngày tạo</th>
                            <th>Ngày cập nhật</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?php echo h($product['name']); ?></td>
                                <td><?php echo nl2br(h($product['description'])); ?></td>
                                <td><?php echo number_format((float) $product['price'], 2); ?></td>
                                <td><?php echo h($product['created_at']); ?></td>
                                <td><?php echo h($product['updated_at']); ?></td>
                                <td>
                                    <div class="actions">
                                        <a class="btn secondary" href="product.php?<?php echo h(product_query(['page' => $page, 'edit' => $product['id']])); ?>">Sửa</a>
                                        <form method="post" action="actions/delete_product.php" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                            <input type="hidden" name="id" value="<?php echo (int) $product['id']; ?>">
                                            <button class="btn danger" type="submit">Xóa</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <?php if ($totalPages > 1): ?>
            <div class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <?php if ($i === $page): ?>
                        <span class="active"><?php echo $i; ?></span>
                    <?php else: ?>
                        <a href="product.php?<?php echo h(product_query(['page' => $i])); ?>"><?php echo $i; ?></a>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    </section>
<?php endif; ?>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
