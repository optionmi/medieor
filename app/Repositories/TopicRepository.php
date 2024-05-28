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
                $q->where('title', 'LIKE', "%$searchValue%");
                $q->where('description', 'LIKE', "%$searchValue%");
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
        $topics = $query->get();
        $topics = $this->collectionModifier($topics);
        return $topics;
    }

    public function collectionModifier($topics)
    {
        return $topics->map(function ($topic) {
            $topic->created_at_formated = $topic->created_at ? $topic->created_at->format('d M, Y') : null;
            $topic->status_formated = $topic->status == 1 ? 'Active' : 'Inactive';
            $topic->image_formated = $topic->image_path ? (filter_var($topic->image_path, FILTER_VALIDATE_URL) ?
                '<img src="' . $topic->image_path . '" width="150px" height="150px" />' :
                '<img src="' . asset($topic->image_path) . '" width="150px" height="150px" />') : null;
            $topic->action = '<button class="btn btn-primary btn-sm" data-id="' . $topic->id . '" data-toggle="modal" data-target="#edit-topic" data-title="' . $topic->title . '" data-body="' . $topic->body . '" data-category="' . $topic->category_id . '" data-image_path="' . $topic->image_path . '" data-status="' . $topic->status . '">Edit</button> <button class="btn btn-danger btn-sm" data-id="' . $topic->id . '">Delete</button>';
            return $topic;
        });
    }

    public function allActive()
    {
        return $this->topic->where('status', 1)->get();
    }
}
