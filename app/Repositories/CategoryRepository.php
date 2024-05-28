<?php

namespace App\Repositories;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public $category;
    public function __construct(Category $category)
    {
        parent::__construct($category);

        $this->category = $category;
    }
    public function paginated($start, $length, $sortColumn, $sortDirection, $searchValue, $countOnly = false)
    {
        $query = $this->category->select('*');

        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->orWhere('title', 'LIKE', "%$searchValue%");
                $q->orWhere('description', 'LIKE', "%$searchValue%");
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
        $categories = $query->get();
        $categories = $this->collectionModifier($categories);
        return $categories;
    }

    public function collectionModifier($categories)
    {
        return $categories->map(function ($category, $key) {
            $category->serial = $key + 1;
            $category->logo = '<img class="logo-img" src="' . url($category->logo_image) . '" width="55"
            alt="' . $category->title . '">';
            $category->banner = '<img src="' . url($category->image) . '" width="100"
            alt="' . $category->title . '">';
            $category->actions = '<div class="d-flex">
                    <button
                        class="px-2 py-2 btn btn-link nav-link d-flex align-items-center edit-btn"
                        type="button" title="Edit" data-coreui-toggle="modal"
                        data-coreui-target="#categoryUpdate"
                        data-update-route="' . route('admin.categories.update', $category->id) . '"
                        data-row-data="' . htmlspecialchars(json_encode(array($category->title, $category->description))) . '">
                        <svg class="icon icon-lg text-primary">
                            <use
                                xlink:href="' . url('coreui/vendors/@coreui/icons/svg/free.svg#cil-pencil') . '">
                            </use>
                        </svg>
                    </button>
                    </div>';
            // <button class="px-2 py-2 btn btn-link nav-link d-flex align-items-center"
            //     type="button" title="Delete" data-coreui-toggle="modal"
            //     data-coreui-target="#deleteModal">
            //     <svg class="icon icon-lg text-danger">
            //         <use
            //             xlink:href="' . url('coreui/vendors/@coreui/icons/svg/free.svg#cil-trash') . '">
            //         </use>
            //     </svg>
            // </button>
            return $category;
        });
    }
}
