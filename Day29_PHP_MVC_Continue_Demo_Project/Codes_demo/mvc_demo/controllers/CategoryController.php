<?php
require_once 'models/Category.php';
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
    // - Xử lý submit form
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    if (isset($_POST['submit'])) {
      // Gán biến
      $name = $_POST['name'];
      $description = $_POST['description'];
      // Valiate form: phải nhập tất cả các trường
      if (empty($name) || empty($description)) {
        $this->error = 'Ko dc để trống';
      }
      // Lưu vào bảng categories chỉ khi ko có lỗi xảy ra
      if (empty($this->error)) {
        // Gọi Model để lưu vào CSDL, cần nhúng model vào,
        // khởi tạo đối tượng từ model này để có thể sư dụng
        //đc thuộc tính/phương thức
        $category_model = new Category();
        // Gán giá trị từ form cho thuộc tính của model, vì
        //phương thức insert dữ liệu đang thao tác với thuộc tính
        //của chính model đó
        $category_model->name = $name;
        $category_model->description = $description;
        $is_insert = $category_model->insertData();
        if ($is_insert) {
          $_SESSION['success'] = 'Thêm mới thành công';
          // Mọi url đều phải tuân theo quy tắc MVC đã đặt ra
          header
          ('Location: index.php?controller=category&action=index');
          exit();
        } else {
          $this->error = 'Thêm mới thất bại';
        }
      }
    }

    // - Lấy nội dung view create dựa vào phương thức render
    $this->content = $this
        ->render('views/categories/create.php');
    // - Gọi file layout để hiển thị nội dung view vừa lấy đe
    require_once 'views/layouts/main.php';
//    require_once 'views/categories/create.php';
  }

  public function index() {
    // Gọi model để lấy tất cả danh mục, truyền ra view để
    //view hiển thị (MVC)
    $category_model = new Category();
    $categories = $category_model->getAll();
    // Tạo mảng để truyền ra view:
    $arr = [
      'categories' => $categories
    ];
    //categories

    // Bước đầu tiên khi code 1 chức năng mới là hiển thị
    //ra view
    // - Lấy ra nội dung view
    $this->content =
    $this->render('views/categories/index.php', $arr);
    // - Gọi layout vào để hiển thị view vừa lấy đc
    require_once 'views/layouts/main.php';
  }
}