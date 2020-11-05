<?php
/**
 * PHPMailer/send_mail.php
 * - Demo gửi mail thực tế với thư viện PHPMailer\
 * - Thực tế các hệ thống đều gửi mail rất nhiều: register account,
 * đặt hàng, thanh toán ...
 * - PHP có 1 hàm gửi mail: mail()
 */
// + Gửi mail sử dụng hàm mail mặc định của PHP thuần, mặc định phải
//cấu hình các file setting của server thì mới gửi đc
mail('nguyenvietmanhit@gmail.com', 'Tiêu đề mail',
    'Body của mail');
// + Nên sử dụng thư viện gửi mail từ bên ngoài để đỡ phải cấu hình
//server: PHPMailer
// + Hướng dẫn cài đặt:
// - Comment lại đoạn code: require 'vendor/autoload.php';
// - Nhúng 3 file PHPMailer.php, SMTP.php, Exception.php ngay
//trước 3 lệnh use
require_once 'src/PHPMailer.php';
require_once 'src/SMTP.php';
require_once 'src/Exception.php';
// - Cấu hình username/password để gửi mail thông qua Gmail,
//truy cập Myccount Google của bạn: https://myaccount.google.com/
//-> Bảo mật -> Mật khẩu ứng dụng (Chú ý cần XÁc minh 2 bước mới
//có thể tạo đc mk ứng dụng)
// Username: tên đăng nhập Gmail
// Password: mật khẩu ứng dụng
// - Cấu hình host gửi mail cho $mail->Host = smtp.gmail.com


// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
//require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // - THêm cấu hình để hiển thị đc ký tự có dấu
    $mail->CharSet = 'UTF-8';
    // - Khi test để debug để xem các lỗi khi ko đc gửi mail
    // Khi chạy thật ->  tắt debug đi = SMTP::DEBUG_OFF
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'nguyenvietmanhit@gmail.com';                     // SMTP username
    $mail->Password   = 'kjuxzhdmlwhvlrav';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients: cấu hình người gửi/ người nhận mail
    $mail->setFrom('manh@gmail.com', 'Tôi là Mạnh');
//    $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
    $mail->addAddress('nguyenvietmanhit@gmail.com');               // Name is optional
//    $mail->addReplyTo('info@example.com', 'Information');
//    $mail->addCC('cc@example.com');
//    $mail->addBCC('bcc@example.com');

    // Attachments: gửi file đính kèm
    // Copy 1 ảnh bất kỳ, đặt ngang hàng với file .php hiện tại
    // Gửi file ảnh đính kèm
    $mail->addAttachment('image.jpg');         // Add attachments
//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content: Nội dung body gửi mail
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Tiêu đề mail test';
    $mail->Body    = '<h1>Body h1 gửi mail</h1>';
//    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}