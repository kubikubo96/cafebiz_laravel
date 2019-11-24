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
                    @include('admin.comments.row_comment',[
                    'comment' => $comment
                    ])
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