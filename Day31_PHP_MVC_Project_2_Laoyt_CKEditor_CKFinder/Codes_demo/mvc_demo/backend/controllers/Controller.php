<?php
// controllers/Controller.php
// Đóng vai trò là controller cha, chứa các thuộc tính/phương thức
// chung để các class con kế thừa từ nó chỉ việc sử dụng mà ko cần
// khai báo lại
class Controller {
    // Thuộc tính chứa nội dung view động
    public $content;
    // Thuộc tính chứa lỗi
    public $error;
    // THuộc tính hiển thị tiêu đề trang
    public $page_title;

    // PHương thức lấy nội dung view dựa vào đường dẫn tới view đó,
    // có cơ chế truyền biến ra view để sử dụng
    // $view_path: đường dẫn tới view
    // $variables: mảng các phần tử sẽ truyền ra view
    public function render($view_path, $variables = []) {
       extract($variables);

       ob_start();
       require_once "$view_path";
       $render_view = ob_get_clean();

       return $render_view;
    }
}