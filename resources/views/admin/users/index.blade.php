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
                <span>Users</span>
            </li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <button type="button" class="btn green btn-sm btn-outline" data-toggle="modal" data-target="#add_user">
                    Add User
                </button>
                @include('admin/users/add')
            </div>
        </div>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title"> Users Datatable
        <small>data of users</small>
    </h1>
    <!-- END PAGE TITLE-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-globe"></i>Users
                    </div>
                    <div class="tools"></div>
                </div>

                @include('admin.users.row_user',['user' => $user])

            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
</div>
<!-- END CONTENT BODY -->
{{--include modal users--}}
@include('admin.users.modal')

@endsection

@section('script')
<script>
    //$.ajaxSetup phải có mới gửi ajax đc trong laravel
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //ajax create user
        function createUser() {
            var data = {
                name: $('#name').val(),
                role_id: $('#roles').find('option:selected').val(),
                email: $('#email').val(),
                password: $('#password').val(),
                confirm_password: $('#confirm_password').val(),
                admin: $('.admin').val()
            }
            $.ajax({
                url: "{{route('user.add')}}",
                type: "post",
                dateType: "text",
                data: data,
                success: function (result) {
                    if (result.error) {
                        printErrorAddUser(result.error);
                    } else {
                        $(".portlet-body").html(result);
                        //init dataTable
                        $('#sample_2').dataTable();
                        $('#add_user').modal('hide');
                        toastr.success('Add user thành công !')
                    }
                }
            });

            function printErrorAddUser(e) {
                $(".print-error-add-user").find("ul").html('');
                $(".print-error-add-user").css('display', 'block');
                // each function được sử dụng để lặp qua từng phần tử của jQuery object
                // key là số thứ tự duyệt bắt đầu từ 0
                //value là giá trị
                $.each(e, function (key, value) {
                    $(".print-error-add-user").find("ul").append('<li>' + value + '</li>');
                });
            }
        }

        //open modal edit
        function openModalEditUser(id) {
            $.ajax({
                url: "{{route('admin.users.edit_modal_user')}}",
                type: "POST",
                data: {id: id},
                success: function (result) {
                    $('#editUserModal').modal('show');
                    $('#modalEditUserContent').html(result);
                }
            });
        }

        //checkbox change password
        function checkBoxChangePass(self) {
            var isChecked;
            //prop : lấy thuộc tính, hoặc gán thuộc tính
            isChecked = $(self).prop('checked');
            if (isChecked == true) {
                $(".password").removeAttr('disabled');
                $(".confirm_password").removeAttr('disabled');
            } else {
                $(".password").attr('disabled', '');
                $(".confirm_password").attr('disabled', '');
            }
        }


        function editUserInModal() {
            var form_user = $("#editUser");
            var id = form_user.find('input[name="id"]').val();
            var data = {
                id: id,
                name: form_user.find('input[name="name"]').val(),
                email: $(form_user).find('input[name="email"]').val(),
                password: $(form_user).find('input[name="password"]').val(),
                confirm_password: $(form_user).find('input[name="confirm_password"]').val(),
                changePassword: $(form_user).find('input[name="changePassword"]').val(),
            };
            $.ajax({
                url: "{{route('admin.users.edit')}}",
                type: "post",
                dateType: "text",
                data: data,
                success: function (result) {
                    if (result.status) {
                        $('.error_user').removeClass('hidden');
                        $('.error_user').text(result.message);
                    } else {
                        $('.error_user').addClass('hidden');
                        $(".portlet-body").html(result);
                        //init dataTable
                        $('#sample_2').dataTable();
                        toastr.success('Edit thành công !!!');
                        $('#editUserModal').modal('hide');
                    }
                }
            });

        }

        function deleteUser(id) {
            confirmDeleteUser = confirm("Bạn có chắc muốn xóa không");
            if (!confirmDeleteUser) {
                return false;
            }
            $.ajax({
                url: "{{route('admin.users.delete')}}",
                type: "POST",
                data: {id: id},
                success: function (result) {
                    // $("#user_id_" + id).remove();
                    $(".portlet-body").html(result);
                    //init dataTable
                    $('#sample_2').dataTable();
                    toastr.success('Bạn đã xóa thành công !!!');

                }
            });
        }

</script>
@endsection