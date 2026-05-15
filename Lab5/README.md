# BÀI TẬP THỰC HÀNH CHƯƠNG 6: AJAX VÀ PHP

## Cấu trúc thư mục

```
Lab5/
├── Bai1/           # Xây dựng nền tảng giao tiếp bất đồng bộ
├── Bai2/           # Giao tiếp GET và POST
├── Bai3/           # Kiểm tra username với database
├── Bai4/           # Xử lý dữ liệu XML
├── Bai5/           # Tối ưu hóa với jQuery
├── Bai6/           # Tải nội dung động theo lựa chọn
├── Bai7/           # Đồng hồ thời gian máy chủ
├── Bai8/           # Kiểm tra email realtime
└── Bai9/           # Hệ thống tin tức tương tác (Tổng hợp)
```

## Hướng dẫn cài đặt

### 1. Chuẩn bị môi trường
- Cài đặt Laragon (hoặc XAMPP/WAMP)
- Đảm bảo Apache và MySQL đang chạy

### 2. Cấu hình Database

#### Cho Bài 3 (Kiểm tra username):
```sql
-- Chạy file: Lab5/Bai3/database.sql
-- Tạo database: ajax_lab
-- Tạo bảng: members
```

#### Cho Bài 9 (Hệ thống tin tức):
```sql
-- Chạy file: Lab5/Bai9/database.sql
-- Tạo database: web_db
-- Tạo bảng: news với 15 bài viết mẫu
```

**Cách chạy SQL:**
1. Mở phpMyAdmin: http://localhost/phpmyadmin
2. Chọn tab "SQL"
3. Copy nội dung file .sql và paste vào
4. Click "Go" để thực thi

### 3. Truy cập các bài tập

- **Bài 1:** http://localhost/ThPHP/Lab5/Bai1/index.html
- **Bài 2:** http://localhost/ThPHP/Lab5/Bai2/index.html
- **Bài 3:** http://localhost/ThPHP/Lab5/Bai3/signup.php
- **Bài 4:** http://localhost/ThPHP/Lab5/Bai4/index.html
- **Bài 5:** http://localhost/ThPHP/Lab5/Bai5/signup_jquery.php
- **Bài 6:** http://localhost/ThPHP/Lab5/Bai6/index.html
- **Bài 7:** http://localhost/ThPHP/Lab5/Bai7/index.html
- **Bài 8:** http://localhost/ThPHP/Lab5/Bai8/index.html
- **Bài 9:** http://localhost/ThPHP/Lab5/Bai9/index.php

## Chi tiết từng bài tập

### Bài 1: Xây dựng nền tảng giao tiếp bất đồng bộ
**Mục đích:** Tạo đối tượng XMLHttpRequest tương thích đa trình duyệt

**Tính năng:**
- Hàm `ajaxRequest()` hỗ trợ cả trình duyệt cũ và mới
- Tải nội dung từ file `hello.txt`
- Cập nhật DOM bằng `innerHTML`

**File chính:**
- `index.html` - Giao diện
- `ajax.js` - Hàm AJAX
- `hello.txt` - Dữ liệu mẫu

---

### Bài 2: Giao tiếp GET và POST
**Mục đích:** Hiểu sự khác biệt giữa GET và POST

**Tính năng:**
- Chuyển đổi giữa phương thức GET và POST
- Thiết lập Header cho POST
- Vô hiệu hóa cache cho GET bằng `Math.random()`

**File chính:**
- `index.html` - Form nhập liệu
- `ajax.js` - Xử lý AJAX
- `process.php` - Xử lý server

---

### Bài 3: Tương tác Cơ sở dữ liệu
**Mục đích:** Kiểm tra username theo thời gian thực

**Tính năng:**
- Kiểm tra username khi blur
- Truy vấn database bằng Prepared Statement
- Hiển thị trạng thái: khả dụng (xanh) / đã tồn tại (đỏ)

**File chính:**
- `signup.php` - Form đăng ký
- `checkuser.php` - Kiểm tra username
- `config.php` - Kết nối database
- `database.sql` - Cấu trúc database

**Username mẫu đã tồn tại:**
- admin
- user1
- nguyenvana

---

### Bài 4: Trích xuất dữ liệu XML
**Mục đích:** Xử lý dữ liệu XML từ server

**Tính năng:**
- PHP tạo XML động
- JavaScript dùng `responseXML`
- Bóc tách dữ liệu bằng `getElementsByTagName()`

**File chính:**
- `index.html` - Giao diện
- `products.php` - Tạo XML (5 sản phẩm)

---

### Bài 5: Tối ưu hóa với jQuery
**Mục đích:** Rút gọn mã AJAX bằng jQuery

**Tính năng:**
- Sử dụng `$.ajax()`, `$.get()`, `$.post()`
- Selector jQuery: `$('#info').html()`
- Code ngắn gọn hơn XMLHttpRequest

**File chính:**
- `signup_jquery.php` - Form với jQuery
- `register.php` - Xử lý đăng ký

**So sánh:**
- XMLHttpRequest: ~20 dòng code
- jQuery: ~5 dòng code

---

### Bài 6: Tải nội dung động
**Mục đích:** Xử lý sự kiện `onchange`

