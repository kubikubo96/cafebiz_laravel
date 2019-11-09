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
                <li class="breadcrumb-item active">Permission</li>
            </ol>
            <div class="col-md-12">
                <button type="button" style="color:white;background-color: #169ad6; border: none; margin-bottom: 10px;"
                        data-toggle="modal" data-target="#modalAddPermission">Add permission
                </button>
                @include('admin/permissions/add')
            </div>
            <!-- DataTables Example -->
            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dataTablePermission" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>name</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>name</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </tfoot>
                            <tbody id="posts_result">
                            @foreach($permssions as $permission)
                                @include('admin.permissions.row_permission',[
                                    '$permission' => $permission
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
    @include('admin.permissions.modal')
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
        function createPermission() {
            var data = {
                name: $('#name').val(),
            }
            $.ajax({
                url: "{{route('admin.permissions.add')}}",
                type: "post",
                dateType: "text",
                data: data,
                success: function (result) {
                    if (result.status) {
                        $('.error_user').removeClass('hidden');
                        $('.error_user').text(result.message);
                    } else {
                        $('.error_user').removeClass('hidden');
                        $(".dataTablePermission").append(result);
                        $('#modalAddPermission').modal('hide');
                        alert('Add permission thành công !');
                    }
                }
            });
        }

        //open modal edit
        function openModalEditPermission(id) {
            $.ajax({
                url: "{{route('admin.permissions.edit_modal_permission')}}",
                type: "POST",
                data: {id: id},
                success: function (result) {
                    $('#modalEditPermission').modal('show');
                    $('#modalEditPermissionContent').html(result);
                }
            });
        }

        function editPermissionInModal() {
            var form_permission = $("#editPermission");
            var id = form_permission.find('input[name="id"]').val();
            var data = {
                id: id,
                name: form_permission.find('input[name="name"]').val(),
            }
            $.ajax({
                url: "{{route('admin.permissions.edit')}}",
                type: "post",
                dateType: "text",
                data: data,
                success: function (result) {
                    if (result.status) {
                        $('.error_user').removeClass('hidden');
                        $('.error_user').text(result.message);
                    } else {
                        $('.error_user').addClass('hidden');
                        $('#permission_id_' + id).replaceWith(result);
                        alert("Edit thành công !!!");
                        $('#modalEditPermission').modal('hide');
                    }
                }
            });
        }

        function deletePermission(id) {
            confirmDeletePermission = confirm("Bạn có chắc muốn xóa không")
            if (!confirmDeletePermission) {
                return false;
            }
            $.ajax({
                url: "{{route('admin.permissions.delete')}}",
                type: "POST",
                data: {id: id},
                success: function () {
                    $("#permission_id_" + id).remove();
                    alert("Bạn đã xóa thành công !");
                }
            });
        }

    </script>
@endsection