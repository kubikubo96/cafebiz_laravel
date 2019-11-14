<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use App\Repositories\Permission\PermissionRepository;

class PermissionController extends Controller
{
    //
    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function getAll()
    {
        $this->authorize('root');

        $permissions = $this->permissionRepository->getAll();

        return view('admin.permissions.index', compact('permissions'));
    }

    public function postAdd(Request $request)
    {
        if (empty($request->name)) {
            return ['status' => 1, 'message' => 'Add user thất bại !!'];
        }

        $this->permissionRepository->create_permission($request);

        $permissions = $this->permissionRepository->getAll();

        return view('admin.permissions.row_permission', [
            'permissions' => $permissions,
        ]);
    }

    public function openEditModalPermission(Request $request)
    {
        $permission = $this->permissionRepository->openEditModal_permission($request);

        return view('admin.permissions.edit', compact('permission'));
    }

    public function postEdit(Request $request)
    {
        if (empty($request->name) || empty($request->title)) {
            return ['status' => 1, 'message' => 'permission không được để trống !'];
        }

        $this->permissionRepository->permissionEditRepo($request);

        $permissions = $this->permissionRepository->getAll();

        return view('admin.permissions.row_permission', compact('permissions'));
    }


    public function postDelete(Request $request)
    {
        $user = Permission::find($request->id);
        $user->delete();

        return redirect('admin/permissions');
    }
}
