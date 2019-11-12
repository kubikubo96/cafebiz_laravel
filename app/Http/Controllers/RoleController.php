<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use Illuminate\Http\Request;
use App\Permission_Roles;

class RoleController extends Controller
{
    //
    function __construct()
    {
        $permissionForRole = Permission::all();
        view()->share('permissionForRole', $permissionForRole);
    }

    public function getAll()
    {
        $this->authorize('root');

        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function postAdd(Request $request)
    {
        if (empty($request->title)) {
            return ['status' => 1, 'message' => 'Add role thất bại !!'];
        }
        $role = new Role;
        $role->title = $request->title;
        $role->save();

        //lấy mảng id permission được truyền lên Request
        $arr_permission_ids = isset($request->my_multi_select1) ? $request->my_multi_select1 : array();

        foreach ($arr_permission_ids as $id) {
            $permissionRole = new Permission_Roles;

            $permissionRole->permission_id = $id;

            $permissionRole->role_id = $role->id;

            $permissionRole->save();

        }

        return view('admin.roles.row_role', [
            'role' => $role,
        ]);
    }

    public function openEditModalRole(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $role = Role::find($id);
        return view('admin.roles.edit', compact('role'));
    }

    public function postEdit(Request $request)
    {
        if (empty($request->title)) {
            return ['status' => 1, 'message' => 'roleTitle không được để trống !'];
        }
        $role = Role::find($request->id);
        $role->title = $request->title;

        $role->save();

        return view('admin.roles.row_role', compact('role'));
    }


    public function postDelete(Request $request)
    {
        $user = Role::find($request->id);
        $user->delete();

        return redirect('admin/roles');
    }
}
