<div class="portlet-body">
    <table class="table table-striped table-bordered table-hover dataTableRole" id="sample_2">
        <thead>
            <tr>
                <th>Roles</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody id="posts_result">
            @foreach($roles as $role)
            <tr id="role_id_{{$role->id}}">
                <td>
                    {{$role->title}}
                </td>
                <td><a href="javascript:void(0);" onclick="openModalEditRole({{$role->id}})">Edit</a></td>
                <td><a onclick="deleteRole({{ $role->id }})" href="javascript:void(0);" style="color:#FE2E2E;">
                        Delete</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>