<?php
// BÀI 10: THUỘC TÍNH TĨNH (STATIC PROPERTY)

class SinhVien
{
    // Khai báo thuộc tính tĩnh để đếm số lượng sinh viên
    public static $count = 0;

    // Mỗi khi khởi tạo một đối tượng mới, hàm tạo sẽ chạy
    public function __construct()
    {
        // Tăng biến tĩnh count lên 1 sử dụng từ khóa 'self'
        self::$count++;
    }
}

// Kiểm tra ban đầu
echo "Số lượng sinh viên ban đầu: " . SinhVien::$count . "<br>";

// Khởi tạo các đối tượng sinh viên
$sv1 = new SinhVien();
$sv2 = new SinhVien();
$sv3 = new SinhVien();

// Hiển thị kết quả sau khi tạo 3 sinh viên
echo "Số lượng sinh viên sau khi tạo sv1, sv2, sv3: " . SinhVien::$count . "<br>";

// Khởi tạo thêm 2 đối tượng nữa
$sv4 = new SinhVien();
$sv5 = new SinhVien();

echo "Tổng số sinh viên hiện có (Bài 10): " . SinhVien::$count . "<br>";
?>
