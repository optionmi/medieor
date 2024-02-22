<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Models\CommentReply;

class CommentReplyController extends Controller
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
            'content' => 'required|string',
            'commentId' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $data = [
                'error' => true,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ];
            return response()->json(compact('data'), 400);
        }

        $comment = Comment::findOrFail($request->commentId);

        $commentReply = new CommentReply([
            'content' => $request->input('content'),
            'user_id' => auth()->user()->id,
        ]);

        $comment->replies()->save($commentReply);

        $data = [
            'error' => false,
            'message' => 'Comment reply created successfully',
            'comment_reply' => $commentReply,
        ];

        return response()->json(compact('data'), 201);
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
