<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class commentModel extends Model
{
    use SoftDeletes;
    //
    protected $table = "comments";

    public function post(){
        return $this->belongsTo('App\Models\postModel','idPost','id');
    }

    public function user(){
        return $this->belongsTo(userModel::class,'idUser','id');
    }
}
