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
        $data = new \stdClass();

        $data->today = $this->getCommentsCountByCategoryData(Carbon::today(), Carbon::today()->endOfDay());
        $data->month = $this->getCommentsCountByCategoryData(Carbon::today()->startOfMonth(), Carbon::today()->endOfMonth());
        $data->year = $this->getCommentsCountByCategoryData(Carbon::today()->startOfYear(), Carbon::today()->endOfYear());

        return $data;
    }

    // private function getCommentsCountByCategoryData(Carbon $startDate, Carbon $endDate)
    // {
    //     return DB::table('categories')
    //         ->leftJoin('groups', 'groups.category_id', '=', 'categories.id')
    //         ->leftJoin('posts', 'posts.group_id', '=', 'groups.id')
    //         ->leftJoin('comments', function ($join) use ($startDate, $endDate) {
    //             $join->on('comments.post_id', '=', 'posts.id')
    //                 ->whereBetween('comments.created_at', [$startDate, $endDate]);
    //         })
    //         ->select('categories.title', DB::raw('count(comments.id) as total'))
    //         ->groupBy('categories.title', 'categories.id')
    //         ->orderBy('categories.id')
    //         ->get();
    // }

    private function getCommentsCountByCategoryData(Carbon $startDate, Carbon $endDate)
    {
        $commentsQuery = DB::table('categories')
            ->leftJoin('groups', 'groups.category_id', '=', 'categories.id')
            ->leftJoin('posts', 'posts.group_id', '=', 'groups.id')
            ->leftJoin('comments', function ($join) use ($startDate, $endDate) {
                $join->on('comments.post_id', '=', 'posts.id')
                    ->whereBetween('comments.created_at', [$startDate, $endDate]);
            })
            ->select('categories.id', 'categories.title', DB::raw('count(comments.id) as comment_count'))
            ->groupBy('categories.id', 'categories.title');

        $cpCommentsQuery = DB::table('categories')
            ->leftJoin('category_posts', 'category_posts.category_id', '=', 'categories.id')
            ->leftJoin('c_p_comments', function ($join) use ($startDate, $endDate) {
                $join->on('c_p_comments.post_id', '=', 'category_posts.id')
                    ->whereBetween('c_p_comments.created_at', [$startDate, $endDate]);
            })
            ->select('categories.id', 'categories.title', DB::raw('count(c_p_comments.id) as cp_comment_count'))
            ->groupBy('categories.id', 'categories.title');

        $combinedQuery = DB::table(DB::raw("({$commentsQuery->toSql()}) as comments_query"))
            ->mergeBindings($commentsQuery)
            ->leftJoin(DB::raw("({$cpCommentsQuery->toSql()}) as cp_comments_query"), 'comments_query.id', '=', 'cp_comments_query.id')
            ->mergeBindings($cpCommentsQuery)
            ->select(
                'comments_query.id',
                'comments_query.title',
                DB::raw('COALESCE(comments_query.comment_count, 0) + COALESCE(cp_comments_query.cp_comment_count, 0) as total_comments')
            )
            ->orderBy('comments_query.id')
            ->get();

        return $combinedQuery;
    }


    public function paginated($start, $length, $sortColumn, $sortDirection, $searchValue, $countOnly = false)
    {
        $query = $this->comment->select('*');

        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->orWhere('content', 'LIKE', "%$searchValue%")
                    ->orWhereHas('author', function ($q) use ($searchValue) {
                        $q->where('name', 'LIKE', "%$searchValue%");
                    })
                    ->orWhereHas('post', function ($q) use ($searchValue) {
                        $q->whereHas('group', function ($q) use ($searchValue) {
                            $q->where('title', 'LIKE', "%$searchValue%");
                        });
                    });
            });
        }

        if (!empty($sortColumn)) {
            switch (strtolower($sortColumn)) {
                case "#":
                    $sortColumn = 'created_at';
                    $sortDirection = 'DESC';
                    break;
                case "name":
                    $sortColumn = 'user_id';
                    break;
                case "group":
                    $sortColumn = 'groups.title';
                    break;
                case "comment":
                    $sortColumn = 'content';
                    break;
                default:
                    $sortColumn = strtolower($sortColumn);
                    break;
            }

            if ($sortColumn == 'groups.title') {
                $query->join('posts', 'posts.id', '=', 'comments.post_id')
                    ->join('groups', 'groups.id', '=', 'posts.group_id');
            }

            $query->orderBy($sortColumn, $sortDirection);
        }

        $count = $query->count();

        if ($countOnly) {
            return $count;
        }

        $query->skip($start)->take($length);
        $comments = $query->get();
        $comments = $this->collectionModifier($comments, $start);
        return $comments;
    }

    public function collectionModifier($comments, $start)
    {
        return $comments->map(function ($comment, $key) use ($start) {
            $comment->serial = $start + 1 + $key;
            $comment->name = $comment?->author?->name;
            $comment->group_title = $comment?->post?->group?->title;
            $comment->comment = $comment->content;
            $comment->setHidden(['content', 'author', 'post']);
            $comment->actions = view('admin.comments.actions', compact('comment'))->render();
            return $comment;
        });
    }
}
