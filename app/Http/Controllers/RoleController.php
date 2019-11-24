<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Permission\PermissionRepository;

class RoleController extends Controller
{
    //
    function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->PermissionRepository = $permissionRepository;

        $permissionForRole = $this->PermissionRepository->getAll();

        view()->share('permissionForRole', $permissionForRole);
    }

    public function getAll()
    {
        $this->authorize('root');

        $roles = $this->roleRepository->getAll();

        return view('admin.roles.index', compact('roles'));
    }

    public function openEditModalRole(Request $request)
    {
        $role = $this->roleRepository->openEditModal_role($request);
        $id_permissions = collect($role->permissions)->pluck('id')->toArray();

        return view('admin.roles.edit', compact('role', 'id_permissions'));
    }

    public function postEdit(Request $request)
    {
        $role = $this->roleRepository->find($request->id);

        //xóa tất cả permission_id thuộc $role trong bảng permission_roles
        $role->permissions()->detach();

        //thêm tất cả permission_id = $request->my_multi_select1 thuộc $role vào bảng permission
        $role->permissions()->attach($request->my_multi_select1);

        $roles = $this->roleRepository->getAll();

        return view('admin.roles.row_role', compact('roles'));
    }

    public function postAdd(Request $request)
    {
        if (empty($request->title)) {
            return ['status' => 1, 'message' => 'Add role thất bại !!'];
        }

        $role = $this->roleRepository->addRole($request);

        //lấy mảng id permission được truyền lên Request
        $arr_permission_ids = isset($request->my_multi_select1) ? $request->my_multi_select1 : array();

        //thêm tất cả permission_id = $request->my_multi_select1 thuộc $role vào bảng permission
        $role->permissions()->attach($arr_permission_ids);

        $roles = $this->roleRepository->getAll();

        return view('admin.roles.row_role', compact('roles'));
    }


    public function postDelete(Request $request)
    {
        $role = $this->roleRepository->find($request->id);
        $role->delete();

        $roles = $this->roleRepository->getAll();
        return view('admin.roles.row_role', compact('roles'));
    }
}
