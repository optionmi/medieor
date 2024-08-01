<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Group;
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

    public function index($id)
    {
        $category = $this->category->find($id);
        $groups = $category->active_groups;
        return view('group.index', compact('groups', 'category'));
    }

    public function create(Request $request)
    {
        $validator = validator()->make(request()->all(), [
            'name' => 'required|max:100',
            'description' => 'required|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
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
            'created_by' => auth()->user()->id,
        ];

        if ($request->hasFile('image')) {
            $filename = $this->uploadFile($request->file('image'), 'images/group_logos');
            $data['image_path'] = $filename;
        }
        if ($request->hasFile('desc_img')) {
            $filename = $this->uploadFile($request->file('desc_img'), 'images/group_desc');
            $data['desc_img'] = $filename;
        }

        $group = $this->group->store($data);

        $user = auth()->user();
        $user->groupRequest()->syncWithoutDetaching([$group->id]);
        $user->groupRequest()->updateExistingPivot($group->id, ['status' => 1]);

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

    public function myGroups()
    {
        $user = auth()->user();
        $groups = $user->groups;
        return view('my-groups', compact('groups'));
    }

    public function groupDetail(Request $request, Group $group)
    {
        $user = auth()->user();
        if ($user->hasRole('admin') || $user->hasJoinedGroup($group->id)) {
            return view('group.detail', compact('group'));
        }

        return redirect('/');
    }

    public function confirmJoinRequest()
    {
        $user = $this->user->find(request()->user);

        if (request()->approve == "true") {
            $user->groupRequest()->updateExistingPivot(request()->group, ['status' => 1]);
            $msg = 'approved';
            $category = $this->group->find(request()->group)->category;
            $user->categories()->syncWithoutDetaching([$category->id]);
        } else {
            $user->groupRequest()->detach(request()->group);
            $msg = 'declined';
        }

        return response()->json(['error' => 0, 'message' => 'Requested to joined ' . $msg . ' successfully']);
    }

    public function update(Request $request, Group $group)
    {
        if ($group->isOwned()) {
            $id = request()->get('id');
            $mode = $id ? 'updated' : 'created';

            $validator = validator()->make(request()->all(), [
                'title' => 'required|max:100',
                'description' => 'required',
                // 'image' => 'mimes:jpeg,png,jpg,gif,svg|max:20480',
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
            ];

            if ($request->hasFile('image')) {
                $filename = $this->uploadFile($request->file('image'), 'images/group_logos');
                $data['image_path'] = $filename;
            }
            if ($request->hasFile('desc_img')) {
                $filename = $this->uploadFile($request->file('desc_img'), 'images/group_desc');
                $data['desc_img'] = $filename;
            }

            $group = $this->group->store($data, $id);
            return back()->with('message', 'Group ' . $mode . ' successfully');
        } else {
            return back()->with('message', 'Unauthorized');
        }
    }

    public function destroy(Request $request, Group $group)
    {
        if ($group->isOwned()) {
            $deletion = $group->delete();
            return $this->jsonResponse($deletion, 'Group Deleted Successfully!');
        } else {
            return back()->with('message', 'Unauthorized');
        }
    }
}
