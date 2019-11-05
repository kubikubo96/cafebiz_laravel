<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\commentModel;
use Illuminate\Http\Request;
use App\Models\postModel;
use App\Models\userModel;
use Illuminate\Support\Facades\Auth;

class commentController extends Controller
{

    public function getComment(){
        $comment = commentModel::all();
        return view('admin.comments.comment',['comment'=>$comment]);
    }

    public function postComment($id,Request $request){
        $idPost = $id;
        echo $id;
        $post = postModel::find($id);
        $comment = new commentModel;
        $comment->idPost = $idPost;
        $comment->idUser =Auth::id();
        $comment->content_comment = $request->content_comment;
        $comment->save();

        return redirect("detail/$id/".$post->title_link.".html")->with('notify','Viết bình luận thành công');

    }

    //
    public function getDelete($id){

        $comment = commentModel::find($id);
        $comment->delete();

        return redirect('admin/comment')->with('notify','Xóa comments thành công');
    }
}
