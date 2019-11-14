<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use Illuminate\Http\Request;
use App\Permission_Roles;
use Illuminate\Support\Facades\DB;
use App\Repositories\Role\RoleRepository;

class RoleController extends Controller
{
    //
    function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;

        $permissionForRole = Permission::all();
        view()->share('permissionForRole', $permissionForRole);
    }

    public function getAll()
    {
        $this->authorize('root');

        $roles = $this->roleRepository->getAll();

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

        $roles = $this->roleRepository->getAll();

        return view('admin.roles.row_role', compact('roles'));
    }

    public function openEditModalRole(Request $request)
    {
        $role = $this->roleRepository->openEditModal_role($request);

        $id_permissions = array();

        $i = 0;
        foreach ($role->permissions as $permissions) {
            $id_permissions[$i] = $permissions->id;
            $i++;
        }
        return view('admin.roles.edit', compact('role', 'id_permissions'));
    }

    public function postEdit(Request $request)
    {
        $role = $this->roleRepository->find($request->id);

        DB::table('permission_roles')->where('role_id', $role->id)->delete();

        $role->permissions()->attach($request->my_multi_select1);

        $roles = $this->roleRepository->getAll();

        return view('admin.roles.row_role', compact('roles'));
    }


    public function postDelete(Request $request)
    {
        $user = $this->roleRepository->find($request->id);
        $user->delete();

        return redirect('admin/roles');
    }
}
