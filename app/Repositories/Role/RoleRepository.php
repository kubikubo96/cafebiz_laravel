<?php

namespace App\Repositories\Role;

use App\Permission_Roles;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class RoleRepository extends EloquentRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Role::class;
    }

    //xử lý postAdd bên RoleController
    public function create_role($attributes)
    {
        $data = array();

        $data['title'] = $attributes->title;

        //lấy mảng id permission được truyền lên Request
        $arr_permission_ids = isset($attributes->my_multi_select1) ? $attributes->my_multi_select1 : array();

        foreach ($arr_permission_ids as $id) {
            $permissionRole = new Permission_Roles;

            $permissionRole->permission_id = $id;

            $permissionRole->role_id = $data['id'];

            $permissionRole->save();

        }

        $result = $this->create($data);

        return $result;

    }

    //xử lý openEditModal bên RoleController
    public function openEditModal_role($attributes)
    {
        $data = $attributes->all();
        $id = $data['id'];
        $result = $this->find($id);
        return $result;
    }
}