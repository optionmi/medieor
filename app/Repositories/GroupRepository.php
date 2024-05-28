<?php

namespace App\Repositories;

use App\Repositories\Contracts\GroupRepositoryInterface;
use App\Models\Group;

class GroupRepository extends BaseRepository implements GroupRepositoryInterface
{

    public $group;

    public function __construct(Group $group)
    {
        parent::__construct($group);

        $this->group = $group;
    }

    public function paginated($start, $length, $sortColumn, $sortDirection, $searchValue, $countOnly = false)
    {
        $query = $this->group->select('*');

        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->orWhere('title', 'LIKE', "%$searchValue%")
                    ->orWhere('description', 'LIKE', "%$searchValue%")
                    ->orWhereHas('categories', function ($q) use ($searchValue) {
                        $q->where('title', 'LIKE', "%$searchValue%");
                    });
            });
        }


        if (!empty($sortColumn)) {
            $sortColumn = strtolower($sortColumn) === '#' ? 'id' : strtolower($sortColumn);
            $query->orderBy($sortColumn, $sortDirection);
        }

        $count = $query->count();

        if ($countOnly) {
            return $count;
        }

        $query->skip($start)->take($length);
        $groups = $query->get();
        $groups = $this->collectionModifier($groups, $start);
        return $groups;
    }

    public function collectionModifier($groups, $start)
    {
        return $groups->map(function ($group, $key) use ($start) {
            $group->serial = $start + 1 + $key;
            $group->Categories;
            $group->created_at_formated = $group->created_at->format('d M, Y');
            $group->status_formated = $group->status == 1 ? 'Active' : 'Inactive';
            $group->image_formated = $group->image_path ? (filter_var($group->image_path, FILTER_VALIDATE_URL) ?
                '<img src="' . $group->image_path . '" width="150px" />' :
                '<img src="' . asset($group->image_path) . '" width="150px" />') : null;
            $group->action =
                // '<button class="btn btn-primary btn-sm" data-id="' . $group->id . '" data-toggle="modal" data-target="#edit-group" data-title="' . $group->title . '" data-description="' . $group->description . '" data-image_path="' . $group->image_path . '" data-status="' . $group->status . '">Edit</button><button class="btn btn-danger btn-sm" data-id="' . $group->id . '">Delete</button>' .
                '<div class="d-flex">
                    <button
                        class="px-2 py-2 btn btn-link nav-link d-flex align-items-center edit-btn"
                        type="button" title="Edit" data-coreui-toggle="modal"
                        data-coreui-target="#groupStore"
                        data-update-route="' . route('admin.group.store') . '"
                        data-row-data="' . htmlspecialchars(json_encode(array($group->id, $group->title, $group->description, $group->category_id, $group->status))) . '">
                        <svg class="icon icon-lg text-primary">
                            <use
                                xlink:href="' . url('coreui/vendors/@coreui/icons/svg/free.svg#cil-pencil') . '">
                            </use>
                        </svg>
                    </button>
                    <button class="px-2 py-2 btn btn-link nav-link d-flex align-items-center"
                    type="button" title="Delete" data-coreui-toggle="modal"
                    data-coreui-target="#deleteModal" data-delete-route="' . route('admin.group.destroy', $group->id) . '" >
                    <svg class="icon icon-lg text-danger">
                    <use
                    xlink:href="' . url('coreui/vendors/@coreui/icons/svg/free.svg#cil-trash') . '">
                    </use>
                    </svg>
                    </button>
                    </div>';
            return $group;
        });
    }

    public function allActive()
    {
        return $this->group->where('status', 1)->get();
    }
}
