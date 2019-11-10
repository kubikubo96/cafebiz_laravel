<tr id="permission_id_{{$permission->id}}">
    <td>
        {{$permission->title}}
    </td>
    <td>
        {{$permission->name}}
    </td>
    <td><a href="javascript:void(0);" onclick="openModalEditPermission({{$permission->id}})">Edit</a></td>
    <td><a onclick="deletePermission({{ $permission->id }})" href="javascript:void(0);" style="color:#FE2E2E;"> Delete</a></td>
</tr>