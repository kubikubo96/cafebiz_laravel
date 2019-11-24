<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    //
    protected $table = "posts";

    //The attributes that are mass assignable.
    protected $fillable = ['user_id', 'title', 'title_link', 'content_post', 'image'];

    protected $dates = ['deleted_at'];

    public function comment()
    {
        return $this->hasMany('App\Comment', 'post_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
