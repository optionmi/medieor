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

        if (auth()->user()->isRestrictedFrom('can_reply')) return $this->restrictedAction();

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
            'update_url' => route('web.comment.reply.update', $commentReply->id)
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
        $validator = validator()->make($request->all(), [
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            $data = [
                'error' => true,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ];
            return response()->json(compact('data'), 400);
        }

        $commentReply = CommentReply::findOrFail($id);

        // Check if the authenticated user is the owner of the comment reply
        if (auth()->user()->id !== $commentReply->user_id) {
            $data = [
                'error' => true,
                'message' => 'Unauthorized. You do not have permission to update this comment reply.',
            ];
            return response()->json(compact('data'), 403);
        }

        // Update the comment reply
        $commentReply->update([
            'content' => $request->input('content'),
        ]);

        $data = [
            'error' => false,
            'message' => 'Comment reply updated successfully',
            'comment_reply' => $commentReply,
        ];

        return response()->json(compact('data'), 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, CommentReply $reply)
    {
        $authorized = $request->user()->hasRole('admin') || $reply->author->is($request->user());

        if ($authorized && $reply->delete()) {
            return response()->json(['message' => 'Reply deleted successfully']);
        }

        return response()->json(['message' => 'Unauthorized Action'], 403);
    }
}
