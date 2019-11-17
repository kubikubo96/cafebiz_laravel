<?php

namespace App\Repositories\Role;

use App\Repositories\EloquentRepository;

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

    //xử lý openEditModal bên RoleController
    public function openEditModal_role($attributes)
    {
        $data = $attributes->all();
        $id = $data['id'];
        $result = $this->find($id);
        return $result;
    }
}