<?php
require_once 'database.php';
/**
 * crud/create.php
 * Chức năng Thêm mới thường là chức năng xây dựng đầu tiên trong ứng dụng CRUD
 * Tạo form thêm mới
 * Bảng products: id, name, avatar, description, created
 */
// XỬ LÝ SUBMIT FORM
// + Tạo biến chứa lỗi và thành công nếu có
$error = '';
$result = '';
// + Debug các mảng liên quan dựa vào phương thức của form
echo "<pre>";
print_r($_POST);
print_r($_FILES);
echo "</pre>";
// + Nếu submit form thì mới xử lý
if (isset($_POST['submit'])) {
    // + Gán các biến trung gian cho dễ thao tác
    $name = $_POST['name'];
    $description = $_POST['description'];
    $avatars = $_FILES['avatar'];
    // + Validate form:
    // - Name ko đc để trống: empty
    // - Name phải nhập ít nhất 3 ký tự trở lên: strlen
    // - File upload phải có định dạng ảnh, dung lượng ko vượt quá 2Mb
    if (empty($name)) {
        $error = 'Name ko đc để trống';
    } else if (strlen($name) < 3) {
        $error = 'Name phải nhập ít nhất 3 ký tự';
    }
    // - Khi xử lý với file, luôn cần kiểm tra nếu có file đc upload thành công
    // thì mới xử lý -> error = 0 -> có file upload, ngược lại là có lỗi
    else if ($avatars['error'] == 0) {
        // - Xử lý validate file dạng ảnh
        // Lấy ra đuôi file dựa vào tên file upload
        $extension = pathinfo($avatars['name'], PATHINFO_EXTENSION);
        // Chuyển đuôi file về chữ thường
        $extension = strtolower($extension);
        $extension_allowed = ['png', 'jpg', 'jpeg', 'gif'];
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