**Tính năng:**
- ComboBox chọn danh mục (Tin tức, Thể thao, Công nghệ)
- Hiển thị "Đang tải..." khi request
- Cập nhật nội dung động

**File chính:**
- `index.html` - Giao diện
- `content.php` - Dữ liệu theo danh mục

---

### Bài 7: Đồng hồ thời gian máy chủ
**Mục đích:** AJAX polling với `setInterval()`

**Tính năng:**
- Cập nhật thời gian mỗi 1 giây
- Lấy thời gian từ server (không phải client)
- Nút Start/Stop

**File chính:**
- `index.html` - Đồng hồ
- `time.php` - Trả về thời gian JSON

---

### Bài 8: Kiểm tra email realtime
**Mục đích:** Kết hợp JavaScript validation + AJAX

**Tính năng:**
- Kiểm tra định dạng email (JavaScript)
- Kiểm tra email đã tồn tại (PHP + AJAX)
- Debounce 500ms
- 3 trạng thái màu: đỏ (sai), cam (tồn tại), xanh (hợp lệ)

**File chính:**
- `index.html` - Form
- `check_email.php` - Kiểm tra email

**Email mẫu đã tồn tại:**
- admin@example.com
- user@test.com
- contact@company.com

---

### Bài 9: Hệ thống tin tức tương tác (TỔNG HỢP)
**Mục đích:** Ứng dụng hoàn chỉnh với AJAX, JSON, Security

**Tính năng:**
- ✅ Live Search với debounce 500ms
- ✅ Lọc theo danh mục
- ✅ Load More (phân trang)
- ✅ Prepared Statement (chống SQL Injection)
- ✅ Loading state
- ✅ CSRF Token
- ✅ JSON response

**File chính:**
- `index.php` - Giao diện chính
- `search_news.php` - API tìm kiếm
- `config.php` - Database + Security
- `database.sql` - 15 bài viết mẫu

**Cách sử dụng:**
1. Import database từ `database.sql`
2. Truy cập `index.php`
3. Thử tìm kiếm: "AI", "bóng đá", "kinh tế"
4. Chọn danh mục: Công nghệ, Thể thao, Đời sống
5. Click "Xem thêm" để load thêm bài viết

---

## Kỹ thuật được sử dụng

### Frontend:
- ✅ XMLHttpRequest (vanilla JavaScript)
- ✅ jQuery AJAX
- ✅ Event handling (onblur, onchange, onkeyup)
- ✅ DOM manipulation
- ✅ Debounce technique
- ✅ JSON parsing
- ✅ XML parsing

### Backend:
- ✅ PHP PDO (Prepared Statement)
- ✅ MySQLi
- ✅ JSON encoding
- ✅ XML generation
- ✅ Session management
- ✅ CSRF protection
- ✅ Input sanitization

### Security:
- ✅ SQL Injection prevention (Prepared Statement)
- ✅ XSS prevention (htmlspecialchars)
- ✅ CSRF Token
- ✅ Input validation

---

## Lưu ý quan trọng

### 1. Cấu hình Database
Nếu database của bạn khác, sửa file `config.php`:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'web_db');
```

### 2. Đường dẫn URL
Nếu project không nằm trong `ThPHP`, sửa đường dẫn trong các file AJAX:
```javascript
// Từ:
xhr.open("GET", "checkuser.php", true);

// Thành:
xhr.open("GET", "/your-path/checkuser.php", true);
```

### 3. CORS Issues
Nếu gặp lỗi CORS, đảm bảo:
- Chạy qua web server (localhost), không mở file trực tiếp
- PHP files phải có extension `.php`, không phải `.html`

### 4. jQuery CDN
Bài 5 và Bài 9 sử dụng jQuery từ CDN. Cần kết nối internet hoặc tải jQuery về local.

---

## Troubleshooting

### Lỗi: "Không kết nối được database"
**Giải pháp:**
1. Kiểm tra MySQL đang chạy
2. Kiểm tra username/password trong `config.php`
3. Chạy file `.sql` để tạo database

### Lỗi: "404 Not Found"
**Giải pháp:**
1. Kiểm tra đường dẫn URL
2. Đảm bảo file tồn tại
3. Kiểm tra Apache đang chạy

### AJAX không hoạt động
**Giải pháp:**
1. Mở Console (F12) để xem lỗi
2. Kiểm tra Network tab
3. Đảm bảo đường dẫn file PHP đúng

### Không hiển thị dữ liệu
**Giải pháp:**
1. Kiểm tra database đã có dữ liệu chưa
2. Xem response trong Network tab
3. Kiểm tra JSON format

---

## Tài liệu tham khảo

- [MDN - XMLHttpRequest](https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest)
- [jQuery AJAX Documentation](https://api.jquery.com/jquery.ajax/)
- [PHP PDO Tutorial](https://www.php.net/manual/en/book.pdo.php)
- [OWASP - SQL Injection Prevention](https://cheatsheetseries.owasp.org/cheatsheets/SQL_Injection_Prevention_Cheat_Sheet.html)

---

## Tác giả
Bài tập thực hành Chương 6 - AJAX và PHP

## License
Educational purposes only
