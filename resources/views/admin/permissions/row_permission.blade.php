<div class="portlet-body">
    <table class="table table-striped table-bordered table-hover dataTablePermission" id="sample_2">
        <thead>
            <tr>
                <th>Title</th>
                <th>Name</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody id="posts_result">
            @foreach($permissions as $permission)

            <tr id="permission_id_{{$permission->id}}">
                <td>
                    {{$permission->title}}
                </td>
                <td>
                    {{$permission->name}}
                </td>
                <td><a href="javascript:void(0);" onclick="openModalEditPermission({{$permission->id}})">Edit</a></td>
                <td><a onclick="deletePermission({{ $permission->id }})" href="javascript:void(0);"
                        style="color:#FE2E2E;"> Delete</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>