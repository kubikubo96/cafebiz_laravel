@extends('admin.layouts.master')

@section('content')
    <!-- content-wapper -->
    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="admin/users">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Users</li>
            </ol>
            <div class="col-md-12">
                <!-- Large modal -->
                <button type="button" style="color:white;background-color: #169ad6; border: none; margin-bottom: 10px;"
                        data-toggle="modal" data-target="#add_user">Add user
                </button>
                @include('admin/users/add')
            </div>

            <!-- DataTables Example -->
            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dataTableUser" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created_at</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created_at</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($user as $u)
                                @include('admin.users.row_user',[
                                        'u' => $u,
                                    ])
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
                // role_id : $('.role_id').val(),
                // role_id : $("#roles").find('option[name="role_id"]').val(),
                role_id : $('#roles').find('option:selected').val(),
                email: $('#email').val(),
                password: $('#password').val(),
                confirm_password: $('#confirm_password').val(),
                admin: $('.admin:checked').val()
            }
            $.ajax({
                url: "{{route('user.add')}}",
                type: "post",
                dateType: "text",
                data: data,
                success: function (result) {
                    if (result.status) {
                        $('.error_user').removeClass('hidden');
                        $('.error_user').text(result.message);
                    } else {
                        $('.error_user').removeClass('hidden');
                        $(".dataTableUser").append(result);
                        $('#add_user').modal('hide');
                        alert('Add user thành công !');
                    }
                }
            });
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
            }
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
                        $('#user_id_' + id).replaceWith(result);
                        alert("Edit thành công !!!");
                        $('#editUserModal').modal('hide');
                    }
                }
            });

        }

        function deleteUser(id) {
            confirmDeleteUser = confirm("Bạn có chắc muốn xóa không")
            if (!confirmDeleteUser) {
                return false;
            }
            $.ajax({
                url: "{{route('admin.users.delete')}}",
                type: "POST",
                data: {id: id},
                success: function () {
                    $("#user_id_" + id).remove();
                    alert("Bạn đã xóa thành công !");
                }
            });
        }

    </script>
@endsection