<?php

namespace App\Http\Controllers\Superadmin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;

class AdminController extends Controller
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
        return view('superadmin.admins.index', compact('admin_permissions'));
    }

    public function datatable()
    {
        $start = request()->get('start');
        $length = request()->get('length');
        $sortColumn = request()->get('order')[0]['name'] ?? 'id';
        $sortDirection = request()->get('order')[0]['dir'] ?? 'asc';
        $searchValue = request()->get('search')['value'];

        $count = $this->user->paginated($start, $length, $sortColumn, $sortDirection, $searchValue, true, 'admin');
        $data = $this->user->paginated($start, $length, $sortColumn, $sortDirection, $searchValue, false, 'admin');

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $data
        );
        return response()->json($data);
    }

    public function removeAdmin(Request $request, User $user)
    {
        $user_role = Role::where('name', 'user')->first();
        $demotion = $user->roles()->sync($user_role->id);
        return $this->jsonResponse((bool)$demotion, 'Admin is user Now!');
    }

    public function makeSuperAdmin(Request $request, User $user)
    {
        $superadmin_role = Role::where('name', 'superadmin')->first();
        $promotion = $user->roles()->sync($superadmin_role->id);
        $user->restrictions()->delete();
        return $this->jsonResponse((bool)$promotion, 'Admin is superadmin Now!');
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
