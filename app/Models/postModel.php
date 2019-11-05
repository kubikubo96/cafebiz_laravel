<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class postModel extends Model
{
    use SoftDeletes;
    //
    protected $table = "posts";

    protected $dates = ['deleted_at'];

    public function comment(){
        return $this->hasMany('App\Models\commentModel','idPost','id');
    }
}
