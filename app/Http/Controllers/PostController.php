<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Post\PostEloquentRepository;
use App\Http\Requests\Postrequests\PostAddRequest;
use App\Http\Requests\Postrequests\PostEditRequest;

class PostController extends Controller
{
    /**3
     * @var PostEloquentRepository|\App\Repositories\RepositoryInterface
     * @var ...
     */
    protected $postRepository;
    protected $postAddRequest;
    protected $postEditRequest;


    public function __construct(
        PostEloquentRepository $postRepository,
        PostAddRequest $postAddRequest,
        PostEditRequest $postEditRequest
    ) {
        $this->postRepository = $postRepository;
        $this->postAddRequest = $postAddRequest;
        $this->postEditRequest = $postEditRequest;
    }

    public function index()
    {
        $post = $this->postRepository->getAll();

        return view('admin.posts.index', compact('post'));
    }

    public function postAdd(Request $request)
    {
        $this->authorize('view-post');

        if ($this->postAddRequest->rules($request)) {
            return $this->postAddRequest->rules($request);
        }

        $this->postRepository->create_post($request);

        $post = $this->postRepository->getAll();

        //compact : Truyền dữ liệu ra View
        return view('admin.posts.row_post', compact('post'));
    }

    public function openEditModal(Request $request)
    {
        //quyền chỉ author mới sữa được posts
        $this->authorize('view-post');

        $post = $this->postRepository->find($request->id);

        //quyền author chỉ được edit những bài viết của mình
        $this->authorize($post, 'openEditModal');

        $post = $this->postRepository->openEditModal_post($request);


        return view('admin.posts.edit', compact('post'));
    }

    public function postEdit(Request $request)
    {
        if ($this->postEditRequest->rules($request)) {
            return $this->postEditRequest->rules($request);
        }

        $this->postRepository->postEditRepo($request);

        $post = $this->postRepository->getAll();

        return view('admin.posts.row_post', compact('post'));
    }

    public function postDelete(Request $request)
    {
        //quyền chỉ author ms được delete
        $this->authorize('view-post');

        $post = $this->postRepository->find($request->id);

        //quyền author chỉ được delete những bài viết của mình
        $this->authorize($post, 'postDelete');

        $this->postRepository->delete($request->id);

        $post = $this->postRepository->getAll();

        return view('admin.posts.row_post', compact('post'));
    }
}
