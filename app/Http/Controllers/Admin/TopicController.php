<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Repositories\TopicRepository;
use App\Repositories\CategoryRepository;

class TopicController extends Controller
{
    public $category;
    public $topic;
    /**
     * constructor for TopicController
     * 
     * @param TopicRepository $topic
     *
     * @return void
     */
    public function __construct(TopicRepository $topic, CategoryRepository $category)
    {
        $this->topic = $topic;
        $this->category = $category;
    }

    public function index()
    {
        $topics = $this->topic->findAll();
        $categories = $this->category->findAll();
        return view('admin.topics.index', compact('topics', 'categories'));
    }

    public function paginatedGroups()
    {
        $start = request()->get('start');
        $length = request()->get('length');
        $sortColumn = request()->get('order')[0]['name'] ?? 'id';
        $sortDirection = request()->get('order')[0]['dir'] ?? 'asc';
        $searchValue = request()->get('search')['value'];

        $count = $this->topic->paginated($start, $length, $sortColumn, $sortDirection, $searchValue, true);
        $topics = $this->topic->paginated($start, $length, $sortColumn, $sortDirection, $searchValue);

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $topics
        );

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $id = request()->get('id');

        $mode = $id ? 'update' : 'save';

        $validator = validator()->make(request()->all(), [
            'title' => 'required|max:100',
            'body' => 'required|max:500',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20480',
        ], [
            'title.required' => 'Title is required',
            'body.required' => 'Description is required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 1, 'message' => $validator->errors()->first()]);
        }

        $data = [
            'title' => request()->get('title'),
            'body' => request()->get('body'),
            'user_id' => auth()->user()->id,
            'category_id' => request()->get('category_id'),
            'status' => request()->get('status'),
        ];

        $topic = $this->topic->store($data, $id);

        return response()->json(['error' => 0, 'message' => 'Topic ' . $mode . 'd successfully']);
    }
}
