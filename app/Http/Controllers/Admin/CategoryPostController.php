<?php

namespace App\Http\Controllers\Admin;

use App\Models\Topic;
use App\Models\CategoryPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Repositories\CategoryRepository;
use App\Repositories\CategoryPostRepository;

class CategoryPostController extends Controller
{
    public $category;
    public $category_post;
    /**
     * constructor for CategoryPostController
     * 
     * @param CategoryPostRepository $category_post
     *
     * @return void
     */
    public function __construct(CategoryPostRepository $category_post, CategoryRepository $category)
    {
        $this->category_post = $category_post;
        $this->category = $category;
    }

    public function index()
    {
        $category_posts = $this->category_post->findAll();
        $categories = $this->category->findAll();
        $topics = $this->category->find(1)->topics;
        return view('admin.category-posts.index', compact('category_posts', 'categories', 'topics'));
    }

    public function dataTable()
    {
        $data = $this->generateDataTableData($this->category_post);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $postId = $request->input('id');
        $mode = $postId ? 'update' : 'save';

        $request->validate([
            'title' => 'required|max:100',
            'body' => 'required|max:500',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'category' => 'required',
            'topic' => 'required',
        ], [
            'title.required' => 'Title is required',
            'body.required' => 'Body is required',
        ]);

        $postData = [
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'user_id' => auth()->id(),
            'category_id' => $request->input('category'),
            'topic_id' => $request->input('topic'),
        ];

        $post = $this->category_post->store($postData, $postId);

        return response()->json([
            'error' => 0,
            'message' => 'Category Post ' . $mode . 'd successfully',
        ]);
    }

    public function destroy(Request $request, CategoryPost $category_post)
    {
        $category_post->delete();
        return response()->json(['error' => 0, 'message' => 'Post deleted successfully']);
    }
}
