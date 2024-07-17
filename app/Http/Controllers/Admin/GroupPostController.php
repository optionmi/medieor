<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\GroupPostRepository;

class GroupPostController extends Controller
{
    public $post;

    public function __construct(GroupPostRepository $post)
    {
        $this->post = $post;
    }

    public function index()
    {
        return view('admin.group-posts.index');
    }

    public function dataTable()
    {
        $data = $this->generateDataTableData($this->post);
        return response()->json($data);
    }

    public function destroy(Request $request, Post $post)
    {
        $deletion = $post->delete();
        return $this->jsonResponse($deletion, "Post deleted Successfully!");
    }
}
