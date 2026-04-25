<?php
// BÀI 11: PHƯƠNG THỨC TĨNH (STATIC METHOD)

class TienTe
{
    /**
     * Phương thức tĩnh định dạng số thành chuỗi tiền tệ VND
     * @param float|int $soTien
     * @return string
     */
    public static function formatVND($soTien)
    {
        // Định dạng số với dấu chấm phân cách hàng nghìn
        return number_format($soTien, 0, ',', '.') . " VND";
    }
}

// Gọi trực tiếp từ tên lớp mà không cần dùng từ khóa 'new'
echo "--- Demo phương thức tĩnh (Bài 11) ---<br>";

echo "Số tiền 1.000.000 sau khi định dạng: " . TienTe::formatVND(1000000) . "<br>";
echo "Số tiền 500.500 sau khi định dạng: " . TienTe::formatVND(500500) . "<br>";
echo "Số tiền 10.000.000.000 sau khi định dạng: " . TienTe::formatVND(10000000000) . "<br>";
?>
