<?php
//models/User.php
require_once 'models/Model.php';
class User extends Model {
    public $username;
    public $password;

    // Lấy user theo username truyền vào
    public function getUser($username) {
        // - Tạo câu truy vấn dạng tham số do có giá trị truyền vào
        //là 1 chuỗi
        $sql_select_one =
        "SELECT * FROM users WHERE username=:username";
        // - Tạo đối tượng truy vấn,
        $obj_select_one = $this->connection->prepare($sql_select_one);
        // - Tạo mảng để truyền giá trị thật cho tham số trong câu
        //truy vấn
        $selects = [
          ':username' => $username
        ];
        // - Thực thi đối tượng truy vấn
        $obj_select_one->execute($selects);
        // - Trả về dạng mảng
        $user = $obj_select_one->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    // Đăng ký user
    public function registerUser() {
        // - Tạo câu truy vấn dạng tham số
        $sql_insert =
        "INSERT INTO users(username, password) 
         VALUES (:username, :password)";
        // - Cbi đối tượng truy vấn
        $obj_insert = $this->connection->prepare($sql_insert);
        // - Tạo mảng để gán trị thật cho tham số trong câu truy vấn
        $inserts = [
            ':username' => $this->username,
            ':password' => $this->password
        ];
        // - Thực thi đối tượng truy vấn
        $is_insert = $obj_insert->execute($inserts);
        return $is_insert;
    }

    public function getUserLogin($username, $password) {
        // - Tạo truy vấn dạng tham số
        $sql_select_one =
        "SELECT * FROM users 
         WHERE username=:username AND password=:password";
        $obj_select_one = $this->connection->prepare($sql_select_one);
        $selects = [
          ':username' => $username,
          ':password' => $password
        ];
        $obj_select_one->execute($selects);
        $user = $obj_select_one->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
}