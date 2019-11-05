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
                <button type="button" style="color:white;background-color: #169ad6; border: none; margin-bottom: 10px;" data-toggle="modal" data-target="#add_user">Add user</button>
                @include('admin/users/add')
            </div>

            <!-- DataTables Example -->
            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Admin</th>
                                <th>Created_at</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Admin</th>
                                <th>Created_at</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($user as $u)
                            <tr>
                                <td>{{$u->name}}</td>
                                <td>{{$u->email}}</td>
                                <td>@if($u->admin == 0)
                                        No
                                    @else
                                        Yes
                                    @endif</td>
                                <td>{{$u->created_at}}</td>
                                <td><a href="admin/users/edit/{{$u->id}}">Edit</a></td>
                                <td><a onclick='return confirm_delete()' href="admin/users/delete/{{$u->id}}"> Delete</a></td>
                            </tr>
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
@endsection

@section('script')
    <script>
        function confirm_delete() {
            del = confirm("Bạn có chắc muốn xóa hay không?");
            return del;
        }
    </script>
@endsection
