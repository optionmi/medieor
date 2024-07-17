<?php

namespace App\Repositories;

use App\Repositories\Contracts\TopicRepositoryInterface;
use App\Models\Topic;

class TopicRepository extends BaseRepository implements TopicRepositoryInterface
{

    public $topic;

    public function __construct(Topic $topic)
    {
        parent::__construct($topic);
        $this->topic = $topic;
    }

    public function paginated($start, $length, $sortColumn, $sortDirection, $searchValue, $countOnly = false)
    {
        $query = $this->topic->select('*');

        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->orWhere('name', 'LIKE', "%$searchValue%")
                    ->orWhereHas('category', function ($q) use ($searchValue) {
                        $q->where('title', 'LIKE', "%$searchValue%");
                    });
            });
        }

        if (!empty($sortColumn)) {
            switch (strtolower($sortColumn)) {
                case "#":
                    $sortColumn = 'id';
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
        $topics = $query->get();
        $topics = $this->collectionModifier($topics, $start);
        return $topics;
    }

    public function collectionModifier($topics, $start)
    {
        return $topics->map(function ($topic, $key) use ($start) {
            $topic->serial = $start + 1 + $key;
            $topic->category_title = $topic?->category?->title;
            $topic->actions = view('admin.topics.actions', compact('topic'))->render();
            $topic->setHidden(['category']);
            return $topic;
        });
    }
}
