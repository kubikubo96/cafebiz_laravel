<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script language="javascript" src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script language="javascript">

        function load_ajax()
        {
            $.ajax({
                url : "admin/posts/result", // gửi ajax đến file result.php
                type : "get", // chọn phương thức gửi là get ( có thể là post hoặc get )
                dataType:"text", // dữ liệu trả về dạng text ( có thể là json, xml, script hoặc text )
                // data : { // Danh sách các thuộc tính sẽ gửi đi
                //     number : $('#number').val()
                // },
                success : function (result){
                    // Sau khi gửi và kết quả trả về thành công thì gán nội dung trả về
                    // đó vào thẻ div có id = result
                    $('#result').html(result);
                }
            });
        }
    </script>
</head>
<body>
<div id="result">
    Nội dung ajax sẽ được load ở đây
</div>
<br/>
<input type="text" value="" id="number"/>
<input type="button" name="clickme" id="clickme" onclick="load_ajax();" value="Click Me"/>
</body>
</html>
