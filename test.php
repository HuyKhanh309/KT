<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "Select * from products";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8f9fa; margin: 0; padding: 0; }
        .container { width: 80%; margin: auto; text-align: center; padding: 20px; }
        .product-container { display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; }
        .product { border: 1px solid #ddd; padding: 15px; width: 260px; text-align: center; border-radius: 10px; background: white; box-shadow: 3px 3px 15px rgba(0,0,0,0.1); }
        .product img { width: 100%; height: auto; border-radius: 5px; }
        .product h3 { margin: 10px 0; font-size: 20px; }
        .product p { margin: 5px 0; }
        .price { color: red; font-weight: bold; font-size: 18px; }
        .buy-button { background-color: #28a745; color: white; border: none; padding: 10px 15px; cursor: pointer; border-radius: 5px; margin-top: 10px; font-size: 16px; transition: 0.3s; }
        .buy-button:hover { background-color: #218838; }
    </style>
</head>
<body>

    <div class="container">
        <h2>Danh sách sản phẩm</h2>
        <div class="product-container">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='product'>";
                    echo "<img src='" . $row["image"] . "' alt='" . $row["name"] . "'>";
                    echo "<h3>" . $row["name"] . "</h3>";
                    echo "<p class='price'>" . number_format($row["price"], 2) . " USD</p>";
                    echo "<p>" . $row["description"] . "</p>";
                    // Thêm nút Mua hàng
                    echo "<button type='submit' class='buy-button'>Mua hàng</button>";
                    echo "</div>";
                }
            } else {
                echo "<p>Không có sản phẩm nào.</p>";
            }
            $conn->close();
            ?>
        </div>
    </div>

</body>
</html>