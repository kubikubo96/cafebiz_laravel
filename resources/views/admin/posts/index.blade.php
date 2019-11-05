@extends('admin.layouts.master')

@section('content')
    <!-- content-wapper -->
    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="admin/posts">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Posts</li>
            </ol>
            <div class="col-md-12">
                <button type="button"
                        style="color:white;background-color: #169ad6; border: none; margin-bottom: 10px;"
                        data-toggle="modal" id="add_post" data-target=".add_post">Add Post
                </button>
                @include('admin/posts/add')
            </div>
            <!-- DataTables Example -->
            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Title_link</th>
                                <th>Content_post</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Title</th>
                                <th>Title_link</th>
                                <th>Content_post</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </tfoot>
                            <tbody id="posts_result">
                            @foreach($post as $pt)
                                @include('admin.posts.row_post',[
                                    'pt' => $pt,
                                ])
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- DataTables Example -->
        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright © BossVn 2019</span>
                </div>
            </div>
        </footer>
    </div>
    <!-- end_content-wrapper -->
    @include('admin.posts.modal')
@endsection

@section('script')
    <script language="javascript">

        // $.ajaxSetup : setup ms dùng đc ajax gửi dữ liệu trong laravel
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {
            //save posts khi click Save Change
            $('#saveChangePost').click(function () {
                // phải có để lấy update của CKEDITOR
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
                /*
                * sử dụng form data ms update được file
                * */
                var formData = new FormData();
                formData.append('title', $('#title').val());
                formData.append('title_link', $('#title_link').val());
                formData.append('content_post', $('#content_post').val());
                formData.append('image', $('input[type=file]')[0].files[0]);
                $.ajax({
                    url: "{{ route('post.add') }}",
                    type: "POST",
                    dateType: "json",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (result) {
                        $("#dataTable").append(result);
                        alert("Ajax Add thành công !!!");
                    }
                });
                //ẩn modal khi thêm thành công
                $('.add_post').modal('hide');
            });

        });

        function deletePost(id) {
            confirmDeletePost = confirm("Bạn có chắc muốn xóa không")
            if(!confirmDeletePost){
                return false;
            }
            $.ajax({
                url : "{{route('admin.posts.delete')}}",
                type : "POST",
                data : {id:id},
                success : function (){
                    $("#user_id_" + id).remove();
                    alert("Bạn đã xóa thành công !");
                }
            });
        }

        //open modal edit
        function openModalEdit(id) {
            $.ajax({
                url : "{{route('admin.posts.open_edit_modal')}}",
                type : "POST",
                data : {id:id},
                success : function (result){
                    $('#editPostModal').modal('show');
                    $('#modalEditContent').html(result);
                }
            });
        }

        function editPostInModal(){
            // phải có để lấy update của CKEDITOR
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            /*
            * sử dụng form data ms update được file
            * */
            var form = $("#editPost");
            var formData = new FormData();
            var id, title, title_link, content_post, image;
            id = $(form).find('input[name="id"]').val();
            title = $("#editPost").find('input[name="title"]').val();
            title_link = $("#editPost").find('input[name="title_link"]').val();
            content_post = $("#editPost").find('textarea[name="content_post"]').val();

            formData.append('id',id);
            formData.append('title', title);
            formData.append('title_link', title_link);
            formData.append('content_post', content_post);
            formData.append('image',  $("#editPost").find('input[type=file]')[0].files[0]);
            $.ajax({
                url : "{{route('admin.posts.edit')}}",
                type: "POST",
                dateType: "json",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success : function (result) {
                    $('#user_id_'+ id).replaceWith(result);
                    alert("Edit thành công !!!");
                    $('#editPostModal').modal('hide');
                }
            });
        }


    </script>
@endsection


