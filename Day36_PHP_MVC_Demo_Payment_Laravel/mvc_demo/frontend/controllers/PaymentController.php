<?php
require_once 'controllers/Controller.php';
require_once 'models/Order.php';
require_once 'models/OrderDetail.php';
require_once 'libraries/PHPMailer/src/PHPMailer.php';
require_once 'libraries/PHPMailer/src/SMTP.php';
require_once 'libraries/PHPMailer/src/Exception.php';

class PaymentController extends Controller
{
  public function index()
  {
    //nếu giỏ hàng trống thì ko cho phép truy cập trang này
    if (!isset($_SESSION['cart'])) {
      $_SESSION['error'] = 'Bạn chưa có sản phẩm nào trong giỏ hàng';
      header("Location: index.php");
      exit();
    }

    if (isset($_POST['submit'])) {
      $fullname = $_POST['fullname'];
      $address = $_POST['address'];
      $mobile = $_POST['mobile'];
      $email = $_POST['email'];
      $note = $_POST['note'];
      $method = $_POST['method'];
      if (empty($fullname) || empty($address) || empty($mobile)) {
        $this->error = 'Fullname, address, mobile ko đc để trống';
      }

      if (empty($this->error)) {
        $order_model = new Order();
        $order_model->fullname = $fullname;
        $order_model->address = $address;
        $order_model->mobile = $mobile;
        $order_model->email = $email;
        $order_model->note = $note;
        $price_total = 0;
        foreach ($_SESSION['cart'] as $cart) {
          $price_total += $cart['quantity'] * $cart['price'];
        }
        $order_model->price_total = $price_total;
        //mặc định là chưa thanh toán
        $order_model->payment_status = 0;
        //lưu vào bảng orders
        $order_id = $order_model->insert();
        if ($order_id > 0) {
          //lưu vào bảng order_details
          $order_detail = new OrderDetail();
          $order_detail->order_id = $order_id;
          foreach ($_SESSION['cart'] AS $product_id => $cart) {
            $order_detail->product_id = $product_id;
            $order_detail->quantity = $cart['quantity'];
            $order_detail->insert();
          }

          //xóa thông tin giỏ hàng đi
//          unset($_SESSION['cart']);
          //trường hợp chọn phương thức thanh toán là COD thì chuyển tới trang cảm ơn
          if ($method == 1) {
            $order_model->id = $order_id;
            //lấy nội dung mail từ template có sẵn
            $body = $this->render('views/payments/mail_template_order.php', ['order' => $order_model]);
            echo "<pre> >>> " . __FILE__ . "(" . __LINE__ . ")<br/>";
            print_r($body);
            echo "</pre>";
            die;
//gửi mail xác nhận đã thanh toán
            $this->sendMail($email, $body);
            $url_redirect = $_SERVER['SCRIPT_NAME'] . '/cam-on.html';
            header("Location: $url_redirect");
            exit();
          }
          //trường hợp ngược lại là thanh toán trực tuyến, thì cần lưu thông tin order và chuyển hướng đến trang thanh toán trực tuyến
          //lưu thông tin thanh toán vào session để tới trang thanh toán
          $order = $order_model->getOrder($order_id);
          //xóa thông tin giỏ hàng
//          unset($_SESSION['cart']);
          $_SESSION['order'] = $order;
          $_SESSION['success'] = 'Lưu thông tin thanh toán thành công';
          //chuyển hướng sang màn hình chọn phương thức thanh toán
          $url_redirect = $_SERVER['SCRIPT_NAME'] . '/phuong-thuc-thanh-toan.html';
          header("Location: $url_redirect");
          exit();
        } else {
          $this->error = 'Lưu thông tin thanh toán thất bại';
        }
      }
    }

    $this->content = $this->render('views/payments/index.php');
    require_once 'views/layouts/main.php';
  }

  public function thank()
  {
    //xóa thông tin giỏ hàng đi
    unset($_SESSION['cart']);
    $this->content = $this->render('views/payments/thank.php');
    require_once 'views/layouts/main.php';
  }

  public function payment()
  {

    $this->content = $this->render('libraries/nganluong/index.php');

    require_once 'views/layouts/main.php';
  }

