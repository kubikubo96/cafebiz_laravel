<?php

namespace App\Repositories\Post;

use App\Repositories\EloquentRepository;

class PostEloquentRepository extends EloquentRepository implements PostRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Post::class;
    }

    public function getAll(){
        return \App\Post::with('comment','user')->get();
    }

    //xử lý postAdd bên PostController
    public function create_post($attributes)
    {
        $data = array();
        $data['user_id'] = $attributes->user_id;
        $data['title'] = $attributes->title;
        $data['title_link'] = $attributes->title_link;
        $data['content_post'] = $attributes->content_post;
        //hasFile : kiểm tra xem người dùng có truyền hình k. nếu k có thì để rỗng
        if ($attributes->hasFile('image')) {
            $file = $attributes->file('image');
            $endfile = $file->getClientOriginalExtension();

            if ($endfile != 'jpg' && $endfile != 'png' && $endfile != 'jpeg' && $endfile != 'JPG' && $endfile != 'PNG') {
                return redirect('admin/posts/')->with('error_img',
                    'Bạn chỉ được chọn file có đuôi jpg,png,jpeg :(');
            }
            $image = $file->getClientOriginalName();

            $file->move('images', $image);

            $data['image'] = $image;
        } else {
            $data['image'] = "";

        }
        $result = $this->create($data);

        return $result;
    }

    //xử lý openEditModal bên PostController
    public function openEditModal_post($attributes)
    {

        $data = $attributes->all();
        $id = $data['id'];
        $result = $this->find($id);
        return $result;
    }

    //xử lý postEdit bên PostController
    public function postEditRepo($attributes)
    {
        $data = array();
        $data['id'] = $attributes->id;
        $data['title'] = $attributes->title;
        $data['title_link'] = $attributes->title_link;
        $data['content_post'] = $attributes->content_post;

        //hasFile : kiểm tra xem người dùng có truyền hình k. nếu k có thì để rỗng
        if ($attributes->hasFile('image')) {
            $file = $attributes->file('image');
            $endfile = $file->getClientOriginalExtension();

            if ($endfile != 'jpg' && $endfile != 'png' && $endfile != 'jpeg' && $endfile != 'JPG' && $endfile != 'PNG') {
                return redirect('admin/posts/')->with('error_img',
                    'Bạn chỉ được chọn file có đuôi jpg,png,jpeg :(');
            }
            $image = $file->getClientOriginalName();

            $file->move('images', $image);

            $data['image'] = $image;
        } else {
            $data['image'] = "";

        }

        $result = $this->update($data['id'], $data);

        return $result;
    }

    public function postPaginate()
    {
        $post_paginate = \App\Post::paginate(3);
        return $post_paginate;
    }

    public function postHotNews()
    {
        $hotnews = \App\Post::first();
        return $hotnews;
    }

    public function postHotNews2(){
        $hotnews2 = \App\Post::all()->skip(1)->take(3);
        return $hotnews2;
    }

}