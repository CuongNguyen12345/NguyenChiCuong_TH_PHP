// Hàm tạo đối tượng XMLHttpRequest tương thích đa trình duyệt
function ajaxRequest() {
    try {
        // Trình duyệt hiện đại (Chrome, Firefox, Safari, Edge)
        return new XMLHttpRequest();
    } catch (e) {
        try {
            // IE cũ (IE6)
            return new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                // IE cũ hơn (IE5)
                return new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {
                alert("Trình duyệt của bạn không hỗ trợ AJAX!");
                return null;
            }
        }
    }
}

// Hàm gửi request và cập nhật nội dung
function loadContent() {
    var xhr = ajaxRequest();
    
    if (xhr) {
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("info").innerHTML = xhr.responseText;
            }
        };
        
        xhr.open("GET", "hello.txt", true);
        xhr.send();
    }
}
