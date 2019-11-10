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
                    <span>Posts</span>
                </li>
            </ul>
            <div class="page-toolbar">
                <div class="btn-group pull-right">
                    <button type="button" class="btn green btn-sm btn-outline dropdown-toggle"
                            data-toggle="modal" data-target="#modalAddPermission"> Add Permission
                    </button>
                    @include('admin/permissions/add')
                </div>
            </div>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Permissions Datatable
            <small>permissions</small>
        </h1>
        <!-- END PAGE TITLE-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe"></i>Permissions
                        </div>
                        <div class="tools"></div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover dataTablePermission" id="sample_2">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Name</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
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
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
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
                title: $('#title').val(),
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
                title: form_permission.find('input[name="title"]').val(),
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