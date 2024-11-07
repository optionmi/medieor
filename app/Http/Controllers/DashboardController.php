<?php

namespace App\Http\Controllers;

use App\Models\Group;

class DashboardController extends Controller
{
    public function index()
    {
        $groups = auth()->user()->ownedGroups;
        return view('dashboard', compact('groups'));
    }

    public function usersGroups()
    {
        $groups = Group::whereHas('owner.roles', function ($query) {
            $query->where('name', 'user');
        })->get();
        return view('dashboard-users-groups', compact('groups'));
    }
}
