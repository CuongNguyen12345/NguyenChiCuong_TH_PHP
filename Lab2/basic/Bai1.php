<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 1: In Lời Chào</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        .container {
            width: 400px;
            background-color: #d1f2eb;
            border: 1px solid #ccc;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #009688;
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            font-size: 20px;
            text-transform: uppercase;
        }
        form {
            padding: 20px;
        }
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        label {
            flex: 1;
            font-size: 14px;
        }
        input[type="text"] {
            flex: 2;
            padding: 5px;
            border: 1px solid #999;
            outline: none;
        }
        .result {
            text-align: center;
            margin-bottom: 15px;
            font-size: 14px;
            min-height: 1.2em;
        }
        .button-group {
            text-align: center;
        }
        input[type="submit"] {
            padding: 5px 20px;
            cursor: pointer;
            background-color: #e0e0e0;
            border: 1px solid #999;
            font-size: 14px;
        }
        input[type="submit"]:hover {
            background-color: #d0d0d0;
        }
    </style>
</head>
<body>

<?php
$ho_ten = "";
$loi_chao = "";

if (isset($_POST["ho_ten"])) {
    $ho_ten = $_POST["ho_ten"];
    if (!empty($ho_ten)) {
        $loi_chao = "Chào bạn, " . $ho_ten;
    }
}
?>

<div class="container">
    <div class="header">IN LỜI CHÀO</div>
    <form action="Bai1.php" method="post" name="form_chao">
        <div class="form-group">
            <label for="ho_ten">Họ tên của bạn</label>
            <input type="text" name="ho_ten" id="ho_ten" value="<?php echo htmlspecialchars($ho_ten); ?>">
        </div>
        
        <div class="result">
            <?php echo $loi_chao; ?>
        </div>
        
        <div class="button-group">
            <input type="submit" name="btn_chao" value="Chào">
        </div>
    </form>
</div>

</body>
</html>