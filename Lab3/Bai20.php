<?php
// BÀI 20 (NÂNG CAO): HỆ THỐNG QUẢN LÝ KHO HÀNG & DOANH THU ĐA TẦNG

/**
 * Trait dùng để ghi log hoạt động
 */
trait ProductLogger
{
    public function log($msg)
    {
        echo "[LOG - " . date('H:i:s') . "]: $msg<br>";
    }
}

/**
 * Interface quy định hành vi chiết khấu
 */
interface IDiscount
{
    public function applyDiscount($percent);
}

/**
 * Interface quy định hành vi tính thuế
 */
interface ITaxable
{
    public function getPriceWithTax();
}

/**
 * Lớp trừu tượng BaseProduct
 */
abstract class BaseProduct
{
    protected $name;
    protected $quantity;
    protected $price;
    
    // Biến tĩnh để theo dõi tổng giá trị tài sản trong kho
    public static $totalWarehouseValue = 0;

    public function __construct($name, $quantity, $price)
    {
        // Kiểm soát lỗi dữ liệu bằng Exception
        if ($quantity < 0 || $price < 0) {
            throw new Exception("Số lượng hoặc giá sản phẩm không được là số âm.");
        }

        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;

        // Cập nhật tổng giá trị kho
        self::$totalWarehouseValue += ($price * $quantity);
    }

    // Phương thức trừu tượng để lấy thông tin chi tiết
    abstract public function getDetails();
}

/**
 * Lớp Laptop thừa hưởng và thực thi nhiều thành phần
 */
class Laptop extends BaseProduct implements IDiscount, ITaxable
{
    // Sử dụng Trait
    use ProductLogger;

    private $brand;

    public function __construct($name, $quantity, $price, $brand)
    {
        parent::__construct($name, $quantity, $price);
        $this->brand = $brand;
        
        // Tự động ghi log khi tạo mới sản phẩm
        $this->log("Đã nhập kho sản phẩm Laptop: $name ($brand)");
    }

    // Thực thi interface IDiscount
    public function applyDiscount($percent)
    {
        $oldPrice = $this->price;
        $discountAmount = ($this->price * $percent) / 100;
        $this->price -= $discountAmount;
        
        // Cập nhật lại giá trị kho sau khi giảm giá
        self::$totalWarehouseValue -= ($discountAmount * $this->quantity);
        
        $this->log("Đã áp dụng giảm giá $percent% cho $this->name. Giá cũ: " . number_format($oldPrice) . " -> Giá mới: " . number_format($this->price));
    }

    // Thực thi interface ITaxable
    public function getPriceWithTax()
    {
        $tax = 0.1; // Thuế 10%
        return $this->price * (1 + $tax);
    }

    public function getDetails()
    {
        return "Laptop: $this->name | Hãng: $this->brand | Số lượng: $this->quantity";
    }

    /**
     * Magic Method __toString để chuẩn hóa đầu ra
     */
    public function __toString()
    {
        return "[$this->brand] $this->name - Giá hiện tại: " . number_format($this->price) . " VNĐ (Giá sau thuế: " . number_format($this->getPriceWithTax()) . " VNĐ)";
    }
}

// CHƯƠNG TRÌNH CHÍNH (DEMO)
echo "<h3>--- HỆ THỐNG QUẢN LÝ KHO HÀNG ---</h3>";

try {
    // 1. Tạo các sản phẩm mới
    $laptop1 = new Laptop("MacBook M3", 5, 45000000, "Apple");
    $laptop2 = new Laptop("Dell XPS 13", 10, 35000000, "Dell");

    echo "<br><b>Thông tin sản phẩm:</b><br>";
    echo $laptop1 . "<br>";
    echo $laptop2 . "<br>";

    // 2. Áp dụng chiết khấu
    echo "<br><b>Thực hiện chiết khấu:</b><br>";
    $laptop1->applyDiscount(10); // Giảm 10% cho MacBook

    // 3. Hiển thị tổng giá trị tài sản trong kho
    echo "<br><b>Thống kê kho hàng:</b><br>";
    echo "Tổng giá trị tài sản hiện có trong kho: " . number_format(BaseProduct::$totalWarehouseValue) . " VNĐ<br>";

    // 4. Thử nghiệm Exception (Dữ liệu sai)
    echo "<br><b>Thử nghiệm nhập dữ liệu sai:</b><br>";
    $errorProduct = new Laptop("Laptop Lỗi", -1, 100, "Unknown");

} catch (Exception $e) {
    echo "<span style='color:red;'>[LỖI HỆ THỐNG]: " . $e->getMessage() . "</span><br>";
}

echo "<br>--- Kết thúc chương trình ---";
?>
