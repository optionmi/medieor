<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    public $user;

    public function __construct(UserRepository $userRepository)
    {
        $this->user = $userRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin_permissions = Role::where('name', 'admin')->first()->permissions;
        return view('superadmin.users.index', compact('admin_permissions'));
    }

    public function datatable()
    {
        $start = request()->get('start');
        $length = request()->get('length');
        $sortColumn = request()->get('order')[0]['name'] ?? 'id';
        $sortDirection = request()->get('order')[0]['dir'] ?? 'asc';
        $searchValue = request()->get('search')['value'];

        $count = $this->user->paginated($start, $length, $sortColumn, $sortDirection, $searchValue, true, 'user');
        $data = $this->user->paginated($start, $length, $sortColumn, $sortDirection, $searchValue, false, 'user');

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $data
        );
        return response()->json($data);
    }

    public function makeAdmin(Request $request, User $user)
    {
        $this->validate($request, [
            'permissions' => 'required|exists:permissions,id|distinct',
        ]);

        $isAdmin = $user->hasRole('admin');
        $granted_permissions = $request->input('permissions');
        $admin_role = Role::where('name', 'admin')->first();

        if (!$isAdmin) {
            $promotion = $user->roles()->sync($admin_role->id);
        }

        $restricted_permissions = $admin_role->permissions->whereNotIn('id', $granted_permissions)->pluck('id')->toArray();
        $restricted = $user->restrictions()->sync($restricted_permissions, true);

        if (!$isAdmin) return $this->jsonResponse((bool)$promotion, 'User is Admin Now!');
        if ($isAdmin) return $this->jsonResponse((bool)$restricted, 'Updated Permissions!');
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
