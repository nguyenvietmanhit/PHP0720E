<?php
/**
 * controllers/CategoryController.php
 * Về quy tắc MVC hiện tại, bắt buộc mọi tên class phải trùng
 * với tên file
 */
class CategoryController {
  //Chứa nội dung view tương ứng, dùng để đổ ra layout
  public $content;
  // Chứa nội dung lỗi khi validate form
  public $error;
  /**
   * Lấy nội dung 1 view dựa vào đường dẫn tới view đó, có
   * cơ chế truyền biến tường minh ra view để view sử dụng
   * @param $view_path
   * @param array $variables
   */
  public function render($view_path, $variables = []) {
    // - Giải nén mảng $variables truyền vào nếu có để file view
    //có thể sử dụng đc
    extract($variables);
    // - Bắt đầu tạo vùng bộ nhớ đệm để ghi nhớ việc bắt đầu
    //đọc nội dung file view từ đường dẫn truyền vào
    //offering buffer
    ob_start();
//    echo "123456";
    // Nhúng đường dẫn file
    require_once "$view_path";
    // Sau khi đọc xong nội dung file, kết thúc việc đọc bằng
    //hàm sau
    $render_view = ob_get_clean();
    return $render_view;
  }

  public function create() {
//    echo "create";
    // view create đang nằm tại đường dẫn
    // views/categories/create.php
    // Sẽ ko gọi file view đơn giản theo cách này, mà sử dụng
    //theo cơ chế Render view động - Xây dựng 1 phương thức
    //riêng để lấy nội dung view dựa vào đường dẫn

    // - Lấy nội dung view create dựa vào phương thức render
    $arr = [
        'var1' => 'Mạnh',
        'var2' => 30
    ];
    $this->content = $this
        ->render('views/categories/create.php', $arr);
    // - Gọi file layout để hiển thị nội dung view vừa lấy đe
    require_once 'views/layouts/main.php';
//    require_once 'views/categories/create.php';
  }
}