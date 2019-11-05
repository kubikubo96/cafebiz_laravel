<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\postModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class postController extends Controller
{
    public function __construct()
    {
        $post = postModel::all();
        view()->share('post', $post);
    }

    //
    function getAll()
    {
        return view('admin.posts.index');
    }

    function postAdd(Request $request)
    {
//        dd($request->all());
//        return 1;
        if (empty($request) || empty($request->title_link) || empty($request->content_post)) {
            return ['status' => 1, 'message' => 'Add Post thất bại !!'];
        }
        $post = new postModel;
        $post->title = $request->title;
        $post->title_link = $request->title_link;
        $post->content_post = $request->content_post;

        //        dd($request->image->getClientOriginalName());
        //        return 1
        //hasFile : kiểm tra xem người dùng có truyền hình k. nếu k có thì để rỗng
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $endfile = $file->getClientOriginalExtension();

            if ($endfile != 'jpg' && $endfile != 'png' && $endfile != 'jpeg' && $endfile != 'JPG' && $endfile != 'PNG') {
                return redirect('admin/posts/')->with('error_img',
                    'Bạn chỉ được chọn file có đuôi jpg,png,jpeg :(');
            }
            $image = $file->getClientOriginalName();

            $file->move('images', $image);

            $post->image = $image;
        } else {
            $post->image = "";

        }
        $post->save();

        return view('admin.posts.row_post',[
            'pt' => $post,
        ]);

    }

    public function openEditModal(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $post = postModel::find($id);
//        dd($post);
        //compact : Truyền dữ liệu ra View
        return view('admin.posts.edit',compact('post'));
    }
//
//    function getEdit($id)
//    {
//        $post_edit = postModel::find($id);
//        return view('admin/posts/edit', ['post_edit' => $post_edit]);
//    }

    function postEdit(Request $request)
    {
//        dd($request->all());

        $post = postModel::find($request->id);
        $post->title = $request->title;
        $post->title_link = $request->title_link;
        $post->content_post = $request->content_post;

        //hasFile : kiểm tra xem người dùng có truyền hình k. nếu k có thì để rỗng
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $endfile = $file->getClientOriginalExtension();

            if ($endfile != 'jpg' && $endfile != 'png' && $endfile != 'jpeg' && $endfile != 'JPG' && $endfile != 'PNG') {
                return redirect('admin/posts/add')->with('error_img',
                    'Bạn chỉ được chọn file có đuôi jpg,png,jpeg :(');
            }
            $image = $file->getClientOriginalName();

            $file->move('images', $image);

            $post->image = $image;
        }
        $post->save();

        return view('admin.posts.row_post',[
            'pt' => $post,
        ]);
//        return redirect('admin/posts')->with('notify', 'Edit thành công !!');

//        return response()->json($post);

    }

    function postDelete(Request $request)
    {
        $post = postModel::find($request->id);
        $post->delete();

        return redirect('admin/posts');
    }


}
