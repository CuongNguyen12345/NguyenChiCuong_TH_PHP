<?php
// BÀI 8: XÂY DỰNG GETTER VÀ SETTER CHUẨN

class SanPham
{
    // Thuộc tính private
    private $tenSP;
    private $giaSP;

    // Getter cho tên sản phẩm
    public function getTenSP()
    {
        return $this->tenSP;
    }

    // Setter cho tên sản phẩm
    public function setTenSP($ten)
    {
        $this->tenSP = $ten;
    }

    // Getter cho giá sản phẩm
    public function getGiaSP()
    {
        return number_format($this->giaSP, 0, ',', '.') . " VNĐ";
    }

    // Setter cho giá sản phẩm (có kiểm tra giá trị)
    public function setGiaSP($gia)
    {
        if ($gia >= 0) {
            $this->giaSP = $gia;
        } else {
            echo "Lỗi: Giá sản phẩm không thể âm.<br>";
        }
    }
}

// Khởi tạo đối tượng
$sp = new SanPham();

// Sử dụng Setter để gán giá trị
$sp->setTenSP("iPhone 15 Pro Max");
$sp->setGiaSP(34990000);

// Sử dụng Getter để lấy giá trị
echo "--- Thông tin sản phẩm (Bài 8) ---<br>";
echo "Tên SP: " . $sp->getTenSP() . "<br>";
echo "Giá SP: " . $sp->getGiaSP() . "<br>";

// Thử gán giá sai
echo "<br>--- Thử gán giá âm ---<br>";
$sp->setGiaSP(-100);
?>
