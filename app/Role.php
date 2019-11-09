<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    //
    protected $table='roles';

    protected $fillable = [
        'title',
    ];

    protected $dates = ['deleted_at'];

    public function permissions(){
        return $this->belongsToMany(Permission::class,'permission_roles');
    }

    public function users(){
        return $this->hasMany(User::class,'idRole','id');
    }


}
