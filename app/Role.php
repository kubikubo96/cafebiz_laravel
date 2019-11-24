<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    //
    protected $table = 'roles';

    protected $fillable = [
        'title',
    ];

    protected $dates = ['deleted_at'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_roles');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }

    public function permission_roles()
    {
        return $this->hasMany(Permission_Roles::class, 'role_id', 'id');
    }
}
