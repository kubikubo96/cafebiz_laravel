<?php

namespace App\Repositories\Post;

use App\Repositories\EloquentRepository;
use App\Post;

class PostEloquentRepository extends EloquentRepository
{
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

        //hasFile : kiểm tra xem người dùng có truyền hình k. nếu k có thì để rỗng
        if ($attributes->hasFile('image')) {
            $file = $attributes->file('image');
            $endfile = $file->getClientOriginalExtension();

            if ($endfile != 'jpg' && $endfile != 'png' && $endfile != 'jpeg' && $endfile != 'JPG' && $endfile != 'PNG') {
                return redirect('admin/posts/')->with(
                    'error_img',
                    'Bạn chỉ được chọn file có đuôi jpg,png,jpeg :('
                );
            }
            $image = $file->getClientOriginalName();

            $file->move('images', $image);

            $data['image'] = $image;
        } else {
            $data['image'] = "";
        }

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
        $data = $attributes->all();

        //hasFile : kiểm tra xem người dùng có truyền hình k. nếu k có thì để rỗng
        if ($attributes->hasFile('image')) {
            $file = $attributes->file('image');
            $endfile = $file->getClientOriginalExtension();

            if ($endfile != 'jpg' && $endfile != 'png' && $endfile != 'jpeg' && $endfile != 'JPG' && $endfile != 'PNG') {
                return redirect('admin/posts/')->with(
                    'error_img',
                    'Bạn chỉ được chọn file có đuôi jpg,png,jpeg :('
                );
            }
            $image = $file->getClientOriginalName();

            $file->move('images', $image);

            $data['image'] = $image;
        }

        return $this->update($data['id'], $data);
    }

    public function postPaginate()
    {
        return $this->paginate(3);
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
