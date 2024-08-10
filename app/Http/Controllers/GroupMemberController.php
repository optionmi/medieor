<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class GroupMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Group $group)
    {
        $members = $group->users;
        return view('members-management', compact('members', 'group'));
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
    public function destroy(Request $request, Group $group, User $user)
    {
        if ($group->isOwned()) {
            $removal = $user->groups()->detach($group->id);
            return $this->jsonResponse($removal, 'Member removed Successfully!');
        } else {
            return back()->with('message', 'Unauthorized');
        }
    }
}
