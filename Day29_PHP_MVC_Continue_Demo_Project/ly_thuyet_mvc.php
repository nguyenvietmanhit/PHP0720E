<?php
/**
 * ly_thuyet_mvc.php
 * 1 - Khái niệm
 * + Model - View - Controller
 * + Framework, CMS của PHP đều đc dựng dựa trên MVC
 * + Tách biệt website thành 3 thành riêng biệt
 * + Do viết dựa trên OOP nên khá khó học với các bạn mới
 * 2 - Thành phần
 * + M - Model: tương tác với CSDL - code thao tác với CSDL
 * (SELECT, INSERT, UPDATE, DELETE) đều viết hết trong class
 * Model này
 * + V - View: nơi hiển thị giao diện tới người dùng
 * + C - Controller: trung gian, luân chuyển dữ liệu giữa
 * M và V
 * 3 - Xây dựng ứng dụng CRUD danh mục theo mô hình MVC theo
 * các bước sau:
 * - Dựng cấu trúc thư mục MVC
 * mvc_demo/assets/: chứa css, js, image, font ...
 *                /css/style.css: chứa các file css
 *                /js/script.js: chứa các file js
 *                /images/abc.png: chứa các ảnh
 *        /configs: chứa các cấu hình hệ thống như DB, Mail...
 *                /Database.php: class chứa cấu hình DB
 *        /controllers: chứa các class Controleller - C
 *                    /CategoryController.php
 *        /models: chứa các class Model - M trong MVC
 *               /Category.php
 *        /views: chứa các thư mục con liên quan đến đối tượng
 *              /categories: chứa các file crud của danh mục
 *                         /index.php: liệt kê danh mục
 *                         /create.php: thêm mới danh mục
 *                         /update.php: cập nhật danh mục
 *              /layouts: chứa các file layout của ứng dụng
 *                      /main.php
 *        /index.php: file index gốc của ứng dụng
 *        /.htaccess: file rewrite url
 */