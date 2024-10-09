<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Contracts\GroupPostRepositoryInterface;

class GroupPostRepository extends BaseRepository implements GroupPostRepositoryInterface
{

    public $post;

    public function __construct(Post $post)
    {
        parent::__construct($post);
        $this->post = $post;
    }


    public function paginated($start, $length, $sortColumn, $sortDirection, $searchValue, $countOnly = false)
    {
        $query = $this->post->select('*');

        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->orWhere('content', 'LIKE', "%$searchValue%")
                    ->orWhereHas('author', function ($q) use ($searchValue) {
                        $q->where('name', 'LIKE', "%$searchValue%");
                    })
                    ->orWhereHas('group', function ($q) use ($searchValue) {
                        $q->where('title', 'LIKE', "%$searchValue%")
                            ->orWhereHas('category', function ($q) use ($searchValue) {
                                $q->where('title', 'LIKE', "%$searchValue%");
                            });
                    });
            });
        }

        if (!empty($sortColumn)) {
            switch (strtolower($sortColumn)) {
                case "#":
                    $sortColumn = 'id';
                    $sortDirection = strtolower($sortDirection) === 'asc' && strtolower($sortColumn) === 'id' ? 'DESC' : 'ASC';
                    break;
                case "name":
                    $sortColumn = 'user_id';
                    break;
                case "category":
                    $sortColumn = 'categories.title';
                    break;
                case "group":
                    $sortColumn = 'groups.title';
                    break;
                default:
                    $sortColumn = strtolower($sortColumn);
                    break;
            }
            if ($sortColumn == 'categories.title') {
                $query->join('groups', 'groups.id', '=', 'posts.group_id')
                    ->join('categories', 'categories.id', '=', 'groups.category_id');
            }

            if ($sortColumn == 'groups.title') {
                $query->join('groups', 'groups.id', '=', 'posts.group_id');
            }

            $query->orderBy($sortColumn, $sortDirection);
        }

        $count = $query->count();

        if ($countOnly) {
            return $count;
        }

        $query->skip($start)->take($length);
        $posts = $query->get();
        $posts = $this->collectionModifier($posts, $start);
        return $posts;
    }

    public function collectionModifier($posts, $start)
    {
        return $posts->map(function ($post, $key) use ($start) {
            $post->serial = $start + 1 + $key;
            $post->name = $post?->author?->name;
            $post->category_title = $post?->group?->category?->title;
            $post->group_title = $post?->group?->title;
            $post->actions = view('admin.group-posts.actions', compact('post'))->render();
            $post->setHidden(['author', 'group']);
            return $post;
        });
    }
}
