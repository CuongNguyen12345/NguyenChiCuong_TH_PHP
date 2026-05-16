<?php
require_once __DIR__ . '/../includes/db.php';
require_login();

$search = trim($_GET['search'] ?? '');
$sort = $_GET['sort'] ?? 'created_desc';
$allowedSorts = ['price_asc', 'price_desc', 'created_asc', 'created_desc'];

if (!in_array($sort, $allowedSorts, true)) {
    $sort = 'created_desc';
}

$query = http_build_query(array_filter([
    'search' => $search,
    'sort' => $sort,
], function ($value) {
    return $value !== '';
}));

redirect('../product.php' . ($query ? '?' . $query : ''));
