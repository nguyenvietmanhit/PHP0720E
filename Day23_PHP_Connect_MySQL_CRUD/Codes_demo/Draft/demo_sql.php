# SQL ko phân biệt hoa thường: create và CREATE là như nhau, từ khóa nên viết hoa
# Kết thúc câu SQL luôn là dấu ;
# SQL rất chặt chẽ về mặt cú pháp
# 1 - Tạo CSDL:
CREATE DATABASE php0720e_test1;
# Tạo CSDL theo cấu trúc đầy đủ, có thể dùng utf8_unicode_ci
# cho COLLATE
CREATE DATABASE IF NOT EXISTS php0720e_mysql
CHARACTER SET utf8 COLLATE utf8_general_ci;
# 2 - Xóa CSDL
DROP DATABASE php0720e_test1;
# 3 - Sử dụng CSDL, muốn tạo bảng thì phải đứng trong CSDL đó
#thì mới tạo đc, tuy nhiên với PHPMyadmin lệnh này sẽ ko có
#tác dụng, chỉ có tác dụng khi viết SQL trong command line
# nên cần click trực tiếp vào CSDL muốn thao tác
USE php0720e_mysql;
# 4 - CÁc kiểu dữ  liệu trong MySQL: số, chuỗi, ngày giờ
# + Kiểu số: tham khảo trong slide, hay dùng nhất là
# TINYINT: pham vi từ -128 -> 127
# INT: phạm vi ~-2 tỷ -> 2 tỷ
# + Kiểu chuỗi: lưu các chuỗi, hay dùng nhất là:
# VARCHAR: lưu chuỗi tối đa 255 ký tự đổ lại
# TEXT: lưu ko giới hạn ký tự
# + Kiểu ngày giờ: lưu định dạng ngày giờ, thường dùng nhất là:
# DATETIME: định dạng ngày giờ theo format YYYY-MM-DD HH:MM:SS, vd 1 giá trị hợp lệ để lưu đc dạng DATETIME: 2020-09-29 20:59:59
# TIMESTAMP: chỉ khác DATETIME ở 1 điểm duy nhất là tự động lưu đc múi giờ của hệ thống, thường dùng cho các trường sinh tự động, vd như trường ngày tạo
#5 - Tạo bảng: categories có các trường sau:
#id: khóa chính, cơ chế tạo theo kiểu mỗi 1 bản ghi sinh ra, tự động tăng giá trị cho trường này lên 1, INT(11)
#name: tên danh mục, VARCHAR (100)
#description: mô tả chi tiết danh mục, TEXT
#status: trạng thái danh mục, 0 - ẩn, 1 - hiện, TINYINT(1)
#created_at: ngày tạo, để tự động sinh khi có bản ghi đc tạo, TIMESTAMP
CREATE TABLE categories(
id INT(11) AUTO_INCREMENT, #khóa chính, tự động tăng
name VARCHAR(100) DEFAULT NULL, #DEFAULT NuLL cho phép name rỗng vẫn đc lưu, ngược lại là NOT NULL
description TEXT,
status TINYINT(1) DEFAULT 0,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
#sau khi khai báo các trường, set khóa chính, khóa ngoại cho bảng
PRIMARY KEY (id)
);


# 6 - Tạo bảng products: chứa các thông tin về sản phẩm:
# id: khóa chính, int - auto_increment
# category_id: khóa ngoại, liên kết với bảng categories: int - 11
# name: tên sp, varchar - 150
# price: giá sp, int - 11
# created_at: ngày tạo, TIMESTAMP
CREATE TABLE products(
id INT(11) AUTO_INCREMENT,
category_id INT(11) DEFAULT NULL,
name VARCHAR(150),
price INT(11),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
#khai báo khóa chính và khóa ngoại cho bảng
PRIMARY KEY (id),
FOREIGN KEY (category_id) REFERENCES categories(id)
);
# Có thể tạo ra lược đồ quan hệ 1 cách tự động
#(diagram) bằng tab Designer của MySQL, tuy nhiên
# cần phải khai báo tường minh các khóa ngoại cho
# các bảng


# 7 - Insert: thêm dữ liệu vào bảng
# Thêm dữ liệu vào bảng categories: id, name, description,
#status, created_at. Lưu chỉ thêm dữ liệu cho các trường được sinh ra 1 cách thủ công -> name, description, status
# Value thêm phải tương ứng với kiểu dữ liệu của trường
#INSERT INTO categories(name, description, status)
#VALUES('Thể thao', 'Đây là danh mục thể thao', 1);
#INSERT INTO categories (name, description, status)
#VALUES
#('Thế giới', 'Mô tả thế giới', 0),
#('Tivi', 'Mô tả tivi', 1),
#('Laptop', 'Mô tả laptop', 0)
# - THêm dữ liệu vào bảng products: id, category_id, name, price,
# created_at
# + Trường category_id do là khóa ngoại nên khi insert cần lấy
# giá trị từ trường id của bảng categories
#INSERT INTO products(category_id, name, price)
#VALUES
#(1, 'Áo cầu lông', 1000),
#(1, 'Áo bóng đá', 3000),
#(1, 'Áo trung thu', 2000),
#(2, 'Trái đất', 4000),
#(3, 'Samsung', 500),
#(3, 'Sony', 600),
#(3, 'LG', 700),
#(4, 'Asus', 800),
#(4, 'Dell', 900),
#(4, 'Acer', 1000);
# 8 - Truy vấn SELECT: lấy dữ liệu từ bảng ra
# + Lấy toàn bộ dữ liệu từ bảng products, với ký tự * đại diện cho toàn bộ cột của bảng
SELECT * FROM products