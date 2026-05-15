<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 5: AJAX với jQuery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }
        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #4CAF50;
        }
        #info {
            display: inline-block;
            margin-left: 10px;
            font-size: 14px;
            font-weight: bold;
        }
        .available {
            color: #4CAF50;
        }
        .unavailable {
            color: #f44336;
        }
        .checking {
            color: #FF9800;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #45a049;
        }
        .note {
            background-color: #e3f2fd;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #2196F3;
        }
        .note h3 {
            margin-top: 0;
            color: #2196F3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Đăng ký với jQuery AJAX</h1>
        
        <div class="note">
            <h3>Sử dụng jQuery</h3>
            <p>Bài tập này sử dụng jQuery để rút gọn mã AJAX thay vì XMLHttpRequest thuần túy.</p>
        </div>
        
        <form id="signupForm">
            <div class="form-group">
                <label for="username">Tên đăng nhập:</label>
                <input type="text" id="username" name="username" 
                       placeholder="Nhập tên đăng nhập" required>
                <span id="info"></span>
            </div>
            
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password" 
                       placeholder="Nhập mật khẩu" required>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Xác nhận mật khẩu:</label>
                <input type="password" id="confirm_password" name="confirm_password" 
                       placeholder="Nhập lại mật khẩu" required>
            </div>
            
            <button type="submit">Đăng ký</button>
        </form>
    </div>
    
    <!-- Tích hợp jQuery từ CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var usernameAvailable = false;
        
        $(document).ready(function() {
            // Kiểm tra username khi blur
            $('#username').on('blur', function() {
                checkUsername();
            });
            
            // Reset trạng thái khi người dùng gõ
            $('#username').on('keyup', function() {
                usernameAvailable = false;
            });
            
            // Xử lý submit form
            $('#signupForm').on('submit', function(e) {
                e.preventDefault();
                validateForm();
            });
        });
        
        function checkUsername() {
            var username = $('#username').val().trim();
            
            if (username === '') {
                $('#info').html('');
                usernameAvailable = false;
                return;
            }
            
            // Hiển thị trạng thái đang kiểm tra
            $('#info').html('<span class="checking">Đang kiểm tra...</span>');
            
            // Sử dụng $.ajax() của jQuery
            $.ajax({
                url: '../Bai3/checkuser.php',
                type: 'GET',
                data: {
                    user: username,
                    t: Math.random()
                },
                success: function(response) {
                    $('#info').html(response);
                    
                    // Kiểm tra xem username có khả dụng không
                    if (response.indexOf('class="available"') > -1) {
                        usernameAvailable = true;
                    } else {
                        usernameAvailable = false;
                    }
                },
                error: function() {
                    $('#info').html('<span class="unavailable">Lỗi kết nối</span>');
                    usernameAvailable = false;
                }
            });
            
            // Hoặc có thể dùng $.get() ngắn gọn hơn:
            /*
            $.get('../Bai3/checkuser.php', {
                user: username,
                t: Math.random()
            }, function(response) {
                $('#info').html(response);
                usernameAvailable = response.indexOf('class="available"') > -1;
            });
            */
        }
        
        function validateForm() {
            var username = $('#username').val().trim();
            var password = $('#password').val();
            var confirmPassword = $('#confirm_password').val();
            
            if (username === '') {
                alert('Vui lòng nhập tên đăng nhập!');
                return false;
            }
            
            if (!usernameAvailable) {
                alert('Tên đăng nhập không khả dụng hoặc chưa được kiểm tra!');
                return false;
            }
            
            if (password.length < 6) {
                alert('Mật khẩu phải có ít nhất 6 ký tự!');
                return false;
            }
            
            if (password !== confirmPassword) {
                alert('Mật khẩu xác nhận không khớp!');
                return false;
            }
            
            // Sử dụng $.post() để gửi dữ liệu đăng ký
            $.post('register.php', {
                username: username,
                password: password
            }, function(response) {
                alert(response);
            });
            
            return false;
        }
    </script>
</body>
</html>
