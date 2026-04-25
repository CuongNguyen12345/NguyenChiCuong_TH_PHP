<?php
// BÀI 18: ĐA KẾ THỪA VỚI INTERFACE

/**
 * Interface 1: ChupAnh
 */
interface ChupAnh
{
    public function takePhoto();
}

/**
 * Interface 2: Internet
 */
interface Internet
{
    public function browseWeb();
}

/**
 * Lớp SmartPhone thực thi cùng lúc nhiều interface
 * Đây là cách PHP thực hiện "đa kế thừa" về mặt hành vi
 */
class SmartPhone implements ChupAnh, Internet
{
    public function takePhoto()
    {
        echo "Đang chụp ảnh bằng Camera độ phân giải cao... Tách!<br>";
    }

    public function browseWeb()
    {
        echo "Đang truy cập trình duyệt web để đọc tin tức...<br>";
    }
}

// Minh họa sử dụng đa kế thừa qua Interface
echo "--- Demo đa kế thừa với Interface (Bài 18) ---<br>";

$myPhone = new SmartPhone();

// Gọi các phương thức từ các interface khác nhau
$myPhone->takePhoto();
$myPhone->browseWeb();

echo "<br>Kết luận: Lớp SmartPhone đã đóng cả hai vai trò là Máy ảnh và Thiết bị truy cập Internet nhờ vào việc thực thi nhiều interface.";
?>
