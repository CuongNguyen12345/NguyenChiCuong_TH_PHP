<?php
// BÀI 15: MINH HỌA TÍNH ĐA HÌNH (POLYMORPHISM)

/**
 * Lớp cha DongVat
 */
class DongVat
{
    public function phatAmThanh()
    {
        echo "Động vật phát ra âm thanh chung...<br>";
    }
}

/**
 * Lớp con ConCho
 */
class ConCho extends DongVat
{
    public function phatAmThanh()
    {
        echo "Con chó kêu: Gâu gâu!<br>";
    }
}

/**
 * Lớp con ConMeo
 */
class ConMeo extends DongVat
{
    public function phatAmThanh()
    {
        echo "Con mèo kêu: Meo meo!<br>";
    }
}

/**
 * Hàm chung minh họa tính đa hình
 * Nhận tham số là một đối tượng kiểu DongVat
 */
function animalSound(DongVat $animal)
{
    // PHP sẽ tự động gọi đúng phương thức của đối tượng thực tế (Runtime)
    $animal->phatAmThanh();
}

// Thực thi demo
echo "--- Demo tính đa hình (Bài 15) ---<br>";

$cho = new ConCho();
$meo = new ConMeo();

// Truyền các đối tượng khác nhau vào cùng một hàm xử lý
animalSound($cho); // In ra: Gâu gâu
animalSound($meo); // In ra: Meo meo

echo "<br>Kết luận: Hàm animalSound có thể nhận bất kỳ đối tượng nào kế thừa từ DongVat và thực hiện đúng hành vi của đối tượng đó.";
?>
