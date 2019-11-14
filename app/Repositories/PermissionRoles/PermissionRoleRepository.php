<?php

namespace App\Repositories\PermissionRoles;

use App\Repositories\EloquentRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PermissionRoleRepository extends EloquentRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Permission_Roles::class;
    }

    //xử lý postAdd bên PermissionController
    public function create_permission_role($attributes)
    {
        $data = array();

        $data['title'] = $attributes->title;
        $data['name'] = $attributes->name;

        $result = $this->create($data);

        return $result;

    }

}