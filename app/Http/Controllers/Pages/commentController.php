<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Comment;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;

class commentController extends Controller
{

    public function getComment(){
        $comment = Comment::all();
        return view('admin.comments.comment',['comment'=>$comment]);
    }

    public function postComment($id,Request $request){
        $idPost = $id;
        $post = Post::find($id);
        $comment = new Comment;
        $comment->idPost = $idPost;
        $comment->idUser =Auth::id();
        $comment->content_comment = $request->content_comment;
        $comment->save();

        return redirect("detail/$id/".$post->title_link.".html")->with('notify','Viết bình luận thành công');

    }

    //
    public function getDelete($id){

        $comment = Comment::find($id);
        $comment->delete();

        return redirect('admin/comment')->with('notify','Xóa comments thành công');
    }
}
