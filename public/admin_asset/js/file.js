//confirm delete
function confirm_delete() {
    del = confirm("Bạn có chắc muốn xóa hay không?");
    return del;
}

//ajax result post
// $("#savePost").click(function () {
// });
// $(document).ready(function () {
//     $(document).on('click', '#savePost', function () {
//         $.ajax({
//             url: "admin/posts/content_post", // gửi ajax đến file result.php
//             type: "get", // chọn phương thức gửi là get ( có thể là post hoặc get )
//             dataType: "html", // dữ liệu trả về dạng text ( có thể là html. json, xml, script hoặc text ),
//             success: function (result) {
//                 // Sau khi gửi và kết quả trả về thành công thì gán nội dung trả về
//                 // đó vào thẻ div có id = result
//                 $('#posts_result').html(result);
//             }
//         });
//     });
// });
