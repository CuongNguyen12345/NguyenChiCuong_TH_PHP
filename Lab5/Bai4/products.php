<?php
header("Content-Type: text/xml; charset=utf-8");

require_once '../Bai3/config.php';

function xmlText($value) {
    return htmlspecialchars((string)$value, ENT_XML1 | ENT_QUOTES, 'UTF-8');
}

$conn = getConnection();
$sql = "SELECT id, title, price, description FROM products ORDER BY created_at DESC LIMIT 5";
$result = $conn->query($sql);

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<products>';

if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo '<product>';
        echo '<id>' . xmlText($row['id']) . '</id>';
        echo '<title>' . xmlText($row['title']) . '</title>';
        echo '<price>' . xmlText($row['price']) . '</price>';
        echo '<description>' . xmlText($row['description']) . '</description>';
        echo '</product>';
    }
}

echo '</products>';
$conn->close();
?>
