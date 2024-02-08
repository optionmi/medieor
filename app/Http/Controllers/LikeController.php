<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Like;
use App\Models\Post;

class LikeController extends Controller
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
        dd($request->all());
        $request->validate([
            'post_id' => ['required', 'integer', Rule::exists('posts', 'id')],
        ]);

        $post_id = $request->post_id;
        $like_id = $request->like_id;

        $like = [
            'post_id' => $request->post_id,
            'user_id' => auth()->id(),
        ];

        $like = Like::create($like);

        $data = [
            'error' => false,
            'message' => 'You liked the post',
        ];

        return response(compact('data'));
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

    public function toggleLike(Request $request)
    {
        $post_id = $request->post_id;

        $user = auth()->user();
        $userLikes = $user->likes;

        if ($userLikes->contains('post_id', $post_id)) {
            $userLikes->where('post_id', $post_id)->first()->delete();
            $message = 'You disliked the post';
        } else {
            $like = new Like(['post_id' => $post_id]);
            $user->likes()->save($like);
            $message = 'You liked the post';
        }

        $post = Post::find($post_id);

        $data = [
            'error' => false,
            'message' => $message, 
            'post_id' => $post_id,
            'like_count' => $post->likes->count()
        ];
    
        return response()->json(compact('data'));
    }
}
