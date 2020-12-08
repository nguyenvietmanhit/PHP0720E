<?php
require_once 'models/Model.php';
class Order extends Model {
  public $id;
  public $user_id;
  public $fullname;
  public $address;
  public $mobile;
  public $email;
  public $note;
  public $price_total;//tổng giá trị đơn hàng
  public $payment_status;//0 - chưa TT, 1 - Đã TT

  public function insertOrder() {
    // + Viết câu truy vấn dạng tham số
    $sql_insert = "INSERT INTO orders
(user_id, fullname, address, mobile, email, note,
price_total, payment_status)
VALUES(:user_id, :fullname, :address, :mobile, :email,
:note, :price_total, :payment_status)";
    // + Chuẩn bị đối tượng truy vấn: prepare
    $obj_insert = $this->connection
        ->prepare($sql_insert);
    // + Tạo mảng truyền giá trị
    $arr_insert = [
        ':user_id' => NULL,
        ':fullname' => $this->fullname,
        ':address' => $this->address,
        ':mobile' => $this->mobile,
        ':email' => $this->email,
        ':note' => $this->note,
        ':price_total' => $this->price_total,
        ':payment_status' => $this->payment_status,
    ];
    // + Thực thi: execute, do yêu cầu bài toán, sau
    //khi lưu orders thành công, cần lấy ra id của
    //order vừa lưu để insert tiếp vào bảng
    //order_details, nên hàm này cần trả về id của
    //chính nó sau khi insert
    $obj_insert->execute($arr_insert);
    $id_insert = $this->connection->lastInsertId();
    return $id_insert;
  }

}