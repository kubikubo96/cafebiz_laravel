<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\postModel;
use App\Repositories\Post\PostRepositoryInterface;

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
        //... Validation here
        if (empty($request) || empty($request->title_link) || empty($request->content_post)) {
            return ['status' => 1, 'message' => 'Add Post thất bại !!'];
        }

        $pt = $this->postRepository->create_post($request);

        //compact : Truyền dữ liệu ra View
        return view('admin.posts.row_post', compact('pt'));
    }

    public function openEditModal(Request $request)
    {
        $post = $this->postRepository->openEditModal_post($request);

        return view('admin.posts.edit',compact('post'));
    }

    public function postEdit(Request $request)
    {
        $pt = $this->postRepository->postEditRepo($request);

        return view('admin.posts.row_post', compact ('pt'));
    }

    public function postDelete(Request $request)
    {
        $this->postRepository->delete($request->id);

        return redirect('admin/posts');

    }
}