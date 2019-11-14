<?php

namespace App\Repositories\User;

use App\Repositories\EloquentRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

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

    //xử lý postAdd bên UserController
    public function create_user($attributes)
    {
        $data = array();
        $data['name'] = $attributes->name;
        $data['role_id'] = $attributes->role_id;
        $data['email'] = $attributes->email;
        $data['password'] = bcrypt($attributes->password);
        $data['admin'] = $attributes->admin;

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

        $result = $this->update( $data['id'],$data);

        return $result;


    }

}