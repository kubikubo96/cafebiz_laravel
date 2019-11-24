<!-- /.col-lg-12 -->
<div class="col-md-12" style="padding: 10px 30px 0 20px;">
    <input type="hidden" name="id" value="{{$role->id}}" />
    @csrf
    <div class="row">
        <label style="font-weight: bold;">Title</label>
        <input style="width: 100%;" class="form-control" name="title" disabled value="{{$role->title}}" />
    </div>
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-12" style="padding: 0;">
            <div class="form-group">
                <label class="control-label col-md-3" style="padding: 0;font-weight: bold;">Permission</label>
                <div class="col-md-9">
                    <select multiple="multiple" class="multi-select" id="my_multi_select1" name="my_multi_select1[]">
                        @foreach($permissionForRole as $permissionRole)
                        <option value="{{ @$permissionRole->id }}" @foreach( $id_permissions as $id_permission)
                            @if(@$permissionRole->id == $id_permission)
                            selected
                            @endif
                            @endforeach
                            >{{$permissionRole->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-top: 20px;">
        <p class="error_user text-danger hidden"></p>
    </div>
</div>