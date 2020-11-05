// mvc_demo/assets/js/script.js
// File js chính của ứng dụng
$(document).ready(function () {
    // - Tích hợp CKEditor vào textarea dựa vào thuộc tính name của
    //textarea đó
    // - Do trình duyệt có cơ chế cache với css/js, nên sẽ có
    // trường hợp
    // thay đổi code js nhưng refresh trên trình duyệt lại ko nhận
    // sự thay đổi, cần phải xóa cache trình duyệt : Ctrl + Shift + R
    // CKEDITOR.replace('category_description');

    // - Tích hợp CKEditor và CKFinder trong 1 câu lệnh:
    CKEDITOR.replace('category_description' , {
        //đường dẫn đến file ckfinder.html của ckfinder
        filebrowserBrowseUrl: 'assets/ckfinder/ckfinder.html',
        //đường dẫn đến file connector.php của ckfinder
        filebrowserUploadUrl: 'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
    });
});
