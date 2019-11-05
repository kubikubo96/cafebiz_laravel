<!-- Modal -->
<div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
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
                            <h1 class="page-header" style="margin: 0;">Users
                                <small>Add</small>
                            </h1>
                        </div>
                        <br/>
                        <div class="col-lg-12" style="font-size: 16px;">
                            {{--                            meta name="csrf-token"...  => phải có mới dùng đc ajax--}}
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <div class="form-group" style="">
                                <label>Name</label>
                                <input class="form-control" name="name" id="name" placeholder="Nhập họ và tên"/>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                       placeholder="Nhập email"/>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" id="password"
                                       placeholder="Nhập password"/>
                            </div>
                            <div class="form-group">
                                <label>confirm_password</label>
                                <input type="password" class="form-control" name="confirm_password"
                                       id="confirm_password"
                                       placeholder="Nhập lại password"/>
                            </div>
                            <div class="form-group">
                                <label>Quyền người dùng</label>
                                <label class="radio-inline">
                                    <input name="admin" class="admin" value="0" checked type="radio">Thường
                                </label>
                                <label class="radio-inline">
                                    <input name="admin" class="admin" value="1" type="radio">Admin
                                </label>
                            </div>
                            <div style="margin-top: 20px;">
                                <p class="error_user text-danger hidden"></p>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="reset" id="add_user" onclick="load_add_user();" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@section('script')
    <script>
        function load_add_user(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var data = {
                name: $('#name').val(),
                email: $('#email').val(),
                password: $('#password').val(),
                confirm_password: $('#confirm_password').val(),
                admin: $('.admin:checked').val()
            }
            $.ajax({
                url: "admin/users/add",
                type: "post",
                dateType: "text",
                data: data,
                success: function (result) {
                    if (result.status == 0) {
                        $('.error_user').removeClass('hidden');
                        $('.error_user').text(result.message);
                    } else {
                        $('.error_user').removeClass('hidden');
                        $('.error_user').removeClass('text-danger');
                        $('.error_user').addClass(' text-success');
                        $('.error_user').text(result);
                    }
                }
            });
        }
    </script>
@endsection
