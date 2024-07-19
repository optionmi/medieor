<?php

namespace App\Repositories;

use App\Repositories\Contracts\EventRepositoryInterface;
use App\Models\Event;

class EventRepository extends BaseRepository implements EventRepositoryInterface
{

    public $event;

    public function __construct(Event $event)
    {
        parent::__construct($event);
        $this->event = $event;
    }

    public function paginated($start, $length, $sortColumn, $sortDirection, $searchValue, $countOnly = false)
    {
        $query = $this->event->select('*');

        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->orWhere('title', 'LIKE', "%$searchValue%")
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
        $events = $query->get();
        $events = $this->collectionModifier($events, $start);
        return $events;
    }

    public function collectionModifier($events, $start)
    {
        return $events->map(function ($event, $key) use ($start) {
            $event->serial = $start + 1 + $key;
            $event->category_title = $event?->category?->title;
            $event->media_file = view('admin.events.media', compact('event'))->render();
            $event->actions = view('admin.events.actions', compact('event'))->render();
            $event->setHidden(['category']);
            return $event;
        });
    }
}
