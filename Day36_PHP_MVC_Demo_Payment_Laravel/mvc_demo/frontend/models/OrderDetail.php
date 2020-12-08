<?php
require_once 'models/Model.php';
class OrderDetail extends Model {
  public $order_id;
  public $product_id;
  public $quantity;
  public $price;
  public function insert() {
    // + Tạo truy vấn dạng tham số
    $sql_insert = "INSERT INTO 
order_details(order_id, product_id, quantity, price)
VALUES(:order_id, :product_id, :quantity, :price)";
    // + Cbi obj truy vấn
    $obj_insert = $this->connection
        ->prepare($sql_insert);
    // + Tạo mảng truyền giá trị cho tham số
    $inserts = [
      ':order_id' => $this->order_id,
      ':product_id' => $this->product_id,
      ':quantity' => $this->quantity,
      ':price' => $this->price,
    ];
    // + Thực thi
    $is_insert = $obj_insert->execute($inserts);
    return $is_insert;
  }
}