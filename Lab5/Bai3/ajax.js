var usernameAvailable = false;

function ajaxRequest() {
    try {
        return new XMLHttpRequest();
    } catch (e) {
        try {
            return new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                return new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {
                alert("Trình duyệt của bạn không hỗ trợ AJAX!");
                return null;
            }
        }
    }
}

function checkUsername() {
    var username = document.getElementById("username").value;
    var infoSpan = document.getElementById("info");
    
    if (username.trim() === "") {
        infoSpan.innerHTML = "";
        usernameAvailable = false;
        return;
    }
    
    // Hiển thị trạng thái đang kiểm tra
    infoSpan.innerHTML = '<span class="checking">Đang kiểm tra...</span>';
    
    var xhr = ajaxRequest();
    
    if (xhr) {
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                infoSpan.innerHTML = xhr.responseText;
                
                // Kiểm tra xem username có khả dụng không
                if (xhr.responseText.indexOf('class="available"') > -1) {
                    usernameAvailable = true;
                } else {
                    usernameAvailable = false;
                }
            }
        };
        
        // Thêm tham số ngẫu nhiên để tránh cache
        var url = "checkuser.php?user=" + encodeURIComponent(username) + "&t=" + Math.random();
        xhr.open("GET", url, true);
        xhr.send();
    }
}

function resetCheck() {
    usernameAvailable = false;
}

function validateForm() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirm_password").value;
    
    if (username.trim() === "") {
        alert("Vui lòng nhập tên đăng nhập!");
        return false;
    }
    
    if (!usernameAvailable) {
        alert("Tên đăng nhập không khả dụng hoặc chưa được kiểm tra!");
        return false;
    }
    
    if (password.length < 6) {
        alert("Mật khẩu phải có ít nhất 6 ký tự!");
        return false;
    }
    
    if (password !== confirmPassword) {
        alert("Mật khẩu xác nhận không khớp!");
        return false;
    }
    
    alert("Đăng ký thành công!");
    return false; // Ngăn form submit thực sự (demo only)
}
