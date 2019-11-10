<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;

class PermissionController extends Controller
{
    //
    public function getAll()
    {
        $this->authorize('root');

        $permssions = Permission::all();
        return view('admin.permissions.index', compact('permssions'));
    }

    public function postAdd(Request $request)
    {
        if (empty($request->name)) {
            return ['status' => 1, 'message' => 'Add user thất bại !!'];
        }
        $permission = new Permission;
        $permission->title= $request->title;
        $permission->name = $request->name;

        $permission->save();

        return view('admin.permissions.row_permission', [
            'permission' => $permission,
        ]);
    }

    public function openEditModalPermission(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $permission = Permission::find($id);
        return view('admin.permissions.edit', compact('permission'));
    }

    public function postEdit(Request $request){
        if(empty($request->name) || empty($request->title)){
            return ['status' => 1, 'message' => 'permission không được để trống !'];
        }
        $permission = Permission::find($request->id);
        $permission->title = $request->title;
        $permission->name = $request->name;

        $permission->save();

        return view('admin.permissions.row_permission',compact('permission'));
    }


    public function postDelete(Request $request)
    {
        $user = Permission::find($request->id);
        $user->delete();

        return redirect('admin/permissions');
    }
}
