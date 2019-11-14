<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Repositories\Post\PostRepositoryInterface;
use Illuminate\Support\Facades\Auth;
Use App\Jobs\SendPostEmail;

class PostController extends Controller
{
    /**1
     * @var PostRepositoryInterface|\App\Repositories\RepositoryInterface
     */
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $post = $this->postRepository->getAll();

        return view('admin.posts.index', compact('post'));
    }

    public function postAdd(Request $request)
    {
        $this->authorize('view-post');

        //... Validation here
        if (empty($request->title) || empty($request->title_link) || empty($request->content_post)) {
            return ['status' => 1, 'message' => 'Add Post thất bại, các trường không được để trống !!'];
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
        //... Validation here
        if (empty($request->title) || empty($request->title_link) || empty($request->content_post)) {
            return ['status' => 1, 'message' => 'Edit Post thất bại, các trường không được để trống !!'];
        }

        $this->postRepository->postEditRepo($request);

        $post= $this->postRepository->getAll();

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

        $post= $this->postRepository->getAll();

        return view('admin.posts.row_post', compact('post'));

    }
}