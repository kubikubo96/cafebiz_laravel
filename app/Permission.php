<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    //
    use SoftDeletes;

    protected $table = "permissions";

    protected $fillable = [
        'title', 'name',
    ];

    protected $dates = ['deleted_at'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_roles');
    }

    public function permission_roles()
    {
        return $this->hasMany(Permission_Roles::class, 'permission_id', 'id');
    }
}
