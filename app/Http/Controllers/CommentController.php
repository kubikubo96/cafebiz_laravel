<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Comment;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function getComment()
    {
        $comment = Comment::all();
        return view('admin.comments.index', ['comment' => $comment]);
    }

    //
    public function postDelete(Request $request)
    {
        $comment = Comment::find($request->id);

        $post = Post::find($comment->post_id);

        //quyền chỉ được delete những comment bài viết của mình
        $this->authorize($post, 'postDelete');

        $comment->delete();

        return redirect('admin/comments')->with('notify', 'Xóa comments thành công');
    }

    public function postComment(Request $request)
    {

        $post_id = $request->id_post;

        $comment = new Comment;

        $comment->post_id = $post_id;

        $comment->user_id = Auth::id();

        $comment->content_comment = $request->content_comment;

        $comment->save();

        return view('pages.row_detail', [
            'cm' => $comment,
        ]);

    }
}
