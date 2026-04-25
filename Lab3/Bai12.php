<?php
// BÀI 12: TRIỂN KHAI KẾ THỪA (EXTENDS)

/**
 * Lớp cha DongVat
 */
class DongVat
{
    public $ten;
}

/**
 * Lớp con ConCho kế thừa từ DongVat
 */
class ConCho extends DongVat
{
    /**
     * Phương thức riêng của lớp con nhưng sử dụng thuộc tính từ lớp cha
     */
    public function keu()
    {
        echo "Con chó '{$this->ten}' đang sủa: Gâu gâu!<br>";
    }
}

// Minh họa sử dụng kế thừa
echo "--- Demo tính kế thừa (Bài 12) ---<br>";

// Khởi tạo đối tượng lớp con
$milu = new ConCho();

// Truy cập và gán giá trị cho thuộc tính kế thừa từ lớp cha
$milu->ten = "Milu";

// Gọi phương thức của lớp con
$milu->keu();

// Tạo thêm một đối tượng chó khác
$lu = new ConCho();
$lu->ten = "Lu";
$lu->keu();
?>
