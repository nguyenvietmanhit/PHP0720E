<?php
/**
 * Code nhóm với Git
 * - Giảng viên là PM/Trưởng nhóm:
 * + Tạo respositories của dự án
 * + Add các member vào
 * + Là người review code: code mà chưa ổn -> đẩy lại
 * cho dev code lại
 *  * rm -rf .idea/
 * git add *
 * git add .
 * git commit -m "Commit dau tien cua du an moi"
 * git push origin master
 * + Vào Repso của bạn -> Settings -> Manage Access
 * -> Invite a collaborators
 *
 *
 * - Các học viên là các Dev:
 * + Clone dự án về: git clone
 * + Trong project vừa clone về, mỗi dev tạo 1 file:
 * <tên-ban>.php, trong file này echo <tên-bạn>;
 * + Thử git status, git add, git commit,
 * git push origin master
 * xem có push dc ko ? -> ko thể push đc
 * + Cần phải đc add vào làm member của respo đó,
 * + Sau khi đc trưởng nhóm add vào git, thử git add,
 * git commit, git push -> ok
 * + Thực tế sẽ ko bao giờ dùng chung 1 nhánh master,
 * nhánh master là nhánh chứa code chạy hoàn chỉnh nhất,
 * PM cần cấu hình để ko cho phép push code lên nhánh này
 * + Quy trình thực tế:
 * - PM giao bạn A 1 task: login
 * - Cần checkout về nhánh master, lấy dữ liệu mới nhất
 * từ nhánh này: git pull origin master
 * - Checkout sang 1 nhánh mới từ nhánh master ban đầu,
 * , vd tạo 1 branch mới tên là a_login:
 * git checkout -b <tên-nhánh-của-bạn>
 * Tạo branch của bạn theo cú pháp theo các bước sau:
 * git checkout master
 * git pull origin master
 * git checkout -b <Tên-ban>_login
 * - Code chức năng đc giao trên branch mới tạo
 * - VD: tạo <tên-cua-bạn>/login.php, echo "Login.php";
 * - Code xong, lại làm làm lại các thao tác:
 * git status
 * git add
 * git commit
 * Chú ý ko đẩy lên nhánh master nữa:
 * git push origin <nhánh-của-bạn>
 *