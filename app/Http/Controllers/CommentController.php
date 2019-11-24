<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\Post\PostEloquentRepository;

class CommentController extends Controller
{
    protected $commentRepository;
    protected $postRepository;

    public function __construct(
        CommentRepository $commentRepository,
        PostEloquentRepository $postEloquentRepository
    ) {
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
        if (empty($request->content_comment)) {
            $post = $this->postRepository->find($request->id_post);

            return view('pages.row_detail', [
                'post' => $post,
                'error_comment' => 'Bạn chưa nhập comment!'
            ]);
        }
        $comment = $this->commentRepository->create_comment($request);

        $post = $comment->post;

        return view('pages.row_detail', [
            'post' => $post,
        ]);
    }

    public function postDelete(Request $request)
    {
        $comment = $this->commentRepository->find($request->id);

        $post = $this->postRepository->find($comment->post_id);
        //quyền chỉ được delete những comment bài viết của mình
        $this->authorize($post, 'postDelete');

        $comment->delete();
        $comment = $this->commentRepository->getAll();

        return view('admin.comments.row_comment', compact('comment'));
    }
}
