<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\GroupUser;
use Illuminate\Http\Request;
use App\Repositories\GroupRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class GroupController extends Controller
{
    /**
     * @var GroupRepository
     */
    public $group;
    /**
     * @var CategoryRepository
     */
    public $category;
    /**
     * constructor for GroupController
     * 
     * @param GroupRepository $group
     *
     * @return void
     */
    public function __construct(GroupRepository $group, CategoryRepository $category)
    {
        $this->group = $group;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->category->findAll();
        return view('admin.groups.index', compact('categories'));
    }

    public function paginatedGroups()
    {
        $start = request()->get('start');
        $length = request()->get('length');
        $sortColumn = request()->get('order')[0]['name'] ?? 'id';
        $sortDirection = request()->get('order')[0]['dir'] ?? 'asc';
        $searchValue = request()->get('search')['value'];

        $count = $this->group->paginated($start, $length, $sortColumn, $sortDirection, $searchValue, true);
        $groups = $this->group->paginated($start, $length, $sortColumn, $sortDirection, $searchValue);

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $groups
        );

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = request()->get('id');
        $mode = $id ? 'updated' : 'created';

        $validator = validator()->make(request()->all(), [
            'title' => 'required|max:100',
            'description' => 'required',
            'category' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20480',
        ], [
            'title.required' => 'Title is required',
            'description.required' => 'Description is required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 1, 'message' => $validator->errors()->first()]);
        }

        $data = [
            'title' => request()->get('title'),
            'description' => request()->get('description'),
            'status' => request()->get('status'),
            'category_id' => request()->get('category'),
            'created_by' => auth()->user()->id
        ];

        if ($request->hasFile('image')) {
            $randomString = \Illuminate\Support\Str::random(40);
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = $randomString . '.' . $extension;

            $path = $request->file('image')->storeAs('images/group_logos', $filename, 'public_dir');
            $data['image_path'] = $path;
        }

        $group = $this->group->store($data, $id);

        return response()->json(['error' => 0, 'message' => 'Group ' . $mode . ' successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->group->delete($id);
        return response()->json(['error' => 0, 'message' => 'Group deleted successfully']);
    }

    public function joinRequest()
    {
        $groups = $this->group->findAll();
        return view('admin.groups.join-request', compact('groups'));
    }

    public function userJoinRequest()
    {
        // $group = $this->group->find(request()->group_id);
        // $users = $group->userRequest;
        $orderBy = ['#' => 'group_user.id', 'name' => 'name', 'group' => 'title'];
        if (request()->search['value']) {
            $users = GroupUser::orWhereHas('user', function ($q) {
                $q->where('name', 'like', '%' . request()->search['value'] . '%');
            })
                ->orWhereHas('group', function ($q) {
                    $q->where('title', 'like', '%' . request()->search['value'] . '%');
                })
                ->where('group_user.status', 0)
                ->join('users', 'group_user.user_id', '=', 'users.id')
                ->join('groups', 'group_user.group_id', '=', 'groups.id')
                // ->select('groups.title, users.name') // avoid column name conflict
                ->orderBy(
                    $orderBy[request()->order[0]['name'] ?? 'group_user.id'] ?? 'group_user.id',
                    request()->order[0]['dir'] ?? 'asc'
                )
                ->get();
        } else {
            $users = GroupUser::where('group_user.status', 0)
                ->join('users', 'group_user.user_id', '=', 'users.id')
                ->join('groups', 'group_user.group_id', '=', 'groups.id')
                // ->select('groups.title, users.name') // avoid column name conflict
                ->orderBy(
                    $orderBy[request()->order[0]['name'] ?? 'group_user.id'] ?? 'group_user.id',
                    request()->order[0]['dir'] ?? 'asc'
                )->get();
        }
        // $users = $this->collectionModifier($users, $group);
        $users = $this->collectionModifier($users);
        $count = $users->count();

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $users
        );

        return response()->json($data);
    }

    // protected function collectionModifier($users, $group)
    protected function collectionModifier($users)
    {
        // return $users->map(function ($user) use ($group) {
        return $users->map(function ($user, $key) {
            $user->serial = $key + 1;
            $user->name = $user->user->name;
            $user->group_title = $user->group->title;
            // $user->created_at_formated = $user->created_at->format('d M, Y');
            // $user->status_formated = $user->status == 1 ? 'Active' : 'Inactive';
            $user->actions = '<div class="form-group"><div class="form-check form-check-inline">
                <input data-group="' . $user->group_id . '" data-user="' . $user->user_id . '" class="form-check-input join-request-radio" type="radio" name="approvalStatus" id="approveRadio" value="true">
                <label class="form-check-label" for="approveRadio">Approve</label>
            </div>

            <div class="form-check form-check-inline">
                <input data-group="' . $user->group_id . '" data-user="' . $user->user_id . '" class="form-check-input join-request-radio" type="radio" name="approvalStatus" id="disapproveRadio" value="false">
                <label class="form-check-label" for="disapproveRadio">Decline</label>
            </div></div>';
            $user->setHidden(['user', 'group']);
            return $user;
        });
    }

    public function toggleJoinRequest()
    {
        $user = User::find(request()->user_id);

        if (request()->status == "true") {
            $user->groupRequest()->updateExistingPivot(request()->group_id, ['status' => 1]);
            $msg = 'approved';
            $category = $this->group->find(request()->group_id)->category;
            $user->categories()->syncWithoutDetaching([$category->id]);
        } else {
            $user->groupRequest()->detach(request()->group_id);
            $msg = 'declined';
        }

        return response()->json(['error' => 0, 'message' => 'Join request ' . $msg . ' successfully']);
    }

    public function members(Request $request, Group $group)
    {
        return view('admin.groups.members', compact('group'));
    }

    public function membersDatatable(Request $request, Group $group)
    {

        $start = request()->get('start');
        $length = request()->get('length');
        $sortColumn = request()->get('order')[0]['name'] ?? 'id';
        $sortDirection = request()->get('order')[0]['dir'] ?? 'asc';
        $searchValue = request()->get('search')['value'];

        $count = $this->group->membersPaginated($group, $start, $length, $sortColumn, $sortDirection, $searchValue, true);
        $members = $this->group->membersPaginated($group, $start, $length, $sortColumn, $sortDirection, $searchValue);

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $members
        );

        return response()->json($data);
    }
}
