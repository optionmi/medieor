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

    public function datatable()
    {
        $start = request()->get('start');
        $length = request()->get('length');
        $sortColumn = request()->get('order')[0]['name'] ?? 'id';
        $sortDirection = request()->get('order')[0]['dir'] ?? 'asc';
        $searchValue = request()->get('search')['value'];

        $count = $this->user->paginated($start, $length, $sortColumn, $sortDirection, $searchValue, true);
        $users = $this->user->paginated($start, $length, $sortColumn, $sortDirection, $searchValue);

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $users
        );

        return response()->json($data);
    }

    public function destroy($id)
    {
        $this->user->delete($id);
        return response()->json(['error' => 0, 'message' => 'User deleted successfully']);
    }
}
