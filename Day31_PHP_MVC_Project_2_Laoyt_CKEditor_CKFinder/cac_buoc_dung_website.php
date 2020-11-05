<?php
/**
 * Các bước chính dựng website
 * 1 - Chuẩn bị được giao diện tĩnh (HTML/CSS/JS) hoàn chỉnh
 * cho tất cả các trang
 * Frontend:
 * Backend:
 * - có thể tìm các template free trên mạng cho
 * cả frontend và backend
 * 2 - Phân tích CSDL từ giao diện đã chuẩn bị:
 * Phân tích từng trang HTML -> đi từ trên xuống dưới xem các vùng
 * hiển thị có cần phải lưu lại trong CSDL
 * Với các dữ liệu ít thay đổi thì chưa cần phải lưu vào CSDL
 * + Bảng menus: lưu trữ thông tin của menu
 * id: INT(11) AUTO_INCREMENT, khóa chính
 * name: tên link, VARCHAR(100)
 * link: url của link, VARCHAR(150)
 * parent_id: id của link cha dùng cho menu đa cấp, INT(11)
 * status: 0 - ẩn, 1 - hiển thị -> TINYINT
 * created_at: ngày tạo, TIMESTAMP, CURRENT_TIMESTAMP
 * updated_at: ngày cập nhật cuối cùng, DATETIME,
 * + Bảng products
 * id, status, created_at, updated_at
 * avatar: tên file ảnh, VARCHAR(100)
 * price: giá sp, INT(11)
 * price_discount: giá sau khi giảm INT(11)
 * description: mô tả chi tiết sp TEXT
 * title: tên sp, VARCHAR(150)
 * category_id: khóa ngoại, liên kết với bảng categories, thể hiện
 * cho mối quan hệ: 1 sp chỉ thuộc về 1 danh mục nào đó
 * summary: mô tả ngắn cho sp, TEXT
 * amount: số sp trong kho, INT(11)
 * seo_title: SEO tiêu đề cho sp, VARCHAR(255)
 * seo_description: SEO cho phần mô tả, VARCHAR(255)
 * seo_keywords: SEO các từ khóa VARCHAR(255)
 * + Bảng categories: chứa thông tin danh mục
 * id, status, created_at, updated_at
 * name: tên danh mục, VARCHAR(100)
 * avatar: tên file ảnh, VARCHAR(100)
 * type: phân loại danh mục: 1 - SP, 2 - News, TINYINT(1)
 * description: mô tả danh mục, TEXT
 * + Bảng news: lưu thông tin về tin tức
 * id, status, created_at, updated_at
 * category_id: id của danh mục, INT(11)
 * title: tên news, VARCHAR(150)
 * content: chi tiết tin, TEXT
 * avatar: tên file ảnh, VARCHAR(100)
 * seo_title, seo_description, seo_keywords: liên quan đến SEO
 *+ Bảng contacts: lưu thông tin liên hệ:
 * id, status, created_at, updated_at
 * fullname: tên ng liên hệ, VARCHAR
 * phone: sđt, INT
 * email: VARCHAR
 * content: TEXT
 * + Bảng users: lưu user cho toàn hệ thống
 * id, status, created_at, updated_at
 * username: tên đăng nhập, VARCHAR
 * password: mật khẩu, VARCHAR
 * fullname: họ tên
 * phone: sđt
 * email
 * address
 * role_id: khóa ngoại, liên kết với bảng roles, 1 user chỉ có 1
 * quyền duy nhất
 * ....
 * + Bảng roles: lưu các quyền trên hệ thống
 * id, status, created_at, updated_at
 * name: tên quyền: super admin, sales, editor, user ...
 * + Bảng orders: lưu các thông tin đơn hàng
 * id,
 * payment_status: 0 - chưa thanh toán, 1 - đã thanh toán,
 * 2 - đang trả góp 3 - đang giao hàng .... TINYINT(1)
 * created_at
 * updated_at
 * user_id: khóa ngoại, lưu lại id của user nếu đã đăng nhập
 * fullname: tên ng mua hàng
 * address: địa chỉ ng mua
 * mobile: sđt
 * email:
 * note:
 * price_total: tổng giá trị đơn hàng INT(11)
 * + Bảng order_details: lưu thông tin chi tiết đơn hàng: mua bao
 * nhiêu sp, mỗi sp có số lượng bao nhiêu. 1 orders sẽ có nhiều
 * order_details
 * id
 * order_id: khóa ngoại, liên kết với bảng orders
 * product_id: khóa ngoại, liên kết với bảng products
 * quantity: số lượng sp tương ứng đã mua
 * price: giá tại thời điểm đặt hàng
 *
 * 3 - Tạo CSDL và tạo các bảng sau khi phân tích
 * + Tạo CSDL php0720e_project:
 * CREATE DATABASE IF NOT EXISTS php0720e_project
 * CHARACTER SET utf8 COLLATE utf8_general_ci;
 * + Chọn CSDL trên, copy nội dung file file_create_db.html, chạy
 * trong tab SQL của PHPMyadmin để tạo các bảng
 *
 * 4 - Sau khi tạo CSDL và tạo các bảng thành công, vào tab Design
 * của PHPMyadmin, khi làm tài liệu lúc bảo vệ đồ án, nhớ chụp lại
 * thông tin trong tab này
 *
 * 5 - Phân tích 1 số chức năng thực tế của 1 website bán hàng,
 * để các bạn tự tư duy làm các chức năng này
 * + Backend/Admin:
 * - QL SP, News, category, user -> CRUD
 * - QL Đơn hàng: xem đơn hàng
 * a/Sửa đơn hàng ? cho phép sửa thông tin cơ bản của ng mua hàng, ko
 * cho phép sửa thông tin chi tiết của đơn hàng
 * b/In hóa đơn: đọc nội dung đơn hàng, lưu vào 1 file .pdf
 * c/ Xóa đơn hàng? cho phép xóa, lưu lại log của ng đã xóa
 * d/ Cập nhật trạng thái đơn hàng: dựa vào trạng thái thanh toán
 * của đơn hàng
 *  - Thống kê:
 * a/ Sp nào bán chạy nhất: dựa vào số lượng sp đã bán
 * b/ Đơn hàng đã thanh toán, chưa thanh toán...
 * c/ Thống kê theo ngày/tháng ...
 * - Tìm kiếm: SELECT WHERE LIKE: tìm kiếm tương đối
 * - Chức năng phân quyền:
 * - Login/Resgiter
 * - Quên mật khẩu: gửi mail chứa url dưới dạng mã hóa
 * VD: index.php?controller=user&action=forgot&email=<chuỗi-mã-hóa>
 * + Frontend:
 * - Trang chủ, chi tiết sp/news
 * - Đánh giá sản phẩm: yêu cầu đăng nhập mới cho phép đánh giá
 * CSDL, tạo bảng votes:
 * id
 * comment: nội dung đánh giá
 * user_id: id của user đánh giá, khóa ngoại
 * star: số sao đánh giá, tham khảo các plugin của JS, tạo 1
 * field ẩn trong form, khi user click chọn số sao, dùng JS
 * để set giá trị tương ứng cho input đang ẩn đó
 * - Sản phẩm yêu thích: có thể lưu các sản phẩm yêu thích vào
 * CSDL hoặc ko, lưu vào COOKIE
 * Bảng favories:
 * id
 * product_id: id của sản phẩm yêu thích
 * user_id: id của user thích sản phẩm trên, cho phép rỗng
 * - Tích hợp chat trực tuyến:
 * Facebook: search tích hợp Message của Facebook vào, có thể tích
 * hợp cả comment Facebook
 * Tích hợp công cụ chát từ bên thứ 3: Tawk.to
 * - Mã giảm giá: giảm giá cho đơn hàng của bạn
 * Bảng discounts:
 * id
 * code: mã giảm giá
 * expired_date: ngày hết hạn
 * count: số lượng tối đa cho phép sử dụng mã giảm giá
 * discount: số tiền giảm/% giảm
 * - Tự động hiển thị thông tin user mua hàng ở trang Thanh toán
 * khi user đã login
 * - Giỏ hàng/thanh toán: demo
 * - SP/tin tức liên quan:  cùng danh mục, trừ chính sp/tin hiện tại
 * - Lọc các thông tin về sp
 * ....
 *
 *
 *
 *
 *
 *
 * 6 - CODEEEEEEE
 * Thường sẽ code backend trước, backend chủ yếu là các CRUD
 * Sau đó bên Frontend sẽ lấy dữ liệu này để hiển thị
 * - Với website demo, cấu trúc thư mục theo mô hình MVC sẽ có
 * dạng sau: cả 2 đều chứa cấu trúc thư mục MVC giống hệt nhau
 * backend/
 * frontend/
 * - Với backend, tham khảo cấu trúc thư mục đã dựng sẵn theo MVC
 * đã học tại Code_demo_tren_lop/mvc_demo/backend
 * - Code file index.php gốc của ứng dụng trước
 *
 */