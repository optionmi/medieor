<?php

namespace App\Http\Controllers;

use App\Models\CategoryPost;
use App\Models\CPComment;
use Illuminate\Http\Request;

class CPCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, CategoryPost $categoryPost)
    {
        // dd($request);
        $request->validate([
            'comment' => 'required',
        ]);

        $data = [
            'post_id' => $categoryPost->id,
            'content' => $request->get('comment'),
            'user_id' => auth()->user()->id
        ];
        $isCreated = (bool) CPComment::create($data);
        $categoryPost->increment('comment_count');

        return $this->jsonResponse($isCreated, 'Comment added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
