<?php

namespace App\Http\Controllers\Admin;

use App\Models\Topic;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TopicRepository;

class TopicController extends Controller
{
    public $topic;
    public function __construct(TopicRepository $topic)
    {
        $this->topic = $topic;
    }

    public function index()
    {
        $categories = Category::all();
        return view('admin.topics.index', compact('categories'));
    }

    public function dataTable()
    {
        $data = $this->generateDataTableData($this->topic);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
        ]);

        $data = [
            'name' => $request->input('name'),
            'category_id' => $request->input('category'),
        ];

        $id = $request->input('id');
        $isStored = (bool) $this->topic->store($data, $id);

        $message = $id ? 'Category Topic updated Successfully' : 'Category Topic created Successfully';

        return $this->jsonResponse($isStored, $message);
    }

    public function destroy(Request $request, Topic $topic)
    {
        $isDeleted = (bool)$topic->delete();
        return $this->jsonResponse($isDeleted, 'Category Topic deleted successfully');
    }
}
