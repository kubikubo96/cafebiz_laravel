<tr id="user_id_{{$u->id}}">
    <td>{{$u->name}}</td>
    <td>{{$u->email}}</td>
    {{--<td>@if($u->admin == 0)--}}
            {{--No--}}
        {{--@else--}}
            {{--Yes--}}
        {{--@endif</td>--}}
    <td>{{$u->created_at}}</td>
    <td><a href="javascript:void(0);" onclick="openModalEditUser({{$u->id}})">Edit</a></td>
    <td><a onclick="deleteUser({{ $u->id }})" href="javascript:void(0);" style="color:#FE2E2E;"> Delete</a></td>
</tr>