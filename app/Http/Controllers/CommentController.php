<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
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
    public function store(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            $data = [
                'error' => true,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ];

            return response()->json(compact('data'));
        }

        // Create the comment
        $comment = Comment::create([
            'post_id' => $request->post_id,
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        $post = $comment->post;

        $post->comments_count = $post->comments->count();

        $post->save();

        // Prepare the JSON response
        $data = [
            'error' => false,
            'message' => 'Comment created successfully',
            'comment_count' => $post->comments->count(),
            'comment' => $comment,
        ];

        return response()->json(compact('data'));
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

    public function comments(Request $request)
    {
        if($post = Post::find($request->post_id)) {

            $data = [
                'error' => false,
                'message' => 'Comments fetched successfully',
                'comments' => view('group.comments-list', ['comments' => $post->comments])->render()
            ];
    
            return response()->json(compact('data'));
        }
    }
}
