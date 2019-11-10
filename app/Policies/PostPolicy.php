<?php

namespace App\Policies;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function openEditModal(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    public function postDelete(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }
}
