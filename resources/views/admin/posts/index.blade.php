@extends('admin.layouts.master')

@section('content')
<!-- BEGIN CONTENT BODY -->
<div class="page-content">
    <!-- BEGIN PAGE HEADER-->

    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="index.html">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Posts</span>
            </li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <button type="button" class="btn green btn-sm btn-outline" data-toggle="modal" id="add_post"
                    data-target=".add_post"> Add Posts
                </button>
                @include('admin/posts/add')
            </div>
        </div>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title"> Posts Datatable
        <small>posts of authors</small>
    </h1>
    <!-- END PAGE TITLE-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-globe"></i>Posts
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    @include('admin.posts.row_post',['post'=>$post])
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

</div>
<!-- END CONTENT BODY -->
@include('admin.posts.modal')
@endsection

@section('scriptPlugins')
@endsection

@section('script')
<script language="javascript">
    // $.ajaxSetup : setup ms dùng đc ajax gửi dữ liệu trong laravel
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //save posts khi click Save Change
        $(document).on('click', '#saveChangePost', function () {
            // phải có để lấy update của CKEDITOR
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            /*
            * sử dụng formdata ms update được file
            * */
            var formData = new FormData();
            formData.append('user_id', $('#user_id').val());
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
                    if (result.status) {
                        $('.error_post').removeClass('hidden');
                        $('.error_post').text(result.message);
                    } else {
                        $(".portlet-body").html(result);
                        //init dataTable
                        $('#sample_2').dataTable();
                        $('.error_post').addClass('hidden');
                        toastr.success('Add post thành công !!!');
                        //ẩn modal khi thêm thành công
                        $('.add_post').modal('hide');
                    }
                }
            });
        });

        //open modal edit
        function openModalEdit(id) {
            $.ajax({
                url: "{{route('admin.posts.open_edit_modal')}}",
                type: "POST",
                data: {id: id},
                success: function (result) {
                    $('#editPostModal').modal('show');
                    $('#modalEditContent').html(result);
                }
            });
        }

        function editPostInModal() {
            // phải có để lấy update của CKEDITOR
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            /*
            * sử dụng formdata ms update được file
            * */
            var formData = new FormData();
            var id, title, title_link, content_post, image;
            id = $("#editPost").find('input[name="id"]').val();
            title = $("#editPost").find('input[name="title"]').val();
            title_link = $("#editPost").find('input[name="title_link"]').val();
            content_post = $("#editPost").find('textarea[name="content_post"]').val();

            formData.append('id', id);
            formData.append('title', title);
            formData.append('title_link', title_link);
            formData.append('content_post', content_post);
            formData.append('image', $("#editPost").find('input[type=file]')[0].files[0]);
            $.ajax({
                url: "{{route('admin.posts.edit')}}",
                type: "POST",
                dateType: "json",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (result) {
                    if (result.status) {
                        $('.error_post').removeClass('hidden');
                        $('.error_post').text(result.message);
                    } else {
                        $(".portlet-body").html(result);
                        //init dataTable
                        $('#sample_2').dataTable();
                        toastr.success('Edit thành công !!!');
                        $('#editPostModal').modal('hide');
                    }
                }
            });
        }

        function deletePost(id) {
            confirmDeletePost = confirm("Bạn có chắc muốn xóa không")
            if (!confirmDeletePost) {
                return false;
            }
            $.ajax({
                url: "{{route('admin.posts.delete')}}",
                type: "POST",
                data: {id: id},
                success: function (result) {
                    $(".portlet-body").html(result);
                    //init dataTable
                    $('#sample_2').dataTable();
                    toastr.success('Bạn đã xóa thành công !!!');
                }
            });
        }


</script>
@endsection