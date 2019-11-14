<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Comment;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\Post\PostEloquentRepository;

class CommentController extends Controller
{
    protected $commentRepository;
    protected $postRepository;

    public function __construct(CommentRepository $commentRepository,PostEloquentRepository $postEloquentRepository)
    {
        $this->commentRepository = $commentRepository;
        $this->postRepository = $postEloquentRepository;
    }

    public function getComment()
    {
        $comment = $this->commentRepository->getAll();

        return view('admin.comments.index', ['comment' => $comment]);
    }

    public function postComment(Request $request)
    {

        $comment = $this->commentRepository->create_comment($request);

        return view('pages.row_detail', [
            'cm' => $comment,
        ]);

    }

    public function postDelete(Request $request)
    {

        $comment = $this->commentRepository->find($request->id);

        $post = $this->postRepository->find($comment->post_id);

        //quyền chỉ được delete những comment bài viết của mình
        $this->authorize($post, 'postDelete');

        $comment->delete();

        return redirect('admin/comments')->with('notify', 'Xóa comments thành công');
    }
}
