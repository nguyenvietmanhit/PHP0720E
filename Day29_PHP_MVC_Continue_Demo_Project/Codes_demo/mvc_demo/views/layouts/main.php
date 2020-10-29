<?php
/**
 * views/layouts/main.php
 * File layout của ứng dụng, chứa các thành phần chung
 * để các view cùng sử dụng
 */
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Title</title>
  <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
<div class="header">
  <h1>Đây là header</h1>
</div>
<div class="main">
    <?php
    // Hiển thị lỗi ở file layout, vì view nào cũng phải
    //nhúng file layout vào
    echo "<p style='color: red'>$this->error</p>";

    // Hiển thị session thành công nếu có
    if (isset($_SESSION['success'])) {
        echo $_SESSION['success'];
        unset($_SESSION['success']);
    }
    ?>
<!--  Đổ dữ liệu động của từng view vào đây-->
  <?php
  // Do bên controller đã nhúng file layout r nên file này
  //có thể sử dụng đc các thuộc tính của controller đó
  echo $this->content;
  ?>
</div>
<div class="footer">
  <h1>Đây là footer</h1>
</div>
<script src="assets/js/script.js"></script>
</body>
</html>
