<?php
session_start();
//Cần set lại múi giờ về quốc gia hiện tại
date_default_timezone_set('Asia/Ho_Chi_Minh');
//echo date_default_timezone_get();
//echo date('Y-m-d H:i:s');
/**
 * - Viết truy vấn để tạo CSDL và bảng
 * + CSDL: php0720e_mvc
 * CREATE DATABASE IF NOT EXISTS php0720e_mvc
 * CHARACTER SET utf8 COLLATE utf8_general_ci
 * + Bảng categories:
 * id, name, description, status, created_at
 * CREATE TABLE categories(
id INT(11) AUTO_INCREMENT,
name VARCHAR(100),
description TEXT,
status TINYINT(1) DEFAULT 1,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
#set khóa chính
PRIMARY KEY (id)
);
 *
 * mvc_demo/index.php
 * - Đây là file index gốc của ứng dụng MVC, là file code đầu
 * tiên khi code MVC, vì đây là file sẽ nhận toàn bộ các request
 * gửi đến, file này quyết định gọi controller nào xử lý
 * - Ý tưởng code: phân tích URL, lấy đc controller và action
 * tương ứng, khởi tạo obj controller, từ đối tượng đó truy
 * cập action tương ứng
 * - Với MVC, thì các url khi định nghĩa ra cần phải tuân theo
 * quy định của chính bạn, với MVC này url luôn có dạng như sau:
 * index.php?controller=<tên-controller>
 * &action=<tên-phương-thức-của-controller>
 * VD: index.php?controller=category&action=create
 *     index.php?controller=category&action=index
 * - Khi code MVC, cần thay đổi tư duy nhúng file: nhúng file
 * tính từ file index.php gốc của ứng dụng
 * - Quy tắc đặt tên file bắt buộc với mô hình MVC này:
 * + Tên file model: Category.php, Product.php, OrderDetail.php
 * + Tên file controllers: CategoryController.php,
 *ProductController.php, OrderDetailController.php
 * - Demo chức năng thêm mới danh mục:
 * index.php?controller=category&action=create
 */
//echo "index.php";
// - Lấy ra các giá trị của các tham số từ url, cần bắt chặt
//chẽ để đề phòng trang chủ, là trang ko truyền tham số gì
//lên url cả
// Mặc định nếu là trang chủ thì do controller=home xử lý
$controller = isset($_GET['controller']) ? $_GET['controller'] :
'home';
//echo $controller;//category ????
// Lấy tham số action từ url:
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
//echo $action; //create

// - Phân tích controller, biến đổi thành tên file controller
//tương ứng, mục đích để nhúng file controller đó vào
// Với CRUD danh mục thì file controller đích là:
// CategoryController.php, biến $category = category
// Biến đổi ký tự đầu tiên -> ký tự hoa
$controller = ucfirst($controller); //Category
// Nối thêm chuỗi Controller vào sau
$controller .= "Controller"; //CategoryController
// Tạo biến khác để lưu tên file controller
$controller_file = "$controller.php"; //CategoryController.php
//Tạo biến chứa đường dẫn tới file controller trên, để chuẩn
//bị nhúng file, luôn phải lưu ý là đứng từ file index gốc
//của ứng dụng để nhúng file
$controller_path = "controllers/$controller_file";
// Kiểm tra nếu ko tồn tại file thì báo Not found
if (!file_exists($controller_path)) {
  die('Trang bạn tìm không tồn tại');
}
//Thực hiện nhúng file để khởi tạo đối tượng từ class trong file
//đó
require_once "$controller_path";
// Khởi tạo đối tượng từ class controller
$obj = new $controller();
// Gọi phương thức tương ứng với action từ url từ obj vừa khởi
//tạo
// Cần check nếu tồn tại phương thức trong class thì mới truy
//cập đc
if (!method_exists($obj, $action)) {
  die("Phương thức $action ko tồn tại trong $controller");
}
//Đối tượng truy cập phương thức
$obj->$action();
