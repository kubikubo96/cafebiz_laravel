<?php

namespace App\Repositories\Role;

use App\Permission_Roles;
use App\Repositories\EloquentRepository;
use App\Role;
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

    public function getAll()
    {
        $roles = \App\Role::with('permissions', 'users', 'permission_roles')->get();

        return $roles;
    }

    //xử lý postAdd bên RoleController
    public function create_role($attributes)
    {
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