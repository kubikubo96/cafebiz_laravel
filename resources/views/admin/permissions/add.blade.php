<!-- Modal -->
<div class="modal fade" id="modalAddPermission" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding-top: 0px;">
                <div class="container-fluid" style="text-align: left;">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header" style="margin: 0;">Permission
                                <small>Add</small>
                            </h1>
                        </div>
                        <br />
                        <div class="col-lg-12" style="font-size: 16px;">
                            {{--                            meta name="csrf-token"...  => phải có mới dùng đc ajax--}}
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <div class="form-group" style="">
                                <label>Title</label>
                                <input class="form-control" name="title" id="title"
                                    placeholder="Nhập permission title" />
                            </div>
                            <div class="form-group" style="">
                                <label>Name</label>
                                <input class="form-control" name="name" id="name" placeholder="Nhập permission" />
                            </div>
                            <div style="margin-top: 20px;">
                                <p class="error_permission text-danger hidden"></p>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="createPermission();" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>