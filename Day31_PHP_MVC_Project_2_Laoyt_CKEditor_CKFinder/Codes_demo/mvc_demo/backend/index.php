<?php
session_start();
//Set múi giờ
date_default_timezone_set('Asia/Ho_Chi_Minh');
/**
 * backend/index.php
 * File index gốc của ứng dụng, là file đầu tiên sẽ code trong mô
 * hình MVC
 * + Mục đích: phân tích url, gọi đúng controller và action để xử lý
 *
 */
// URL trong MVC hiên tại luôn có dạng sau:
//index.php?controller=category&action=create
// - Từ url lấy ra controller và action
$controller = isset($_GET['controller']) ?
    $_GET['controller'] : 'home'; //category
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
// - Biến đổi giá trị controller -> tên file để nhúng file controller
// CategoryController.php
$controller = ucfirst($controller); //Category
$controller .= "Controller"; //CategoryController
$controller_path = "controllers/$controller.php";
//controllers/CategoryController.php
// - Nhúng file dựa vào đường dẫn
if (!file_exists($controller_path)) {
    die('Trang bạn tìm ko tồn tại');
}
require_once $controller_path;
// - KHởi tạo đối tượng từ class controller
$obj = new $controller();
// - Kiểm tra nếu phương thức ko tồn tại thì báo lỗi
if (!method_exists($obj, $action)) {
    die("Phương thức $action ko tồn tại trong class $controller");
}
$obj->$action();
//Test lại url sau:
//index.php?controller=category&action=create
?>