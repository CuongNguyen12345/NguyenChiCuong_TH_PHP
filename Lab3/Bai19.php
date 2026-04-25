<?php
// BÀI 19: NẠP CHỒNG VỚI __CALL()

class Math
{
    /**
     * Phương thức magic __call() được gọi khi gọi một phương thức không tồn tại trong lớp
     * @param string $name Tên phương thức được gọi
     * @param array $args Mảng các tham số truyền vào
     */
    public function __call($name, $args)
    {
        // Kiểm tra nếu tên phương thức là 'tong'
        if ($name === 'tong') {
            // Giả lập tính năng nạp chồng (Overloading) bằng cách xử lý mảng tham số động
            return array_sum($args);
        }

        return "Phương thức '{$name}' không tồn tại.<br>";
    }
}

// Minh họa nạp chồng với __call()
echo "--- Demo nạp chồng phương thức với __call() (Bài 19) ---<br>";

$m = new Math();

// Gọi hàm 'tong' với 2 tham số
echo "Tổng của (1, 2) là: " . $m->tong(1, 2) . "<br>";

// Gọi hàm 'tong' với 4 tham số
echo "Tổng của (1, 2, 3, 4) là: " . $m->tong(1, 2, 3, 4) . "<br>";

// Gọi hàm 'tong' với nhiều tham số hơn
echo "Tổng của (10, 20, 30, 40, 50) là: " . $m->tong(10, 20, 30, 40, 50) . "<br>";

echo "<br>Kết luận: Nhờ __call(), chúng ta có thể xử lý linh hoạt các lời gọi hàm mà không cần khai báo tường minh từng hàm với số lượng tham số khác nhau.";
?>
