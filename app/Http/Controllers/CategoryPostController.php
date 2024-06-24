<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\CategoryPost;
use App\Models\CPComment;
use Illuminate\Http\Request;

class CategoryPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $category_id)
    {
        // dd($request->get(''));
        $cardsPerPage = $request->get('cardsPerPage') ?? 5;
        $start = $request->get('start') ?? 0;
        $category_posts = CategoryPost::where('category_id', $category_id)->skip($start)->take($cardsPerPage)->get();

        $data = [
            'error' => false,
            'message' => 'Posts fetched successfully',
            'count' => CategoryPost::where('category_id', $category_id)->count(),
            'posts' => view('components.web.category-post-list', compact('category_posts'))->render()
        ];

        return response()->json(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, CategoryPost $categoryPost)
    {
        $user = auth()->user();
        $categoryPost->increment('views');
        $postComments = $categoryPost->comments()->with('author')->get();
        return  Inertia::render('CategoryPostDetail', compact('user', 'categoryPost', 'postComments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
