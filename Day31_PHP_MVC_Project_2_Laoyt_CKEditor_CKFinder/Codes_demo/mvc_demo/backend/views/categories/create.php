<?php
//mvc_demo/views/categories/create.php
//Hiển thị form thêm mới category
// Bảng categories: id, name, type, avatar, description, status
// created_at, updated_at
?>
<form action="" method="post" enctype="multipart/form-data">
    Nhập tên:
    <input type="text" name="name" class="form-control" />
    <br />
    Nhập mô tả:
    <textarea name="category_description" class="form-control"></textarea>
    <br />
    <input type="submit" name="submit" value="Lưu" />
</form>
<!--
Hướng dẫn tích hợp trình soạn thảo CKEditor và trình upload ảnh
CKFinder vào textarea
 - Tích hợp CKEditor:
 + Tải CKEditor về
 + Với mô hình MVC -> assets/ckeditor
 + Nhúng file ckeditor/ckeditor.js vào file layout của bạn
 + Viết code JS để tích hợp CKEditor vào textarea dựa theo thuộc
 tính name của textarea đó
 - Tích hợp CKFinder để có chức năng upload ảnh từ local
 + Tải CKFinder về
 + Với MVC hiện tại, đặt vào thư mục assets/ckfinder
 + Code JS để tích hợp CKFinder vào CKEditor
 + Do CKFinder ko phải bản free, cần crack, tham khảo slide
 CKFinder.ppt để crack
-->

