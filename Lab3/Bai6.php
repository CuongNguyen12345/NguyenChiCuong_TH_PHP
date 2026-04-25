<?php
// BÀI 6: HÀM HỦY __DESTRUCT()

class NguoiDung
{
    public $tenDangNhap;
    public $email;

    // Hàm tạo (từ Bài 5)
    public function __construct($user, $mail)
    {
        $this->tenDangNhap = $user;
        $this->email = $mail;
        echo "Đối tượng người dùng '{$this->tenDangNhap}' đã được tạo thành công!<br>";
    }

    // Hàm hủy __destruct()
    public function __destruct()
    {
        echo "Đối tượng '{$this->tenDangNhap}' đã bị hủy.<br>";
    }
}

// Khởi tạo đối tượng
echo "--- Khởi tạo đối tượng ---<br>";
$user = new NguoiDung("admin", "admin@gmail.com");

// Giải phóng đối tượng bằng cách gán null
echo "<br>--- Giải phóng đối tượng bằng cách gán null ---<br>";
$user = null;

echo "<br>--- Kết thúc script ---<br>";
?>
