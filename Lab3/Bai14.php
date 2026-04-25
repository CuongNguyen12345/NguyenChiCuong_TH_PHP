<?php
// BÀI 14: GHI ĐÈ PHƯƠNG THỨC (OVERRIDE)

/**
 * Lớp cha DongVat
 */
class DongVat
{
    /**
     * Phương thức mặc định của lớp cha
     */
    public function phatAmThanh()
    {
        echo "Động vật đang phát ra âm thanh...<br>";
    }
}

/**
 * Lớp con ConCho ghi đè phương thức phatAmThanh
 */
class ConCho extends DongVat
{
    public function phatAmThanh()
    {
        echo "Con chó kêu: Gâu gâu!<br>";
    }
}

/**
 * Lớp con ConMeo ghi đè phương thức phatAmThanh
 */
class ConMeo extends DongVat
{
    public function phatAmThanh()
    {
        echo "Con mèo kêu: Meo meo!<br>";
    }
}

// Minh họa ghi đè phương thức
echo "--- Demo ghi đè phương thức (Bài 14) ---<br>";

$cho = new ConCho();
$cho->phatAmThanh(); // Kết quả: Gâu gâu!

$meo = new ConMeo();
$meo->phatAmThanh(); // Kết quả: Meo meo!

// Đối tượng lớp cha (nếu cần)
$dv = new DongVat();
$dv->phatAmThanh(); // Kết quả: Âm thanh mặc định
?>
