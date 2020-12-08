<?php
/**
 * Quy trình đẩy website từ local -> server thật
 * + 2 thuật ngữ khi đẩy website:
 * - hosting: thư mục lưu trữ website của bạn, trên local
 * -> htdocs là hosting
 * - domain: tên miền: 123.156.12.123, địa chỉ của website
 * , thay vì dùng IP khó nhớ với ng dùng
 * + ITPlus đã cấp cả hosting và domain cho bạn
 * + Khi thuê host -> cung cấp account để kết nối vào
 * host của họ, có 1 số giao thức truyền file:
 * FTP: 21
 * FTPS: bảo mật hơn FTP
 * SFTP:
 * SSH: bảo mật nhất, thao tác thông qua commandline
 * + Đẩy code lên bằng cách nào: dùng các công cụ để đẩy
 * vd: FileZilla, PHPStorm
 * + Lấy thư mục Day35/mvc_demo_upload
 * + Sử dụng PHPStorm, làm các bước sau để cấu hình:
 * - Mở project sẽ upload lên server
 * - Menu Tools -> Deployment -> Configuration
 * - Sau khi kết nối thành công, xem cấu trúc file/thư
 * mục trực tiếp trên server bằng Tools -> Deployment
 * -> Browse Remote Host
 * - Trên local, tạo 1 file test.php
 * , echo tên của bạn
 * - Sau khi đẩy toàn bộ project lên, cài
 * đặt thông tin kết nối CSDL dựa vào
 * account đc cấp
 * - ITPlus quản trị CSDL sử dụng phpmyadmin:
 * <tên-domain>/phpmyadmin
 */
?>