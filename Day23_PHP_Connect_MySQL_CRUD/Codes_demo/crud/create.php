<?php
require_once 'database.php';
/**
 * crud/create.php
 * Chức năng Thêm mới thường là chức năng xây dựng đầu tiên trong ứng dụng CRUD
 * Tạo form thêm mới
 * Bảng products: id, name, avatar, description, created
 */
//Xử lý submit form
// + Debug mảng $_POST và $_FILES
echo "<pre>";
print_r($_POST);
echo "</pre>";
// + Tạo biến lỗi và kết quả
$error = '';
$result = '';
// + NẾu submit form thì mới xử lý
if (isset($_POST['submit'])) {
    // + Gán biến trung gian
    $name = $_POST['name'];
    $description = $_POST['description'];
    // + Validate form:
    // Name ko đc để trống
    // File upload phải là ảnh, dung lượng ko quá 2Mb
    if (empty($name)) {
        $error = 'Name ko đc để trống';
    }
    // + Thêm vào bảng products chỉ khi ko có lỗi xảy ra
    if (empty($error)) {
        // Nhúng file database.php để sử dụng đc luôn biến kết nối $connection
        // B1: Viết truy vấn insert, giá trị sẽ đến từ form
        $sql_insert = "INSERT INTO products(name, avatar, description)
        VALUES('$name', '', '$description')";
        // B2: Thực thi truy vấn vừa tạo
        $is_insert = mysqli_query($connection, $sql_insert);
        var_dump($is_insert);
    }
}

?>
<!--Do form có input upload file nên bắt buộc method=post và thêm enctype-->
<form action="" method="post" enctype="multipart/form-data">
    Nhập tên: <input type="text" name="name" value="" />
    <br />
    Upload ảnh
    <input type="file" name="avatar" />
    <br />
    Mô tả chi tiết:
    <textarea name="description"></textarea>
    <br />
    <input type="submit" name="submit" value="Lưu" />
    <input type="reset" name="reset" value="Reset form" />
</form>

