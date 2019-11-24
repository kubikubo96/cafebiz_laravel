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
                <span>Roles</span>
            </li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="modal"
                    data-target="#modalAddRole"> Add Role
                </button>
                @include('admin/roles/add')
            </div>
        </div>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title"> Roles Datatable
        <small>roles</small>
    </h1>
    <!-- END PAGE TITLE-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-globe"></i>Roles
                    </div>
                    <div class="tools"></div>
                </div>
                @include('admin.roles.row_role',[
                'roles' => $roles
                ])
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
</div>
<!-- END CONTENT BODY -->
@include('admin.roles.modal')

@endsection

@section('script')

<script>
    $(document).ready(function () {
            $("#select_permission").select2();
        });

        //$.ajaxSetup phải có mới gửi ajax đc trong laravel
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#formCreateRole").submit(function (ad) {
            //preventDefault :ngăn submit và chuyển trang trong form
            ad.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: "post",
                dateType: "text",
                data: $(this).serialize(),
                success: function (result) {
                    if (result.status) {
                        $('.error_role').removeClass('hidden');
                        $('.error_role').text(result.message);
                    } else {
                        $('.error_role').removeClass('hidden');
                        $(".portlet-body").html(result);
                        //init dataTable
                        $('#sample_2').dataTable();
                        $('#modalAddRole').modal('hide');
                        toastr.success('Add role thành công !!!');
                    }
                }
            });
            return false;
        });

        //open modal edit
        function openModalEditRole(id) {
            $.ajax({
                url: "{{route('admin.roles.edit_modal_role')}}",
                type: "POST",
                data: {id: id},
                success: function (result) {
                    $('#modalEditRole').modal('show');
                    $('#modalEditRoleContent').html(result);
                    $(".multi-select").multiSelect();
                }
            });
        }

        //edit role
        $("#editRole").submit(function (e) {
            //preventDefault :ngăn submit và chuyển trang trong form
            e.preventDefault();

            id = $("#editRole").find('input[name="id"]').val();

            $.ajax({
                url: $(this).attr('action'),
                type: "post",
                dateType: "text",
                data: $(this).serialize(),
                success: function (result) {
                    $(".portlet-body").html(result);
                    //init dataTable
                    $('#sample_2').dataTable();
                    toastr.success('Edit thành công !!!');
                    $('#modalEditRole').modal('hide');
                }
            });

        });

        function deleteRole(id) {
            confirmDeleteRole = confirm("Bạn có chắc muốn xóa không");
            if (!confirmDeleteRole) {
                return false;
            }

            $.ajax({
                url: "{{route('admin.roles.delete')}}",
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

@section('css')
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="admin_asset/global/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
<link href="admin_asset/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />
<link href="admin_asset/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="admin_asset/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
@endsection