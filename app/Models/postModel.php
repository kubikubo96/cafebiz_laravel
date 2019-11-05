<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class postModel extends Model
{
    use SoftDeletes;
    //
    protected $table = "posts";

    //The attributes that are mass assignable.
    protected $fillable = ['title','title_link','content_post','image'];

    protected $dates = ['deleted_at'];

    public function comment(){
        return $this->hasMany('App\Models\commentModel','idPost','id');
    }


}
