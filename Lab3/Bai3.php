<?php
class Sach
{
    public $tenSach;
    public $tacGia;
    public $namXuatBan;

    public function hienThiThongTin()
    {
        return "Ten sach: " . $this->tenSach . " - Tac gia: " . $this->tacGia;
    }
}

$sach = new Sach();
$sach->tenSach = "Lập trình PHP";
$sach->tacGia = "Nguyễn Chí Cường";
$sach->namXuatBan = 2024;

echo "Kết quả (Bài 3):<br>";
echo $sach->hienThiThongTin() . "<br>";
?>