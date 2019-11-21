<?php

namespace App\Repositories\User;

use App\Repositories\EloquentRepository;
use App\Role;

class UserRepository extends EloquentRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\User::class;
    }

    function getAll()
    {
        $user = \App\User::with('comments', 'posts', 'role')
            ->where('name', '!=', 'root')->get();
        return $user;
    }

    //xử lý postAdd bên UserController
    public function create_user($attributes)
    {
        $data = array();
        $data['name'] = $attributes->name;
        $data['role_id'] = $attributes->role_id;
        $data['email'] = $attributes->email;
        $data['password'] = bcrypt($attributes->password);

        if (!empty($attributes->admin)) {
            $data['admin'] = $attributes->admin;
        } else {
            $data['admin'] = 0;
        }

        $result = $this->create($data);

        return $result;

    }

    //xử lý openEditModal bên UserController
    public function openEditModal_user($attributes)
    {
        $data = $attributes->all();
        $id = $data['id'];

        $result = $this->find($id);
        return $result;
    }

    //xử lý userEdit bên UserController
    public function userEditRepo($attributes)
    {
        $data = array();
        $data['id'] = $attributes->id;
        $data['name'] = $attributes->name;

        if ($attributes->password != null) {
            $attributes->password = bcrypt($attributes->password);
        }

        $result = $this->update($data['id'], $data);

        return $result;


    }

    function getRolesForAddUser()
    {
        $rolesForAddUser = Role::with('permissions', 'users', 'permission_roles')
            ->where('title', '!=', 'root')->get();
        return $rolesForAddUser;
    }

}