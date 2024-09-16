<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostMedia;

class PostController extends Controller
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
        if (auth()->user()->hasRestriction('can_post')) return $this->restrictedAction();
        $request->validate([
            'content' => 'required|string',
            'post_media' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = new Post();
        $post->user_id = auth()->id();
        $post->group_id = $request->group_id;
        $post->content = $request->content;

        $post->save();

        if ($request->hasFile('post_media')) {
            $image = $request->file('post_media');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/posts'), $imageName);
            $post_media = new PostMedia();
            $post_media->post_id = $post->id;
            $post_media->path = 'images/posts/' . $imageName;
            $post_media->save();
        }

        $post->save();

        $group = $post->group;

        $data = [
            'error' => false,
            'message' => 'Post created successfully',
            'posts' => view('components.web.post-list', ['group' => $group])->render()
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
    public function destroy(Request $request, Post $post)
    {
        $authorized = $request->user()->hasRole('admin') || $post->author->is($request->user() || $post->group->owner->is($request->user()));

        if ($authorized && $post->delete()) {
            return response()->json(['message' => 'Post deleted successfully']);
        }

        return response()->json(['message' => 'Unauthorized Action'], 403);
    }
}
