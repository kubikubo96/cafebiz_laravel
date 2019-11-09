@extends('admin.layouts.master')

@section('content')

    <!-- content-wapper -->
    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="admin/roles">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Roles</li>
            </ol>
            <div class="col-md-12">
                <button type="button" style="color:white;background-color: #169ad6; border: none; margin-bottom: 10px;"
                        data-toggle="modal" data-target="#modalAddRole">Add role
                </button>
                @include('admin/roles/add')
            </div>
            <!-- DataTables Example -->
            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dataTableRole" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Roles</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Roles</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </tfoot>
                            <tbody id="posts_result">
                            @foreach($roles as $role)
                                @include('admin.roles.row_role',[
                                    'role' => $role
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
    @include('admin.roles.modal')
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
        function createRole() {
            var data = {
                title: $('#title').val(),
            }
            $.ajax({
                url: "{{route('admin.roles.add')}}",
                type: "post",
                dateType: "text",
                data: data,
                success: function (result) {
                    if (result.status) {
                        $('.error_user').removeClass('hidden');
                        $('.error_user').text(result.message);
                    } else {
                        $('.error_user').removeClass('hidden');
                        $(".dataTableRole").append(result);
                        $('#modalAddRole').modal('hide');
                        alert('Add role thành công !');
                    }
                }
            });
        }

        //open modal edit
        function openModalEditRole(id) {
            $.ajax({
                url: "{{route('admin.roles.edit_modal_role')}}",
                type: "POST",
                data: {id: id},
                success: function (result) {
                    $('#modalEditRole').modal('show');
                    $('#modalEditRoleContent').html(result);
                }
            });
        }

        function editRoleInModal() {
            var form_role = $("#editRole");
            var id = form_role.find('input[title="id"]').val();
            var data = {
                id: id,
                title: form_role.find('input[title="title"]').val(),
            }
            $.ajax({
                url: "{{route('admin.roles.edit')}}",
                type: "post",
                dateType: "text",
                data: data,
                success: function (result) {
                    if (result.status) {
                        $('.error_user').removeClass('hidden');
                        $('.error_user').text(result.message);
                    } else {
                        $('.error_user').addClass('hidden');
                        $('#role_id_' + id).replaceWith(result);
                        alert("Edit thành công !!!");
                        $('#modalEditRole').modal('hide');
                    }
                }
            });
        }

        function deleteRole(id) {
            confirmDeleteRole = confirm("Bạn có chắc muốn xóa không")
            if (!confirmDeleteRole) {
                return false;
            }
            $.ajax({
                url: "{{route('admin.roles.delete')}}",
                type: "POST",
                data: {id: id},
                success: function () {
                    $("#role_id_" + id).remove();
                    alert("Bạn đã xóa thành công !");
                }
            });
        }

    </script>
@endsection