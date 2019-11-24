<?php

namespace App\Repositories\User;

use App\Repositories\EloquentRepository;
use App\Role;
use App\User;

class UserRepository extends EloquentRepository
{
    /**
     * get model
     * @return string
     */

    public function getModel()
    {
        return User::class;
    }

    function getAll()
    {
        return User::with('comments', 'posts', 'role')
            ->where('id', '!=', '1')->get();
    }

    //xử lý postAdd bên UserController
    public function create_user($attributes)
    {
        $data = $attributes->all();

        if (!empty($attributes->admin)) {
            $data['admin'] = $attributes->admin;
        } else {
            $data['admin'] = 0;
        }

        return $this->create($data);
    }

    //xử lý openEditModal bên UserController
    public function openEditModal_user($attributes)
    {
        $data = $attributes->all();
        $id = $data['id'];

        return $this->find($id);
    }

    //xử lý userEdit bên UserController
    public function userEditRepo($attributes)
    {
        $data = array();
        $id = $attributes->id;
        $data['name'] = $attributes->name;

        if ($attributes->password != null) {
            $data['password'] = bcrypt($attributes->password);
        }

        return $this->update($id, $data);
    }

    function getRolesForAddUser()
    {
        return Role::with('permissions', 'users', 'permission_roles')
            ->where('id', '!=', '1')->get();
    }
}
