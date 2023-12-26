<?php

namespace App\Repositories;

use App\Repositories\Contracts\GroupRepositoryInterface;
use App\Models\Group;

class GroupRepository extends BaseRepository implements GroupRepositoryInterface {

    public $group;

    public function __construct(Group $group) {
        parent::__construct($group);

        $this->group = $group;
    }

    public function paginated($start, $length, $sortColumn, $sortDirection, $searchValue, $countOnly = false) {
        $query = $this->group->select('*');

        if (!empty($searchValue)) {
            $query->where(function($q) use ($searchValue) {
                $q->where('title', 'LIKE', "%$searchValue%");
                $q->where('description', 'LIKE', "%$searchValue%");
            });
        }

        if (!empty($sortColumn)) {
            $query->orderBy($sortColumn, $sortDirection);
        }

        $count = $query->count();

        if ($countOnly) {
            return $count;
        }

        $query->skip($start)->take($length);
        $groups = $query->get();
        $groups = $this->collectionModifier($groups);
        return $groups;
    }

    public function collectionModifier($groups)
    {
        return $groups->map(function($group) {
            $group->created_at_formated = $group->created_at->format('d M, Y');
            $group->status_formated = $group->status == 1 ? 'Active' : 'Inactive';
            $group->image_formated = $group->image_path ? (filter_var($group->image_path, FILTER_VALIDATE_URL) ? 
            '<img src="' . $group->image_path . '" width="150px" height="150px" />' : 
            '<img src="' . asset($group->image_path) . '" width="150px" height="150px" />') : null;
            $group->action = '<button class="btn btn-primary btn-sm" data-id="' . $group->id . '" data-toggle="modal" data-target="#edit-group" data-title="' . $group->title . '" data-description="' . $group->description . '" data-image_path="' . $group->image_path . '" data-status="' . $group->status . '">Edit</button> <button class="btn btn-danger btn-sm" data-id="' . $group->id . '">Delete</button>';
            return $group;
        });
    }

    public function allActive()
    {
        return $this->group->where('status', 1)->get();
    }

}
