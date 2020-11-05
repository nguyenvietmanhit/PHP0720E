<?php
require_once 'controllers/Controller.php';
// Cần nhúng file vào trước khi sử dụng nội dung bên trong file
// controllers/CategoryController.php
// + Áp dụng tính chất kế thừa của OOP để khai báo
// các thuộc tính và phương thức dùng chung tại class
// controller cha
class CategoryController extends Controller {

    public function create() {
        // Set giá trị cho thuộc tính page_title
        $this->page_title = 'Trang thêm mới danh mục';

        // - Lấy nội dung view tương ứng, đổ vào thuộc tính content
        $this->content =
        $this->render('views/categories/create.php');
        // - Gọi layout để hiển thị nội dung view vừa lấy đc
        require_once 'views/layouts/main.php';
    }
}