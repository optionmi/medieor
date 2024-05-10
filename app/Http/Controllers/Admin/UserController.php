<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $user;
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }


    public function index()
    {
        $users = $this->user->findAll();
        return view('admin.users.index', compact('users'));
    }
}
