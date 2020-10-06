<?php
/**
 * php_connect_mysql
 * Hướng dẫn cách sử dụng PHP kết nối tới CSDL MySQL thông qua thư viện MySQLi
 * 1 - Khái niệm
 * + MySQLi - improve
 * + Thư viện MySQLi chỉ hỗ trợ kết nối tới CSDL MySQL, để có thể kết nối tới
 * các CSDL khác như SQL Server, Oracle, SQLite, NoSQL ... thì cần sử dụng cơ chế
 * kết nối khác: PDO, tuy nhiên PDO viết hoàn toàn dựa trên Lập trình hướng
 * đối tượng
 * + Học MySQLi vì hỗ trợ các hàm PHP thuần, ngoài ra MySQLi cũng hỗ trợ kết nối
 * theo theo OOP
 * + Việc thao tác với MySQLi ko khó, bản chất khó nằm ở kỹ năng viết câu truy
 * vấn SQL
 * 2 - CODE
 * + Viết truy vấn tạo CSDL và tạo bảng
 *
# 1 - Tạo CSDL php0720e_demo
CREATE DATABASE IF NOT EXISTS php0720e_demo
CHARACTER SET utf8 COLLATE utf8_general_ci;
# 2 - Click vào CSDL vừa tạo trên PHPMyadmin
# 3 - Tạo bảng products có trường sau:
# id, name, avatar, description, created_at
CREATE TABLE products(
id INT(11) AUTO_INCREMENT,
name VARCHAR(150),
avatar VARCHAR(200),
description TEXT,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
#khai báo khóa chính và khóa ngoại nếu có
PRIMARY KEY (id)
);
 */
// Các bước kết nối CSDL MySQL từ PHP, thông qua các hàm của MySQLi
// + Khai báo các hằng số dùng cho việc kết nối
// Tên máy chủ đang lưu CSDL
const DB_HOST = 'localhost';
// Username để đăng nhập vào CSDL, khi cài XAMPP tự sinh 1 tài khoản để login
//vào CSDL là username=root và password=
const DB_USERNAME = 'root';
//Password
const DB_PASSWORD = '';
// Tên CSDL sẽ kết nối
const DB_NAME = 'php0720e_demo';
// Cổng kết nối CSDL
const DB_PORT = 3306;
// + Gọi hàm sau để kết nối tới CSDL, thư viện mysqli, các hàm của nó luôn có
//tiền tố là mysqli_
$connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD,
    DB_NAME, DB_PORT);
if (!$connection) {
    die("Kết nối thất bại. Lỗi: " . mysqli_connect_error());
}
// Ko cần sử dụng else trong trường hợp này
echo "<h1>Kết nối CSDL thành công</h1>";

// + Code PHP Insert dữ liệu vào bảng products của CSDL php0720e_demo
// id, name, avatar, description, created_at
// Viết câu truy vấn insert
$sql_insert = "INSERT INTO products(name, avatar, description)
VALUES 
('Tivi', 'tivi.jpg', 'Mô tả cho tivi'),
('Tủ lạnh', 'tulanh.png', 'Mô tả cho tủ lạnh')";
// Thực thi truy vấn vừa tạo, sử dụng hàm mysqli_query, với các truy vấn
// INSERT, UPDATE, DELETE thì hàm mysqli_query luôn trả về boolean
//Còn với truy vấn SELECT thì hàm trên trả về 1 đối tượng trung gian
$is_insert = mysqli_query($connection, $sql_insert);
// Cách debug khi kết quả trả về false: copy câu truy vấn chạy trên PHPMyadmin
var_dump($is_insert);

// + Truy vấn UPDATE: update name = New name cho các bản ghi có id < 3
// - Tạo câu truy vấn update, chú ý với truy vấn UPDATE/DELETE luôn phải kèm
//theo điều kiện
$sql_update = "UPDATE products SET name = 'New name' WHERE id < 3";
// - Thưc thi truy vấn vừa tạo:
$is_update = mysqli_query($connection, $sql_update);
var_dump($is_update);

// + Truy vấn DELETE: xóa các bản ghi mà có id > 10
// - Tạo câu truy vấn xóa
$sql_delete = "DELETE FROM products WHERE id > 10";
// - Thực thi truy vấn vừa tạo
$is_delete = mysqli_query($connection, $sql_delete);
var_dump($is_delete);

// + Truy vấn SELECT: chia làm 2 kiểu sau
// - Truy vấn SELECT lấy ra nhiều bản ghi: Lấy thông tin toàn bộ sản phẩm trong
// bảng products
// B1: Tạo câu truy vấn
$sql_select_all = "SELECT * FROM products";
// B2: Thực thi truy vấn vừa tạo, dùng hàm mysqli_query tuy nhiên kiểu dữ liệu trả
//về của hàm này với truy vấn SELECT ko phải là boolean, mà 1 object trung gian
$result_all = mysqli_query($connection, $sql_select_all);
// B3: Trả về mảng kết quả dựa trên đối tượng trung gian trên, cần truyền vào
// tham số thứ 2 hằng số MYSQLI_ASSOC để trả về dữ liệu kiểu mảng
$products = mysqli_fetch_all($result_all, MYSQLI_ASSOC);
foreach ($products AS $product) {
    echo $product['name'] . "<br />";
}
echo "<pre>";
print_r($products);
echo "</pre>";

// - Truy vấn SELECT lấy ra 1 bản ghi duy nhất: lấy sản phẩm có id = 5
// B1: Tạo câu truy vấn
$sql_select_one = "SELECT * FROM products WHERE id = 5";
// B2: Thực thi câu truy vấn vừa tạo
$result_one = mysqli_query($connection, $sql_select_one);
// B3: Trả về mảng kết quả dựa trên đối tượng trung gian vừa lấy đc
$product = mysqli_fetch_assoc($result_one);
echo "<pre>";
print_r($product);
echo "</pre>";

// Sau khi hoàn thành các câu truy vấn, cần đóng kết nối để giải phòng tài nguyên
mysqli_close($connection);




