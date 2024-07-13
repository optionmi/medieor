<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Group;
use App\Models\Post;
use App\Repositories\CommentRepository;

class DashboardController extends Controller
{
    public $comment;
    public function __construct(CommentRepository $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->comment->getCommentsCountByCategory();
        // dd($data);
        $cardData = new \stdClass();
        $cardData->usersCount = User::all()->count();
        $cardData->donationsCount = Donation::all()->count();
        $cardData->groupsCount = Group::all()->count();
        $cardData->postsCount = Post::all()->count();

        return view('admin.dashboard.index', compact('data', 'cardData'));
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
