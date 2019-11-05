<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class userModel extends Model
{
    use SoftDeletes;
    //
    protected $table = "users";

    protected $dates = ['deleted_at'];

    //tạo liên kết các model
    public function comments(){
        return $this->hasMany(commentModel::class,'idUser','id');
    }
}
