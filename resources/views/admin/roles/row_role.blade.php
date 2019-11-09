<tr id="role_id_{{$role->id}}">
    <td>
        {{$role->title}}
    </td>
    <td><a href="javascript:void(0);" onclick="openModalEditRole({{$role->id}})">Edit</a></td>
    <td><a onclick="deleteRole({{ $role->id }})" href="javascript:void(0);" style="color:#FE2E2E;"> Delete</a></td>
</tr>