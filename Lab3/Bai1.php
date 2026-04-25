<?php
class Sach
{
    public $tenSach;
    public $tacGia;
    public $namXuatBan;
}

$sach = new Sach();
$sach->tenSach = "Lập trình PHP";
$sach->tacGia = "Nguyễn Chí Cường";
$sach->namXuatBan = 2024;

echo "Tên sách: " . $sach->tenSach . "<br>";
echo "Tác giả: " . $sach->tacGia . "<br>";
echo "Năm xuất bản: " . $sach->namXuatBan . "<br>";
?>