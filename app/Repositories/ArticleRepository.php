<?php

namespace App\Repositories;

use App\Repositories\Contracts\ArticleRepositoryInterface;
use App\Models\Article;

class ArticleRepository extends BaseRepository implements ArticleRepositoryInterface
{

    public $article;

    public function __construct(Article $article)
    {
        parent::__construct($article);
        $this->article = $article;
    }

    public function paginated($start, $length, $sortColumn, $sortDirection, $searchValue, $countOnly = false)
    {
        $query = $this->article->select('*');

        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->orWhere('title', 'LIKE', "%$searchValue%")
                    ->orWhere('content', 'LIKE', "%$searchValue%")
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
        $articles = $query->get();
        $articles = $this->collectionModifier($articles, $start);
        return $articles;
    }

    public function collectionModifier($articles, $start)
    {
        return $articles->map(function ($article, $key) use ($start) {
            $article->serial = $start + 1 + $key;
            $article->category_title = $article?->category?->title;
            $article->media_file = view('admin.articles.media', compact('article'))->render();
            $article->actions = view('admin.articles.actions', compact('article'))->render();
            $article->setHidden(['category']);
            return $article;
        });
    }
}
