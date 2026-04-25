<?php
// BÀI 13: SỬ DỤNG PHẠM VI PROTECTED

/**
 * Lớp cha DongVat
 */
class DongVat
{
    // Thuộc tính protected: Lớp cha và lớp con đều dùng được, nhưng bên ngoài thì không
    protected $canNang;

    public function setCanNang($kg)
    {
        $this->canNang = $kg;
    }
}

/**
 * Lớp con ConCho kế thừa từ DongVat
 */
class ConCho extends DongVat
{
    /**
     * Phương thức hiển thị cân nặng (truy cập biến protected từ lớp cha)
     */
    public function hienThiCanNang()
    {
        echo "Cân nặng của chú chó là: " . $this->canNang . " kg<br>";
    }
}

// Minh họa sử dụng protected
echo "--- Demo phạm vi protected (Bài 13) ---<br>";

$cho = new ConCho();

// Sử dụng phương thức public của lớp cha để gán giá trị
$cho->setCanNang(15);

// Lớp con truy cập được biến protected thông qua phương thức của nó
$cho->hienThiCanNang();

/* 
echo $cho->canNang; 
// Dòng trên nếu bỏ comment sẽ gây lỗi: 
// Fatal error: Uncaught Error: Cannot access protected property ConCho::$canNang
*/

echo "<br>Kết luận: Lớp con có thể sử dụng biến protected của lớp cha, nhưng code bên ngoài thì không thể truy cập trực tiếp.";
?>
