<?php

namespace App\Repositories;

use App\Models\Donation;
use App\Repositories\Contracts\DonationRepositoryInterface;

class DonationRepository extends BaseRepository implements DonationRepositoryInterface
{

    public $donation;

    public function __construct(Donation $donation)
    {
        parent::__construct($donation);
        $this->donation = $donation;
    }

    public function paginated($start, $length, $sortColumn, $sortDirection, $searchValue, $countOnly = false)
    {
        $query = $this->donation->select('*');

        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->where('name', 'LIKE', "%$searchValue%")
                    ->orWhere('email', 'LIKE', "%$searchValue%")
                    ->orWhere('country', 'LIKE', "%$searchValue%")
                    ->orWhere('action', 'LIKE', "%$searchValue%")
                    ->orWhereHas('user', function ($q) use ($searchValue) {
                        $q->where('name', 'LIKE', "%$searchValue%")
                            ->orWhere('email', 'LIKE', "%$searchValue%")
                            ->orWhere('country', 'LIKE', "%$searchValue%")
                            ->orWhere('action', 'LIKE', "%$searchValue%");
                    })
                    ->orWhereHas('category', function ($q) use ($searchValue) {
                        $q->where('title', 'LIKE', "%$searchValue%");
                    });
            });
        }

        if (!empty($sortColumn)) {
            switch (strtolower($sortColumn)) {
                case "#":
                    $sortColumn = 'id';
                    $sortDirection = strtolower($sortDirection) === 'asc' && strtolower($sortColumn) === 'id' ? 'DESC' : 'ASC';
                    break;
                case "category":
                    $sortColumn = 'category_id';
                    break;
                default:
                    $sortColumn = strtolower($sortColumn);
                    break;
            }
            $query->orderBy($sortColumn, $sortDirection);
        }

        $count = $query->count();

        if ($countOnly) {
            return $count;
        }

        $query->skip($start)->take($length);
        $donations = $query->get();
        $donations = $this->collectionModifier($donations, $start);
        return $donations;
    }

    public function collectionModifier($donations, $start)
    {
        return $donations->map(function ($donation, $key) use ($start) {
            $donation->serial = $start + 1 + $key;
            if ($donation->user_id) {
                $donation->name = $donation->user->name;
                $donation->email = $donation->user->email;
                $donation->country = $donation->user->country_name;
                $donation->phone = $donation->user->phone;
            } else {
                $donation->country = $donation->country_name;
            }
            $donation->category_title = $donation->category->title;
            $donation->setHidden(['category', 'user']);
            return $donation;
        });
    }
}
