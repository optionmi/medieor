<?php

namespace App\Repositories;

use App\Repositories\Contracts\CPCommentRepositoryInterface;
use App\Models\CPComment;

class CPCommentRepository extends BaseRepository implements CPCommentRepositoryInterface
{

    public $cpcomment;

    public function __construct(CPComment $cpcomment)
    {
        parent::__construct($cpcomment);
        $this->cpcomment = $cpcomment;
    }

    public function paginated($start, $length, $sortColumn, $sortDirection, $searchValue, $countOnly = false)
    {
        $query = $this->cpcomment->select('*');

        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->orWhere('content', 'LIKE', "%$searchValue%")
                    ->orWhereHas('author', function ($q) use ($searchValue) {
                        $q->where('name', 'LIKE', "%$searchValue%");
                    })
                    ->orWhereHas('post', function ($q) use ($searchValue) {
                        $q->whereHas('category', function ($q) use ($searchValue) {
                            $q->where('title', 'LIKE', "%$searchValue%");
                        });
                    });
            });
        }

        if (!empty($sortColumn)) {
            switch (strtolower($sortColumn)) {
                case "#":
                    $sortColumn = 'id';
                    break;
                case "name":
                    $sortColumn = 'user_id';
                    break;
                case "category":
                    $sortColumn = 'categories.title';
                    break;
                case "comment":
                    $sortColumn = 'content';
                    break;
                default:
                    $sortColumn = strtolower($sortColumn);
                    break;
            }

            if ($sortColumn == 'categories.title') {
                $query->join('category_posts', 'category_posts.id', '=', 'c_p_comments.post_id')
                    ->join('categories', 'categories.id', '=', 'category_posts.category_id');
            }

            $query->orderBy($sortColumn, $sortDirection);
        }

        $count = $query->count();

        if ($countOnly) {
            return $count;
        }

        $query->skip($start)->take($length);
        $topics = $query->get();
        $topics = $this->collectionModifier($topics, $start);
        return $topics;
    }

    public function collectionModifier($topics, $start)
    {
        return $topics->map(function ($cpcomment, $key) use ($start) {
            $cpcomment->serial = $start + 1 + $key;
            $cpcomment->category_title = $cpcomment->post->category->title;
            $cpcomment->name = $cpcomment?->author?->name;
            $cpcomment->comment = $cpcomment->content;
            $cpcomment->setHidden(['content', 'author', 'post']);
            $cpcomment->actions = view('admin.cpcomments.actions', compact('cpcomment'))->render();
            return $cpcomment;
        });
    }
}
