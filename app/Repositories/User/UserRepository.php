<?php

namespace App\Repositories\User;

use App\Repositories\EloquentRepository;
use App\Role;
use App\User;

class UserRepository extends EloquentRepository
{
    public function __construct(User $user,Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }
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
        return $this->user->with('comments', 'posts', 'role')
            ->where('name', '!=', 'root')->get();
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

        return $this->user->create($data);
    }

    //xử lý openEditModal bên UserController
    public function openEditModal_user($attributes)
    {
        $data = $attributes->all();
        $id = $data['id'];

        return $this->user->find($id);
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

        return $this->user->update($data['id'], $data);
    }

    function getRolesForAddUser()
    {
        return $this->role->with('permissions', 'users', 'permission_roles')
            ->where('id', '!=', '1')->get();
    }
}
