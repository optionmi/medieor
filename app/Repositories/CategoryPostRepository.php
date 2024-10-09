<?php

namespace App\Repositories;

use App\Repositories\Contracts\CategoryPostRepositoryInterface;
use App\Models\CategoryPost;

class CategoryPostRepository extends BaseRepository implements CategoryPostRepositoryInterface
{

    public $category_post;

    public function __construct(CategoryPost $category_post)
    {
        parent::__construct($category_post);

        $this->category_post = $category_post;
    }

    public function paginated($start, $length, $sortColumn, $sortDirection, $searchValue, $countOnly = false)
    {
        $query = $this->category_post->select('*');

        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->orWhere('title', 'LIKE', "%$searchValue%")
                    ->orWhere('body', 'LIKE', "%$searchValue%")
                    ->orWhereHas('category', function ($q) use ($searchValue) {
                        $q->where('title', 'LIKE', "%$searchValue%");
                    })
                    ->orWhereHas('topic', function ($q) use ($searchValue) {
                        $q->where('name', 'LIKE', "%$searchValue%");
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
                case "topic":
                    $sortColumn = 'topic_id';
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
        $category_posts = $query->get();
        $category_posts = $this->collectionModifier($category_posts, $start);
        return $category_posts;
    }

    public function collectionModifier($category_posts, $start)
    {
        return $category_posts->map(function ($category_post, $key) use ($start) {
            $category_post->serial = $start + 1 + $key;
            $category_post->category_title = $category_post?->category?->title;
            $category_post->topic_name = $category_post?->topic?->name;
            $category_post->actions = view('admin.category-posts.actions', compact('category_post'))->render();
            $category_post->setHidden(['category', 'topic']);
            return $category_post;
        });
    }

    public function allActive()
    {
        return $this->category_post->where('status', 1)->get();
    }
}
