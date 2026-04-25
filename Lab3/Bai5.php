<?php
// BÀI 5: HÀM TẠO __CONSTRUCT()

class NguoiDung
{
    // Khai báo các thuộc tính
    public $tenDangNhap;
    public $email;

    // Hàm tạo __construct nhận 2 tham số
    public function __construct($user, $mail)
    {
        $this->tenDangNhap = $user;
        $this->email = $mail;
        
        // Thông báo khi đối tượng được tạo thành công
        echo "Đối tượng người dùng '{$this->tenDangNhap}' đã được tạo thành công!<br>";
    }

    // Phương thức hiển thị thông tin để kiểm tra kết quả
    public function hienThiThongTin()
    {
        return "Tên đăng nhập: " . $this->tenDangNhap . " - Email: " . $this->email;
    }
}

// Khởi tạo đối tượng ngay khi sử dụng từ khóa 'new'
$user = new NguoiDung("admin", "admin@gmail.com");

// Hiển thị thông tin để xác nhận dữ liệu đã được gán
echo "Kết quả mong đợi:<br>";
echo $user->hienThiThongTin();
?>
