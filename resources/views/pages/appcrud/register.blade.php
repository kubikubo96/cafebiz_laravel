@extends('layouts.master')

@section('content')
<!-- page_content -->
<div class="content">
    <div class="container" style="">
        <div class="row">
            <div class="col-md-9 c1">
                <div class="panel panel-default" style="border: 1px solid #dddddd; border-radius: 0px 0px 10px 10px; ">
                    <div class="panel-heading" style="font-weight: bold;padding: 10px; background-color: #a4a4a4; ">Đăng
                        ký tài khoản</div>
                    <div class="panel-body" style="padding: 15px;">
                        @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                            {{$err}}<br>
                            @endforeach
                        </div>
                        @endif
                        @if(session('notify'))
                        <div class="alert alert-success">
                            {{session('notify')}}
                        </div>
                        @endif
                        <form action="register" method="post">
                            @csrf
                            <div>
                                <label>Họ tên</label>
                                <input type="text" class="form-control" name="name" placeholder="Họ tên"
                                    aria-describedby="basic-addon1">
                            </div>
                            <br>
                            <div>
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email"
                                    aria-describedby="basic-addon1">
                            </div>
                            <br>
                            <div>
                                <label>Nhập mật khẩu</label>
                                <input type="password" class="form-control password" name="password"
                                    aria-describedby="basic-addon1">
                            </div>
                            <br>
                            <div>
                                <label>Nhập lại mật khẩu</label>
                                <input type="password" class="form-control confirm_password" name="confirm_password"
                                    aria-describedby="basic-addon1">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-dark">Register</button>
                            </button>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3 cc" style="text-align: center;">
                <img class="c9" src="images/qc3.JPG" width="80%" />
                <img class="c9" src="images/qc1.JPG" width="80%" />
                <img class="c9" src="images/qc2.JPG" width="80%" />
            </div>
        </div>
    </div>
</div>
<!-- end_page_content -->
@endsection('content')