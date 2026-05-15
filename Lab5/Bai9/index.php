<?php
session_start();
require_once 'config.php';
$token = generateToken();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 9: Hệ thống tin tức tương tác</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            font-size: 32px;
        }
        .search-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        .search-row {
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }
        .search-group {
            flex: 1;
            min-width: 250px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        input[type="text"]:focus {
            outline: none;
            border-color: #4CAF50;
        }
        select {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        #news-container {
            min-height: 300px;
        }
        .news-item {
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .news-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .news-item h3 {
            color: #2196F3;
            margin-bottom: 10px;
            font-size: 20px;
        }
        .news-item .category {
            display: inline-block;
            padding: 5px 12px;
            background-color: #4CAF50;
            color: white;
            border-radius: 15px;
            font-size: 12px;
            margin-bottom: 10px;
        }
        .news-item .summary {
            color: #666;
            line-height: 1.6;
            margin-bottom: 10px;
        }
        .news-item .date {
            color: #999;
            font-size: 14px;
        }
        .loading {
            text-align: center;
            padding: 50px;
            color: #999;
            font-size: 18px;
        }
        .loading::after {
            content: '...';
            animation: dots 1.5s steps(4, end) infinite;
        }
        @keyframes dots {
            0%, 20% { content: '.'; }
            40% { content: '..'; }
            60%, 100% { content: '...'; }
        }
        #load-more-btn {
            display: block;
            width: 100%;
            padding: 15px;
            background-color: #2196F3;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }
        #load-more-btn:hover {
            background-color: #0b7dda;
        }
        #load-more-btn:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
        .no-results {
            text-align: center;
            padding: 50px;
            color: #999;
            font-size: 18px;
        }
        .stats {
            text-align: center;
            color: #666;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📰 Hệ thống tin tức tương tác</h1>
        
        <div class="search-section">
            <div class="search-row">
                <div class="search-group">
                    <label for="search">Tìm kiếm:</label>
                    <input type="text" id="search" placeholder="Nhập từ khóa tìm kiếm...">
                </div>
                <div class="search-group">
                    <label for="category">Danh mục:</label>
                    <select id="category">
                        <option value="">Tất cả danh mục</option>
                        <option value="Công nghệ">Công nghệ</option>
                        <option value="Thể thao">Thể thao</option>
                        <option value="Đời sống">Đời sống</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="stats" id="stats"></div>
        <div id="news-container"></div>
        <button id="load-more-btn" style="display: none;">Xem thêm bài viết</button>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var offset = 0;
        var limit = 5;
        var searchTimeout = null;
        var hasMore = true;
        var csrfToken = '<?php echo $token; ?>';
        
        $(document).ready(function() {
            // Load dữ liệu ban đầu
            loadNews(false);
            
            // Tìm kiếm với debounce
            $('#search').on('keyup', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function() {
                    offset = 0;
                    hasMore = true;
                    loadNews(false);
                }, 500);
            });
            
            // Thay đổi danh mục
            $('#category').on('change', function() {
                offset = 0;
                hasMore = true;
                loadNews(false);
            });
            
            // Nút xem thêm
            $('#load-more-btn').on('click', function() {
                loadNews(true);
            });
        });
        
        function loadNews(append) {
            if (!hasMore && append) {
                return;
            }
            
            var search = $('#search').val();
            var category = $('#category').val();
            
            if (!append) {
                $('#news-container').html('<div class="loading">Đang tải dữ liệu</div>');
                $('#load-more-btn').hide();
            } else {
                $('#load-more-btn').prop('disabled', true).text('Đang tải...');
            }
            
            $.ajax({
                url: 'search_news.php',
                type: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-Token': csrfToken
                },
                data: {
                    search: search,
                    category: category,
                    offset: append ? offset : 0,
                    limit: limit,
                    token: csrfToken
                },
                dataType: 'text',
                success: function(responseText) {
                    var response = JSON.parse(responseText);

                    if (response.error) {
                        $('#news-container').html('<div class="no-results">' + response.message + '</div>');
                        return;
                    }
                    
                    if (!append) {
                        offset = 0;
                    }
                    
                    if (response.data.length === 0) {
                        if (!append) {
                            $('#news-container').html('<div class="no-results">Không tìm thấy bài viết nào</div>');
                            $('#stats').text('');
                        }
                        hasMore = false;
                        $('#load-more-btn').hide();
                        return;
                    }
                    
                    var html = '';
                    $.each(response.data, function(index, news) {
                        html += '<div class="news-item">';
                        html += '<span class="category">' + escapeHtml(news.category) + '</span>';
                        html += '<h3>' + escapeHtml(news.title) + '</h3>';
                        html += '<p class="summary">' + escapeHtml(news.summary) + '</p>';
                        html += '<p class="date">📅 ' + news.created_at + '</p>';
                        html += '</div>';
                    });
                    
                    if (append) {
                        $('#news-container').append(html);
                    } else {
                        $('#news-container').html(html);
                    }
                    
                    offset += response.data.length;
                    
                    // Cập nhật thống kê
                    $('#stats').text('Đang hiển thị ' + offset + ' / ' + response.total + ' bài viết');
                    
                    // Hiển thị nút xem thêm nếu còn dữ liệu
                    if (offset < response.total) {
                        $('#load-more-btn').show().prop('disabled', false).text('Xem thêm bài viết');
                        hasMore = true;
                    } else {
                        $('#load-more-btn').hide();
                        hasMore = false;
                    }
                },
                error: function() {
                    $('#news-container').html('<div class="no-results">Lỗi kết nối đến máy chủ</div>');
                    $('#load-more-btn').prop('disabled', false).text('Xem thêm bài viết');
                }
            });
        }

        function escapeHtml(value) {
            return String(value).replace(/[&<>"']/g, function(match) {
                return {
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#039;'
                }[match];
            });
        }
    </script>
</body>
</html>
