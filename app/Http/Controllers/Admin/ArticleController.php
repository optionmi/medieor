<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ArticleRepository;

class ArticleController extends Controller
{
    public $article;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->article = $articleRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.articles.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'category' => 'required',
            'media_file' => 'file|mimes:jpeg,png,jpg', //,gif,mp4,mov,ogg',
        ]);

        $data = [
            'title' => $request->input('title'),
            'category_id' => $request->input('category'),
            'content' => $request->input('content'),
        ];

        if ($request->hasFile('media_file')) {
            $filename = $this->uploadFile($request->file('media_file'), 'images/articles');
            $data['media'] = $filename;
        }


        $article = $this->article->store($data, $request->input('id'));

        return $this->jsonResponse((bool)$article, 'Article ' . ($request->input('id') ? 'updated' : 'created') . ' successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Article $article)
    {
        $articleDeletion = $article->delete();
        return $this->jsonResponse((bool)$articleDeletion, 'Article deleted successfully');
    }

    public function dataTable()
    {
        $data = $this->generateDataTableData($this->article);
        return response()->json($data);
    }
}
