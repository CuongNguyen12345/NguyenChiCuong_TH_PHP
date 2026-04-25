<?php
require_once 'Bai1.php';

// $sach = new Sach();
// $sach->tenSach = "Lập trình PHP";
// $sach->tacGia = "Nguyễn Chí Cường";
// $sach->namXuatBan = 2024;

// echo "Thông tin sách từ Bài 2 (Import từ Bài 1):<br>";
// echo "Tên sách: " . $sach->tenSach . "<br>";
// echo "Tác giả: " . $sach->tacGia . "<br>";
// echo "Năm xuất bản: " . $sach->namXuatBan . "<br>";

$sach1 = new Sach();
$sach1->tenSach = "Lap trinh PHP";
$sach1->tacGia = "Nguyen Van A";


$sach2 = new Sach();
$sach2->tenSach = "Co so du lieu";
$sach2->tacGia = "Tran Thi B";

$danhSachSach = [$sach1, $sach2];

foreach ($danhSachSach as $sach) {
    echo "<br>Tên: " . $sach->tenSach . ", Tác giả: " . $sach->tacGia;
}

?>