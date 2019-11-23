<?php

namespace App\Repositories\Role;

use App\Repositories\EloquentRepository;
use App\Role;

class RoleRepository extends EloquentRepository
{
    public function __construct(Role $role)
    {
        $this->role = $role;
    }
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Role::class;
    }

    public function getAll()
    {
        $roles = $this->role->with('permissions', 'users', 'permission_roles')->get();
        return $roles;
    }

    public  function addRole($attributes)
    {
        $data = array();

        $data['title'] = $attributes->title;

        return $this->role->create($data);
    }

    //xử lý openEditModal bên RoleController
    public function openEditModal_role($attributes)
    {
        return $this->role->find($attributes->id);
    }
}
