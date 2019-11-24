<?php

namespace App\Repositories\Permission;

use App\Repositories\EloquentRepository;

class PermissionRepository extends EloquentRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Permission::class;
    }

    public function getAll()
    {
        return \App\Permission::with('roles', 'permission_roles')->get();
    }

    //xử lý postAdd bên PermissionController
    public function create_permission($attributes)
    {
        $data = array();
        $data['title'] = $attributes->title;
        $data['name'] = $attributes->name;
        $result = $this->create($data);

        return $result;
    }

    //xử lý openEditModal bên PermissionController
    public function openEditModal_permission($attributes)
    {
        $data = $attributes->all();
        $id = $data['id'];

        $result = $this->find($id);
        return $result;
    }

    //xử lý permissionEdit bên PermissionController
    public function permissionEditRepo($attributes)
    {
        $data = array();
        $data['id'] = $attributes->id;
        $data['title'] = $attributes->title;
        $data['name'] = $attributes->name;

        $result = $this->update($data['id'], $data);

        return $result;
    }
}
