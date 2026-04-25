<?php
// BÀI 4: SỬ DỤNG TỪ KHÓA $THIS TRONG CẬP NHẬT DỮ LIỆU

class Sach
{
    public $tenSach;
    public $tacGia;
    public $namXuatBan;

    // Phương thức cập nhật năm xuất bản sử dụng từ khóa $this
    public function capNhatNamXB($nam)
    {
        $this->namXuatBan = $nam;
    }

    // Phương thức hiển thị thông tin (từ Bài 3)
    public function hienThiThongTin()
    {
        return "Tên sách: " . $this->tenSach . " - Tác giả: " . $this->tacGia . " - Năm XB: " . $this->namXuatBan;
    }
}

// Khởi tạo đối tượng
$sach = new Sach();
$sach->tenSach = "Lập trình PHP";
$sach->tacGia = "Nguyễn Chí Cường";
$sach->namXuatBan = 2020; // Năm cũ

echo "Thông tin trước khi cập nhật:<br>";
echo $sach->hienThiThongTin() . "<br><br>";

// Gọi phương thức cập nhật năm xuất bản
$sach->capNhatNamXB(2024);

echo "Thông tin sau khi cập nhật (Bài 4):<br>";
echo $sach->hienThiThongTin() . "<br>";
?>
