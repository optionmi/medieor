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
        if (auth()->user()->hasRestriction('can_comment')) return $this->restrictedAction();
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
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validator = validator()->make($request->all(), [
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            $data = [
                'error' => true,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ];

            return response()->json(compact('data'), 400);
        }

        // Find the comment by ID
        $comment = Comment::findOrFail($id);

        // Check if the authenticated user is the owner of the comment
        if (auth()->user()->id !== $comment->user_id) {
            $data = [
                'error' => true,
                'message' => 'Unauthorized. You do not have permission to update this comment.',
            ];

            return response()->json(compact('data'), 403);
        }

        // Update the comment
        $comment->update([
            'content' => $request->input('content'),
        ]);

        // Prepare the JSON response
        $data = [
            'error' => false,
            'message' => 'Comment updated successfully',
            'comment' => $comment,
        ];

        return response()->json(compact('data'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Comment $comment)
    {
        $authorized = $request->user()->hasRole('admin') || $comment->author->is($request->user());

        if ($authorized && $comment->delete()) {
            $post = $comment->post;
            $post->comments_count = $post->comments->count();
            $post->save();
            return response()->json(['message' => 'Comment deleted successfully']);
        }

        return response()->json(['message' => 'Unauthorized Action'], 403);
    }

    public function comments(Request $request)
    {
        if ($post = Post::find($request->post_id)) {

            $data = [
                'error' => false,
                'message' => 'Comments fetched successfully',
                'comments' => view('group.comment-list', ['comments' => $post->comments])->render()
            ];

            return response()->json(compact('data'));
        }
    }
}
