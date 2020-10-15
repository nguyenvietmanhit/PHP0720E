<?php
/**
 * crud/delete.php
 * Xóa bản ghi theo id truyền từ url
 */
// + LẤy giá trị id từ trình duyệt
$id = $_GET['id'];
// + KẾt nối CSDL, thực hiện truy vấn xóa theo id vừa lấy đc

// + Sau khi xóa, chuyển hướng về trang danh sách kèm thông báo
// 'Xóa thành công'