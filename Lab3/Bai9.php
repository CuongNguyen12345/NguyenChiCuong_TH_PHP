<?php
// BÀI 9: KHAI BÁO VÀ SỬ DỤNG HẰNG SỐ (CONST)

class HinhTron
{
    // Khai báo hằng số PI
    const PI = 3.14;

    // Phương thức tính diện tích sử dụng từ khóa 'self' để truy cập hằng số
    public function tinhDienTich($banKinh)
    {
        return self::PI * $banKinh * $banKinh;
    }
}

// 1. Truy cập hằng số trực tiếp từ tên lớp (không cần khởi tạo)
echo "Giá trị của hằng số PI: " . HinhTron::PI . "<br>";

// 2. Khởi tạo đối tượng để sử dụng phương thức
$ht = new HinhTron();
$r = 5;
$dienTich = $ht->tinhDienTich($r);

echo "Diện tích hình tròn có bán kính {$r} là: {$dienTich}<br>";

// Ví dụ khác
echo "Diện tích hình tròn có bán kính 10 là: " . $ht->tinhDienTich(10);
?>
