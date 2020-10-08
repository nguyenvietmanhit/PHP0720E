<?php
//Bài thực hành 1:
//tạo cấu trúc file như sau
//example_demo/thuc_hanh_1.php
//+ Tìm các số nguyên tố mà nhỏ hơn số nhập vào
//+ Yêu cầu validate:
//Nếu để trống ô nhập, báo lỗi ‘Không được để trống’
//Nếu nhập không phải số, báo lỗi ‘Cần phải nhập số‘
//XỬ LÝ SUBMIT FORM
//1 - Khai báo các biến chứa lỗi và chứa kết quả
$error = '';
$result = '';
//debug mảng dữ liệu gửi lên từ form,
// dựa vào phương thức của form
echo "<pre>";
print_r($_POST);
echo "</pre>";
//2 - Kiểm tra nếu user submit form thì mới xử lý
if (isset($_POST['submit'])) {
    //gán biến trung gian để thao tác cho dễ
    $number = $_POST['number'];
    //3 - Validate form
    if (empty($number)) {
        $error = 'Ko đc để trống';
    } else if (!is_numeric($number)) {
        $error = 'Phải nhập số';
    }
    //4 - Xử lý logic submit form theo đề bài, chỉ xử lý khi
    //ko có lỗi xảy ra
    if (empty($error)) {
        $result = "Các số nguyên tố nhỏ hơn $number là: ";
        for ($i = 0; $i < $number; $i++) {
            //gọi hàm kiểm tra số nguyên tố
            if (isPrime($i)) {
                $result .= "$i ";
            }
        }
    }
}
function isPrime($number) {
    if ($number < 2) {
        return FALSE;
    }
    //định nghĩa số nguyên tố: chỉ chia hết cho 1 và chính nó
    //thuật toán: chạy vòng lặp từ 2 -> number, kiểm tra nếu
    //chỉ cần number chia hết cho biến lặp tại 1 lần lặp nào
    //đó thì -> gắn cờ là ko phải số nguyên tố, và ngược lại
    $is_prime = TRUE;
    //hàm sqrt: tính căn bậc 2 của 1 số
    for ($i = 2; $i <= sqrt($number); $i++) {
        if ($number % $i == 0) {
            $is_prime = FALSE;
            //sau khi phát hiện đc trường hợp chia hết,
            //thoát luôn vòng lặp mà ko cần check các case
            //còn lại nữa
            break;
        }
    }
    return $is_prime;
}
?>
<h3 style="color: red"><?php echo $error; ?></h3>
<h3 style="color: green"><?php echo $result; ?></h3>
<form action="" method="post">
    Nhập số cần kiểm tra:
<!--  đổ lại dữ liệu đã nhập   -->
    <input type="text" name="number"
value="<?php echo
    isset($_POST['number']) ? $_POST['number'] : '' ?>" />
    <br />
    <input type="submit" name="submit" value="Kiểm tra" />
</form>