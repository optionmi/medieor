<?php

namespace App\Repositories;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Models\User;
use PeterColes\Countries\CountriesFacade as Countries;


// class UserRepository extends BaseRepository implements UserRepositoryInterface
// {

//     public $user;

//     public function __construct(User $user)
//     {
//         parent::__construct($user);
//         $this->user = $user;
//     }

//     public function paginated($start, $length, $sortColumn, $sortDirection, $searchValue, $countOnly = false, $role = null)
//     {
//         $query = $this->user->select('*');

//         // Filter by role if a role is provided
//         if (!empty($role)) {
//             $query->whereHas('roles', function ($q) use ($role) {
//                 $q->where('name', $role);
//             });
//         }

//         if (!empty($searchValue)) {
//             $countryCodes = Countries::lookup()->filter(function ($countryName, $countryCode) use ($searchValue) {
//                 return stripos($countryName, $searchValue) !== false;
//             })->keys();
//             $query->where(function ($q) use ($searchValue, $countryCodes) {
//                 $q->orWhere('name', 'LIKE', "%$searchValue%");
//                 $q->orWhere('email', 'LIKE', "%$searchValue%");
//                 $q->orWhere('phone', 'LIKE', "%$searchValue%");
//                 $q->orWhere('country', 'LIKE', "%$searchValue%");
//                 foreach ($countryCodes as $countryCode) {
//                     $q->orWhere('country', 'LIKE', "%$countryCode%");
//                 };
//                 $q->orWhereHas('categories', function ($q) use ($searchValue) {
//                     $q->where('title', 'LIKE', "%$searchValue%");
//                 });
//             });
//         }

//         if (!empty($sortColumn)) {
//             $sortColumn = strtolower($sortColumn) === '#' ? 'id' : strtolower($sortColumn);
//             $query->orderBy($sortColumn, $sortDirection);
//         }

//         $count = $query->count();

//         if ($countOnly) {
//             return $count;
//         }

//         $query->skip($start)->take($length);
//         $users = $query->get();
//         $users = $this->collectionModifier($users, $start);
//         return $users;
//     }

//     public static function collectionModifier($users, $start)
//     {
//         return $users->map(function ($user, $key) use ($start) {
//             $user->serial = $start + 1 + $key;
//             $user->categories_names = $user->categories->pluck('title')->implode('</br>');
//             $user->country = $user->country_name;
//             $user->actions = view('admin.users.actions', compact('user'))->render();
//             $user->setHidden(['categories']);
//             return $user;
//         });
//     }
// }

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public $user;

    public function __construct(User $user)
    {
        parent::__construct($user);
        $this->user = $user;
    }

    public function paginated($start, $length, $sortColumn, $sortDirection, $searchValue, $countOnly = false, $role = null)
    {
        $query = $this->user->select('*');

        // Filter by role if a role is provided
        if (!empty($role)) {
            $query->whereHas('roles', function ($q) use ($role) {
                $q->where('name', 'LIKE', "$role");
            });
        } else {
            $query->whereHas('roles', function ($q) use ($role) {
                $q->where('name', 'LIKE', "user");
            });
        }

        // Search logic
        if (!empty($searchValue)) {
            $countryCodes = Countries::lookup()->filter(function ($countryName, $countryCode) use ($searchValue) {
                return stripos($countryName, $searchValue) !== false;
            })->keys();
            $query->where(function ($q) use ($searchValue, $countryCodes) {
                $q->orWhere('name', 'LIKE', "%$searchValue%");
                $q->orWhere('email', 'LIKE', "%$searchValue%");
                $q->orWhere('phone', 'LIKE', "%$searchValue%");
                $q->orWhere('country', 'LIKE', "%$searchValue%");
                foreach ($countryCodes as $countryCode) {
                    $q->orWhere('country', 'LIKE', "%$countryCode%");
                }
                $q->orWhereHas('categories', function ($q) use ($searchValue) {
                    $q->where('title', 'LIKE', "%$searchValue%");
                });
            });
        }

        // Sorting logic
        if (!empty($sortColumn)) {
            $sortColumn = strtolower($sortColumn) === '#' ? 'id' : strtolower($sortColumn);
            $sortDirection = strtolower($sortDirection) === 'asc' && strtolower($sortColumn) === 'id' ? 'DESC' : 'ASC';
            $query->orderBy($sortColumn, $sortDirection);
        }

        // Count
        $count = $query->count();

        if ($countOnly) {
            return $count;
        }

        // Pagination
        $query->skip($start)->take($length);
        $users = $query->get();
        $users = $this->collectionModifier($users, $start, $role);

        return $users;
    }

    public static function collectionModifier($users, $start, $role)
    {
        return $users->map(function ($user, $key) use ($start, $role) {
            $user->serial = $start + 1 + $key;
            $user->categories_names = $user->categories->pluck('title')->implode('</br>');
            $user->country = $user->country_name;
            switch ($role) {
                case 'superadmin':
                    // $user->actions = view('superadmin.superadmins.actions', compact('user'))->render();
                    break;
                case 'admin':
                    $user->actions = view('superadmin.admins.actions', compact('user'))->render();
                    break;
                case 'user':
                    $user->actions = view('superadmin.users.actions', compact('user'))->render();
                    break;
                default:
                    $user->actions = view('admin.users.actions', compact('user'))->render();
                    break;
            }
            $user->setHidden(['categories']);
            return $user;
        });
    }
}
