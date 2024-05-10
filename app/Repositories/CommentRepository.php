<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\CommentRepositoryInterface;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{

    public $comment;

    public function __construct(Comment $comment)
    {
        parent::__construct($comment);
        $this->comment = $comment;
    }

    public function getCommentsCountByCategory()
    {
        $today = Carbon::today();

        return DB::table('categories')
            ->leftJoin('groups', 'groups.category_id', '=', 'categories.id')
            ->leftJoin('posts', 'posts.group_id', '=', 'groups.id')
            ->leftJoin('comments', function ($join) use ($today) {
                $join->on('comments.post_id', '=', 'posts.id')
                    ->whereDate('comments.created_at', $today);
            })
            ->select('categories.title', DB::raw('count(comments.id) as total'))
            ->groupBy('categories.title', 'categories.id')
            ->orderBy('categories.id', 'asc')
            ->get();
    }
}
