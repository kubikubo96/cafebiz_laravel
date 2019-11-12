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
                    <span>Roles</span>
                </li>
            </ul>
            <div class="page-toolbar">
                <div class="btn-group pull-right">
                    <button type="button" class="btn green btn-sm btn-outline dropdown-toggle"
                            data-toggle="modal" data-target="#modalAddRole"> Add Role
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
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover dataTableRole" id="sample_2">
                            <thead>
                            <tr>
                                <th>Roles</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
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

        //ajax create user
        {{--function createRole() {--}}
            {{--var form =--}}
                {{--$.ajax({--}}
                    {{--url: "{{route('admin.roles.add')}}",--}}
                    {{--type: "post",--}}
                    {{--dateType: "text",--}}
                    {{--data: $(form).serialize(),--}}
                    {{--success: function (result) {--}}
                        {{--if (result.status) {--}}
                            {{--$('.error_user').removeClass('hidden');--}}
                            {{--$('.error_user').text(result.message);--}}
                        {{--} else {--}}
                            {{--$('.error_user').removeClass('hidden');--}}
                            {{--$(".dataTableRole").append(result);--}}
                            {{--$('#modalAddRole').modal('hide');--}}
                            {{--alert('Add role thành công !');--}}
                        {{--}--}}
                    {{--}--}}
                {{--});--}}
        {{--}--}}

        $("#formCreateRole").submit(function (e) {
            //preventDefault :ngăn submit và chuyển trang trong form
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: "post",
                dateType: "text",
                data: $(this).serialize(),
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
                }
            });
        }

        function editRoleInModal() {
            var form_role = $("#editRole");
            var id = form_role.find('input[name="id"]').val();
            var data = {
                id: id,
                title: form_role.find('input[name="title"]').val(),
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