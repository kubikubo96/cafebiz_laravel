<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id','name', 'email', 'password', 'admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = "users";

    protected $dates = ['deleted_at'];

    //tạo liên kết các model
    public function comments()
    {
        return $this->hasMany('App\Comment', 'idUser', 'id');
    }

    public function posts()
    {
        return $this->hasMany('App\Post', 'idUser', 'id');
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function hasPermission(Permission $permission){
        return !! optional(optional($this->role)->permissions)->contains($permission);
    }
}
