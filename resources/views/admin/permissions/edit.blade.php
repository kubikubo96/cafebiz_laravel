<!-- /.col-lg-12 -->
<div class="col-md-12">
    <form action="admin/permissions/edit/{{$permission->id}}"
          id="editPermission" name="editPermission"  method="POST" style="padding: 10px 100px 0 20px;">
        <input type="hidden" name="id" value="{{$permission->id}}"/>
        @csrf
        <div class="form-group">
            <label style="font-weight: bold;">Name</label>
            <input class="form-control" name="name" value="{{$permission->name}}"/>
        </div>
        <div style="margin-top: 20px;">
            <p class="error_user text-danger hidden"></p>
        </div>
    </form>
</div>