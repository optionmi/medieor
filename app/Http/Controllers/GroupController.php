<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use App\Repositories\GroupRepository;
use App\Repositories\UserRepository;

class GroupController extends Controller
{
    /**
     * @var CategoryRepository
     */
    public $category;
    /**
     * @var GroupRepository
     */
    public $group;

    public $user;
    /**
     * constructor for GroupController
     * 
     * @param GroupRepository $group
     *
     * @return void
     */
    public function __construct(CategoryRepository $category, GroupRepository $group, UserRepository $user)
    {
        $this->category = $category;
        $this->group = $group;
        $this->user = $user;
    }

    public function index()
    {
        $groups = $this->group->allActive();
        return view('groups', compact('groups'));
    }

    public function create(Request $request)
    {
        $validator = validator()->make(request()->all(), [
            'name' => 'required|max:100',
            'description' => 'required|max:500',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20480',
        ], [
            'name.required' => 'Title is required',
            'description.required' => 'Description is required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 1, 'message' => $validator->errors()->first()]);
        }

        $data = [
            'title' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'created_by' => auth()->id(),
        ];

        $this->group->store($data);

        return response()->json(['error' => 0, 'message' => 'Group created successfully']);
    }

    public function join(Request $request)
    {
        $data = [
            'user_id' => auth()->id(),
            'group_id' => $request->id,
        ];

        $user = auth()->user();

        $user->groupRequest()->syncWithoutDetaching([$request->id]);

        return response()->json(['error' => 0, 'message' => 'Requested to joined successfully']);
    }

    public function joinRequest()
    {
        $user = auth()->user();
        
        $groups = $user->ownedGroups;

        return view('group-join-requests', compact('groups'));
    }

    public function confirmJoinRequest()
    {
        $user = $this->user->find(request()->user);

        if(request()->approve == "true") {
            $user->groupRequest()->updateExistingPivot(request()->group, ['status' => 1]);
            $msg = 'approved';
        } else {
            $user->groupRequest()->detach(request()->group);
            $msg = 'declined';
        }

        return response()->json(['error' => 0, 'message' => 'Requested to joined '.$msg.' successfully']);
    }
}