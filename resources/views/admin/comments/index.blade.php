@extends('admin.layouts.master')

@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->

    @include('admin.layouts.theme_panel')

        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="index.html">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Comments</span>
                </li>
            </ul>
            <div class="page-toolbar">
            </div>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Comments Datatable
            <small>comments</small>
        </h1>
        <!-- END PAGE TITLE-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe"></i>Comments
                        </div>
                        <div class="tools"></div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover dataTableComment" id="sample_2">
                            <thead>
                            <tr>
                                <th>Commenter</th>
                                <th>Title of Posts</th>
                                <th>Content Comment</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody id="comment_result">
                            @foreach($comment as $cm)
                                @include('admin.comments.row_comment',[
                                    'cm' => $cm
                                ])
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
@endsection

@section('script')
    <script>
        //$.ajaxSetup phải có mới gửi ajax đc trong laravel
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function deleteComment(id) {
            confirmDeleteComment = confirm("Bạn có chắc muốn xóa không")
            if (!confirmDeleteComment) {
                return false;
            }
            $.ajax({
                url: "{{route('admin.comments.delete')}}",
                type: "POST",
                data: {id: id},
                success: function () {
                    $("#comment_id_" + id).remove();
                    alert("Bạn đã xóa thành công !");
                }
            });
        }

    </script>
@endsection