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

function sendData() {
    var name = document.getElementById("name").value;
    if (name.trim() === "") {
        return;
    }
    
    var method = document.querySelector('input[name="method"]:checked').value;
    var xhr = ajaxRequest();
    
    if (xhr) {
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("result").innerHTML = xhr.responseText;
            }
        };
        
        if (method === "POST") {
            // Phương thức POST
            xhr.open("POST", "process.php", true);
            var params = "name=" + encodeURIComponent(name);
            
            // Thiết lập Header cho POST
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            try {
                xhr.setRequestHeader("Content-length", params.length);
            } catch (e) {
                // Modern browsers may block this unsafe header, but it is shown for the lab requirement.
            }
            
            // Gửi dữ liệu
            xhr.send(params);
            
        } else {
            // Phương thức GET
            // Thêm tham số ngẫu nhiên để vô hiệu hóa cache
            var randomParam = Math.random();
            var url = "process.php?name=" + encodeURIComponent(name) + "&nocache=" + randomParam;
            
            xhr.open("GET", url, true);
            xhr.send();
        }
    }
}
