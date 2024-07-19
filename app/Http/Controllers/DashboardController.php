<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $groups = auth()->user()->ownedGroups;
        return view('dashboard', compact('groups'));
    }
}
