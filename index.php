<?php
// Bắt đầu session nếu cần thiết
session_start();

// Require các file cấu hình và controller
require_once 'app/config/database.php';
require_once 'app/controllers/UserController.php';
require_once 'app/controllers/NhanVienController.php';

// Lấy tham số từ URL
$url = $_GET['url'] ?? ''; // Lấy đường dẫn từ tham số 'url'
$url = rtrim($url, '/'); // Xóa dấu '/' ở cuối URL nếu có
$url = filter_var($url, FILTER_SANITIZE_URL); // Lọc URL để tránh ký tự lạ
$url = explode('/', $url); // Tách URL thành mảng theo dấu '/'

// Xác định tên controller
$controllerName = isset($url[0]) && $url[0] != '' ? ucfirst($url[0]) . 'Controller' : '';

// Xác định action
$action = isset($url[1]) && $url[1] != '' ? $url[1] : 'index';

// Kiểm tra xem file controller có tồn tại không
if (!file_exists('app/controllers/' . $controllerName . '.php')) {
    die('Controller not found'); // Báo lỗi nếu không tìm thấy controller
}

// Require file controller
require_once 'app/controllers/' . $controllerName . '.php';

// Khởi tạo controller
$controller = new $controllerName();

// Kiểm tra action có tồn tại trong controller không
if (!method_exists($controller, $action)) {
    die('Action not found'); // Báo lỗi nếu không tìm thấy action
}

// Gọi action với các tham số còn lại (nếu có)
call_user_func_array([$controller, $action], array_slice($url, 2));
?>
