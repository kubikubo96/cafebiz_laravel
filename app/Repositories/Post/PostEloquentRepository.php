<?php

namespace App\Repositories\Post;

use App\Repositories\EloquentRepository;
use App\Post;
use App\Services\PostService;

class PostEloquentRepository extends EloquentRepository
{
    use PostService;

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Post::class;
    }

    public function getAll()
    {
        return Post::with('comment', 'user')->get();
    }

    //xử lý postAdd bên PostController
    public function create_post($attributes)
    {
        $data = $attributes->all();

        $data['image'] = $this->updateImage($attributes->file('image'));

        return $this->create($data);
    }

    //xử lý openEditModal bên PostController
    public function openEditModal_post($attributes)
    {
        $data = $attributes->all();
        $id = $data['id'];

        return $this->find($id);
    }

    //xử lý postEdit bên PostController
    public function postEditRepo($attributes)
    {
        $data = $attributes->except('image');

        if ($attributes->hasFile('image')) {
            $data['image'] = $this->updateImage($attributes->file('image'));
        }

        return $this->update($data['id'], $data);
    }

    public function postPaginate()
    {
        return Post::paginate(3);
    }

    public function postHotNews()
    {
        return Post::first();
    }

    public function postHotNews2()
    {
        return Post::all()->skip(1)->take(3);
    }
}
