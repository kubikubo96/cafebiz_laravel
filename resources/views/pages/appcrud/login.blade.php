@extends('layouts.master')

@section('content')
<!-- page_content -->
<div class="content">
    <div class="container" style="">
        <div class="row">
            <div class="col-md-9 c1" style="padding: 0 200px;">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading" style="margin-top: 30px;margin-bottom: 30px; text-align: center;">
                        <h3 class="panel-title">Please Login</h3>
                    </div>
                    <div class="panel-body">
                        @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                            {{$err}}<br>
                            @endforeach
                        </div>
                        @endif
                        @if(session('notify'))
                        <div class="alert alert-danger">
                            {{session('notify')}}
                        </div>
                        @endif
                        @if(session('notifySuccess'))
                        <div class="alert alert-success">
                            {{session('notifySuccess')}}
                        </div>
                        @endif
                        <form role="form" action="" method="POST">
                            @csrf
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email"
                                        autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password"
                                        value="">
                                </div>
                                <button type="submit" class="btn btn-lg btn-dark btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                    <div style="text-align: center;">
                        <a style="color: #000000;" class="d-block small mt-3" href="register">Register
                            an Account</a>
                        <a style="color: #000000;" class="d-block small" href="forgot_password">Forgot
                            Password?</a>
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
</div>
<!-- end_page_content -->
@endsection('content')