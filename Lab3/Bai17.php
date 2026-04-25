<?php
// BÀI 17: SỬ DỤNG INTERFACE

/**
 * Interface ThanhToan đóng vai trò như một bản hợp đồng
 */
interface ThanhToan
{
    // Các phương thức trong interface mặc định là public và không có thân hàm
    public function pay($amount);
}

/**
 * Lớp ChuyenKhoan thực thi interface ThanhToan
 */
class ChuyenKhoan implements ThanhToan
{
    public function pay($amount)
    {
        echo "Đã thanh toán " . number_format($amount, 0, ',', '.') . " VNĐ qua Chuyển khoản Ngân hàng.<br>";
    }
}

/**
 * Lớp TheTinDung thực thi interface ThanhToan
 */
class TheTinDung implements ThanhToan
{
    public function pay($amount)
    {
        echo "Đã thanh toán " . number_format($amount, 0, ',', '.') . " VNĐ qua Thẻ tín dụng (Credit Card).<br>";
    }
}

// Minh họa sử dụng Interface
echo "--- Demo sử dụng Interface (Bài 17) ---<br>";

$bankTransfer = new ChuyenKhoan();
$bankTransfer->pay(1500000);

$creditCard = new TheTinDung();
$creditCard->pay(2500000);

echo "<br>Kết luận: Interface đảm bảo rằng bất kể là phương thức thanh toán nào, chúng đều phải có hàm pay() để thực hiện giao dịch.";
?>
