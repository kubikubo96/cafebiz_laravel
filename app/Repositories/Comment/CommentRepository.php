<?php

namespace App\Repositories\Comment;

use App\Repositories\EloquentRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CommentRepository extends EloquentRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Comment::class;
    }

    //xử lý postAdd bên UserController
    public function create_comment($attributes)
    {
        $data = array();

        $post_id = $attributes->id_post;

        $user_id = $attributes->id_user;

        $data['post_id'] = $post_id;

//        $data['user_id'] =
        $data['user_id'] = $user_id;

        $data['content_comment'] = $attributes->content_comment;

        $result = $this->create($data);

        return $result;

    }

    public function getAllComment()
    {
        $comment = \App\Comment::with('user', 'post')->get();

        return $comment;
    }

}