  protected function sendMail($email, $body)
  {
    // Instantiation and passing `true` enables exceptions
    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

    try {
      //Server settings
      $mail->SMTPDebug = \PHPMailer\PHPMailer\SMTP::DEBUG_OFF;                      // Enable verbose debug output
      $mail->isSMTP();
      // Send using SMTP
      //host miễn phí của gmail
      $mail->Host = 'smtp.gmail.com';                    // Set the SMTP server to send through
      $mail->SMTPAuth = true;                                   // Enable SMTP authentication
      //username gmail của chính bạn
      $mail->Username = 'nguyenvietmanhit@gmail.com';                     // SMTP username
      //password cho ứng dụng, ko phải password của tài khoảng
//    đăng nhập gmail
//    tạo mật khẩu ứng dụng tại link:
// https://myaccount.google.com/ - menu Bảo mật
      $mail->Password = 'yichffdzhetottuw';                               // SMTP password
      $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
      $mail->Port = 587;                                    // TCP port to connect to

      //Recipients
      $mail->setFrom('abc@gmail.com', 'ABC');
      //setting mail người gửi
      $mail->addAddress($email, 'Manh');     // Add a recipient
//    $mail->addAddress('ellen@example.com');               // Name is optional
//    $mail->addReplyTo('info@example.com', 'Information');
//    $mail->addCC('cc@example.com');
//    $mail->addBCC('bcc@example.com');

      // Attachments
//      $mail->addAttachment('rose.jpeg');         // Add attachments
//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

      // Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = 'Xác nhận thông tin thanh toán';
      $mail->Body = $body;
//    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      $mail->send();
      echo 'Message has been sent';
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  }

  public function order() {
    //Xử lý submit form để lưu vào bảng orders và
    //order_details
    // + Debug mảng $_POST
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    // + Nếu user submit form thì mới xử lý
    if (isset($_POST['submit'])) {
      $fullname = $_POST['fullname'];
      $address = $_POST['address'];
      $mobile = $_POST['mobile'];
      $email = $_POST['email'];
      $note = $_POST['note'];
      // Do đã set checked cho radio COD, nên có thể
      //gán giá trị như bình thường
      $method = $_POST['method'];
      // + Validate form:
      // Fullname, address, mobile ko đc để trống
      // Fullname phải ít nhất 3 ký tự: strlen
      // Email phải đúng định dạng: filter_var
      if (empty($fullname) || empty($address) ||
      empty($mobile)) {
        $this->error = "Phải nhập fullname, email
        , mobile";
      } elseif (strlen($fullname) < 3) {
        $this->error = 'Fullname its nhất 3 ký tự';
      } elseif (!filter_var($email,
          FILTER_VALIDATE_EMAIL)) {
        $this->error = 'EMail chưa đúng định dạng';
      }

      // + NẾu ko có lỗi thì sẽ lưu thông tin đơn hàng
      if (empty($this->error)) {
        // Lưu các thông tin vào b ảng orders trước:
        // r lưu vào bảng order_details sau
        // + Lưu vào bảng orders: id, user_id, fullname
        //mobile, email, note, price_total, payment_status,
//      //created_at, updated_at
        $order_model = new Order();
        // Gán giá trị cho thuộc tính của model
        $order_model->user_id = NULL;
        $order_model->fullname = $fullname;
        $order_model->address = $address;
        $order_model->mobile = $mobile;
        $order_model->email = $email;
        $order_model->note = $note;
        // Trường price_total
        $price_total = 0;
        foreach ($_SESSION['cart'] AS $cart) {
          $total_item = $cart['quantity'] * $cart['price'];
          $price_total += $total_item;
        }
        $order_model->price_total = $price_total;
        // Trường payment_status, mặc định đơn hàng mới sẽ
        //là chưa thanh toán
        $order_model->payment_status = 0;
        $order_id = $order_model->insertOrder();
//        var_dump($order_id);
        // + Lưu vào bảng order_details: chứa chi tiết
        //đơn hàng, sửa lại thành các trường sau:
        //id, order_id, product_id, quantity, price
        $order_detail_model = new OrderDetail();
        $order_detail_model->order_id = $order_id;
        foreach ($_SESSION['cart'] AS $product_id => $cart){
          $order_detail_model->product_id = $product_id;
          $order_detail_model->quantity = $cart['quantity'];
          $order_detail_model->price = $cart['price'];
          $is_insert = $order_detail_model->insert();
          var_dump($is_insert);
        }

        // + Điều hướng user dựa vào Phương thức
        //thanh toán mà họ chọn
        // + NẾu chọn Thanh toán online -> trang Ngân
        //lượng
        if ($method == 0) {
          // Tạo session chứa thông tin để hiển
          //thị ở trang ngân lượng
          $_SESSION['payment'] = [
            'price_total' => $price_total,
            'fullname' => $fullname,
            'email' => $email,
            'mobile' => $mobile
          ];
          header
          ('Location: index.php?controller=payment&action=online');
          exit();
        }
        else {
          // là thanh toán COD, gửi mail cho email
          // Body mail là 1 template demo đc cbi sẵn
          $body = $this
      ->render('views/payments/mail_template_order.php');
//          var_dump($body);die;
          $this->sendMail($email, $body);
          // Chuyển hướng về trang cảm ơn sau khi
          //send mail
        }
      }
    }
    // Lấy view
    $this->content =
    $this->render('views/payments/index.php');
    // Gọi layout để hiển thị
    require_once 'views/layouts/main.php';
  }

  public function online() {
    $this->content =
    $this->render('libraries/nganluong/index.php');
    // Ko gọi layout, hiển thị ra view luôn
    echo $this->content;
  }
}