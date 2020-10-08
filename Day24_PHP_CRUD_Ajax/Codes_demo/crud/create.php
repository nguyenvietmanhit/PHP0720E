<?php
require_once 'database.php';
/**
 * crud/create.php
 * Chức năng Thêm mới thường là chức năng xây dựng đầu tiên trong ứng dụng CRUD
 * Tạo form thêm mới
 * Bảng products: id, name, avatar, description, created
 */
    
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

