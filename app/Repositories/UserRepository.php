<?php

namespace App\Repositories;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    public $user;

    public function __construct(User $user)
    {
        parent::__construct($user);
        $this->user = $user;
    }

    public function paginated($start, $length, $sortColumn, $sortDirection, $searchValue, $countOnly = false)
    {
        $query = $this->user->select('*');

        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->orWhere('name', 'LIKE', "%$searchValue%");
                $q->orWhere('email', 'LIKE', "%$searchValue%");
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
        $users = $query->get();
        $users = $this->collectionModifier($users, $start);
        return $users;
    }

    public static function collectionModifier($users, $start)
    {
        return $users->map(function ($user, $key) use ($start) {
            $user->serial = $start + 1 + $key;
            $user->categories_names = $user->categories->pluck('title')->implode('</br>');
            $user->country = $user->country_name;
            // <button
            //     class="px-2 py-2 btn btn-link nav-link d-flex align-items-center edit-btn"
            //     type="button" title="Edit" data-coreui-toggle="modal"
            //     data-coreui-target="#userUpdate"
            //     data-update-route="' . route('admin.users.update', $user->id) . '"
            //     data-row-data="' . htmlspecialchars(json_encode(array($user->name, $user->email))) . '">
            //     <svg class="icon icon-lg text-primary">
            //         <use
            //             xlink:href="' . url('coreui/vendors/@coreui/icons/svg/free.svg#cil-pencil') . '">
            //         </use>
            //     </svg>
            // </button>
            $user->actions = '<div class="d-flex">
                    <button class="px-2 py-2 btn btn-link nav-link d-flex align-items-center"
                    type="button" title="Delete" data-coreui-toggle="modal"
                    data-coreui-target="#deleteModal" data-delete-route="' . route('admin.users.destroy', $user->id) . '" >
                    <svg class="icon icon-lg text-danger">
                    <use
                    xlink:href="' . url('coreui/vendors/@coreui/icons/svg/free.svg#cil-trash') . '">
                    </use>
                    </svg>
                    </button>
                    </div>';
            return $user;
        });
    }
}
