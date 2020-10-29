<?php
require_once 'configs/Database.php';
/**
 * models/Category.php
 * Model quản lý các tương tác với bảng categories
 * Model ánh xạ bảng
 */
class Category {
  // Khai báo thuộc tính chính là trường của bảng
  public $id;
  public $name;
  public $description;
  public $status;
  public $created_at;

  // Khai báo thuộc tính kết nối CSDL
  public $connection;

  //Lấy đối tượng kết nối theo PDO
  public function getConnection() {
    try {
      // Do cần sử dụng các hằng số trong class Database, cần
      // nhúng file
      $connection = new PDO(Database::DB_DSN,
          Database::DB_USERNAME,
          Database::DB_PASSWORD);
      return $connection;
    } catch (PDOException $e) {
      die("Lỗi kết nối: " . $e->getMessage());
    }
  }

  // Thêm dữ liệu vào bảng
  public function insertData() {
    // - LẤy đối tượng kết nối CSDL
    $this->connection = $this->getConnection();
    // - Tạo câu truy vấn dưới dạng tham số để tránh lỗi bảo
    //mật SQL Injection
    $sql_insert = "INSERT INTO categories(name, description)
    VALUES(:name, :description)";
    // - Chuẩn bị đối tượng truy vấn
    $obj_insert = $this->connection->prepare($sql_insert);
    // - Tạo mảng để truyền giá trị thật cho tham số trong
//    câu truy vấn nếu có
    //Giá trị thật đến từ chính thuộc tính của model
    $inserts = [
        ':name' => $this->name,
        ':description' => $this->description
    ];
    // - Thực thi đối tượng truy vấn vừa tạo
    // Với truy vấn INSERT, UPDATE, DELETE ->boolean
    $is_insert = $obj_insert->execute($inserts);
    return $is_insert;
  }

  /**
   * Lấy tất cả danh mục đang có trên hệ thống
   */
  public function getAll() {
    // - Tạo câu truy vấn
    $sql_select_all = "SELECT * FROM categories 
    ORDER BY created_at DESC";
    // - Lấy đối tượng kết nối
    $this->connection = $this->getConnection();
    // - Chuẩn bị đối tượng truy vấn
    $obj_select_all = $this->connection
                      ->prepare($sql_select_all);
    // - Bỏ qua bước tạo mảng vì câu truy vấn ko có tham số nào
    // - Thực thi đối tượng truy vấn vừa tạo, với truy vấn
    // SELECT thì ko cần thao tác với kqua trả về
    $obj_select_all->execute();
    // - Trả về mảng các danh mục sau khi execute
    $categories = $obj_select_all
                  ->fetchAll(PDO::FETCH_ASSOC);
    return $categories;
  }
}