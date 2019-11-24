<!-- Modal -->
<div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: 0px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid" style="text-align: left;">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header" style="margin: 0;">Users
                                <small>Add</small>
                            </h1>
                        </div>
                        <br />
                        <div class="col-lg-12" style="font-size: 16px;">
                            {{--meta name="csrf-token"...  => phải có mới dùng đc ajax--}}
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <div class="form-group" style="">
                                <label>Name</label>
                                <input class="form-control" name="name" id="name" placeholder="Nhập họ và tên" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Nhập email" />
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="Nhập password" />
                            </div>
                            <div class="form-group">
                                <label>confirm_password</label>
                                <input type="password" class="form-control" name="confirm_password"
                                    id="confirm_password" placeholder="Nhập lại password" />
                            </div>
                            <div class="form-group">
                                <input name="admin" class="admin" value="1" type="hidden">
                            </div>
                            <div class="form-group" id="roles_admin">
                                <label style="font-weight: bold;">Roles</label>
                                <select class="form-control" name="roles" id="roles">
                                    @foreach($rolesForAddUser as $role)
                                    <option name="role_id" value="{{$role->id}}">{{$role->title}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="alert alert-danger print-error-add-user" style="display:none">
                                <ul></ul>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="showtoast" onclick="createUser();" class="btn btn-primary">Save
                    changes</button>
            </div>
        </div>
    </div>
</div>