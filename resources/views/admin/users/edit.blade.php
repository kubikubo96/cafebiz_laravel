<!-- /.col-lg-12 -->
<div class="col-md-12">
    <form action="admin/users/edit/{{$user->id}}" id="editUser" name="editUser" method="POST"
        style="padding: 10px 100px 0 20px;">
        @csrf
        <input type="hidden" name="id" value="{{$user->id}}" />
        <div class="form-group">
            <label style="font-weight: bold;">Name</label>
            <input class="form-control" name="name" value="{{$user->name}}" />
        </div>
        <div class="form-group">
            <label style="font-weight: bold;">Email</label>
            <input class="form-control" type="email" name="email" disabled value="{{$user->email}}" />
        </div>
        <div class="form-group">
            <input type="checkbox" name="changePassword" id="changePassword" onchange="checkBoxChangePass(this)" />
            <label style="font-weight: bold;">Password</label>
            <input type="password" class="form-control password" name="password" disabled />
        </div>
        <div class="form-group">
            <label style="font-weight: bold;">Confirm_password</label>
            <input type="password" class="form-control confirm_password" name="confirm_password" disabled />
        </div>
        <div style="margin-top: 20px;">
            <p class="error_user text-danger hidden"></p>
        </div>
    </form>
</div>