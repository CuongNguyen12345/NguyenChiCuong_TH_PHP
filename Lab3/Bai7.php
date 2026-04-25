<?php
// BÀI 7: PHẠM VI TRUY CẬP PRIVATE

class TaiKhoan
{
    // Thuộc tính private: Chỉ lớp này mới được truy cập
    private $matKhau;

    // Phương thức public để gán mật khẩu có kiểm tra điều kiện
    public function setMatKhau($newPass)
    {
        if (strlen($newPass) >= 6) {
            $this->matKhau = $newPass;
            echo "Cập nhật mật khẩu thành công!<br>";
        } else {
            echo "Lỗi: Mật khẩu phải có ít nhất 6 ký tự.<br>";
        }
    }

    // Phương thức hiển thị (chỉ để demo kết quả)
    public function hienThiThongBao()
    {
        if (isset($this->matKhau)) {
            echo "Mật khẩu đã được thiết lập.<br>";
        } else {
            echo "Mật khẩu chưa được thiết lập.<br>";
        }
    }
}

// Khởi tạo đối tượng
$tk = new TaiKhoan();

echo "--- Thử thiết lập mật khẩu ngắn (3 ký tự) ---<br>";
$tk->setMatKhau("123");

echo "<br>--- Thử thiết lập mật khẩu hợp lệ (6 ký tự) ---<br>";
$tk->setMatKhau("123456");

echo "<br>--- Kết quả ---<br>";
$tk->hienThiThongBao();

/* 
echo $tk->matKhau; 
// Dòng trên nếu bỏ comment sẽ gây lỗi: 
// Fatal error: Uncaught Error: Cannot access private property TaiKhoan::$matKhau
*/
?>
