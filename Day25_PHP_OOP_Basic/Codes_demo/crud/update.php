<?php
/**
 * crud/update.php
 * Hiển thị form update sản phẩm dựa theo id
 */
// + Lấy ra id dựa vào url
// VD: update.php?id=3
$id = $_GET['id'];

// + Truy cập CSDL lấy sản phẩm dựa theo id vừa lấy đc

// + Dựng form update (HTML giống hết form thêm mới), đổ dữ liệu
//mặc định của sản phẩm ra các input của form

// + Xử lý submit form (giống 80% xử lý thêm mới) ..
// -> update sản phẩm
