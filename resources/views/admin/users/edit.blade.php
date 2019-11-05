@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="" style="padding-bottom: 15px; border-bottom: 1px dotted #333333;">User
                    <small>Edit</small>
                </h2>
            </div>
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
        <!-- /.col-lg-12 -->
            <div class="col-md-12">
                <form action="admin/users/edit/{{$user->id}}" method="POST" style="padding: 10px 100px 0 20px;">
                    @csrf
                    <div class="form-group">
                        <label style="font-weight: bold;">Name</label>
                        <input class="form-control" name="name" value="{{$user->name}}"/>
                    </div>
                    <div class="form-group">
                        <label style="font-weight: bold;">Email</label>
                        <input class="form-control" type="email" name="email" disabled value="{{$user->email}}"/>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="changePassword" id="changePassword">
                        <label style="font-weight: bold;">Password</label>
                        <input type="password" class="form-control password" name="password" disabled/>
                    </div>
                    <div class="form-group">
                        <label style="font-weight: bold;">Confirm_password</label>
                        <input type="password" class="form-control confirm_password" name="confirm_password" disabled/>
                    </div>
                    <button type="submit" class="alert alert-info" style="padding: 10px;background-color: #383d41;border-radius: 10px;color:white;">Edit user</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $("#changePassword").change(function () {
                if($(this).is(":checked")){
                    $(".password").removeAttr('disabled');
                    $(".confirm_password").removeAttr('disabled');
                }else{
                    $(".password").attr('disabled','');
                    $(".confirm_password").attr('disabled','');
                }
            })
        })
    </script>
@endsection
