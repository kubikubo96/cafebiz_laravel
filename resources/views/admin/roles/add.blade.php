<!-- Modal -->
<div class="modal fade" id="modalAddRole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <form action="{{ route('admin.roles.add') }}" method="POST" id="formCreateRole">
        {{--meta name="csrf-token"...  => phải có mới dùng đc ajax--}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid" style="text-align: left;">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header" style="margin: 0; border: 0px;">Roles
                                    <small>Add</small>
                                </h1>
                            </div>
                            <br />
                            <div class="col-lg-12" style="font-size: 16px;">
                                <div class="form-group" style="">
                                    <label>Title</label>
                                    <input class="form-control" name="title" id="title" placeholder="Nhập role" />
                                </div>
                                <div class="row">
                                    <div class="col-md-12" style="padding: 0;">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Permission</label>
                                            <div class="col-md-9">
                                                <select multiple="multiple" class="multi-select" id="my_multi_select1"
                                                    name="my_multi_select1[]">
                                                    @foreach($permissionForRole as $permission)
                                                    <option value="{{ @$permission->id }}">{{$permission->name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="margin-top: 20px;">
                                    <p class="error_role text-danger hidden"></p>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <div class="modal-footer">
                    <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>