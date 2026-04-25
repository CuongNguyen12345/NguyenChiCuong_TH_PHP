<?php
// BÀI 16: LỚP TRỪU TƯỢNG (ABSTRACT CLASS)

/**
 * Lớp trừu tượng HinhHoc đóng vai trò là khung mẫu
 */
abstract class HinhHoc
{
    // Phương thức trừu tượng: Các lớp con bắt buộc phải triển khai
    abstract public function tinhDienTich();
}

/**
 * Lớp HinhVuong triển khai lớp HinhHoc
 */
class HinhVuong extends HinhHoc
{
    private $canh;

    public function __construct($canh)
    {
        $this->canh = $canh;
    }

    public function tinhDienTich()
    {
        return $this->canh * $this->canh;
    }
}

/**
 * Lớp HinhChuNhat triển khai lớp HinhHoc
 */
class HinhChuNhat extends HinhHoc
{
    private $chieuDai;
    private $chieuRong;

    public function __construct($dai, $rong)
    {
        $this->chieuDai = $dai;
        $this->chieuRong = $rong;
    }

    public function tinhDienTich()
    {
        return $this->chieuDai * $this->chieuRong;
    }
}

// Minh họa sử dụng Abstract Class
echo "--- Demo lớp trừu tượng (Bài 16) ---<br>";

$hv = new HinhVuong(5);
echo "Diện tích hình vuông (cạnh 5): " . $hv->tinhDienTich() . "<br>";

$hcn = new HinhChuNhat(4, 6);
echo "Diện tích hình chữ nhật (4x6): " . $hcn->tinhDienTich() . "<br>";

/* 
$hh = new HinhHoc(); 
// Dòng trên sẽ gây lỗi: 
// Fatal error: Uncaught Error: Cannot instantiate abstract class HinhHoc
*/

echo "<br>Kết luận: Lớp trừu tượng định nghĩa 'cái gì' cần làm (tính diện tích), còn lớp con định nghĩa 'làm như thế nào'.";
?>
