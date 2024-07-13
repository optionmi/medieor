<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CommentRepository;

class CommentController extends Controller
{
    public $comment;

    public function __construct(CommentRepository $comment)
    {
        $this->comment = $comment;
    }

    public function index()
    {
        return view('admin.comments.index');
    }

    public function dataTable()
    {
        $data = $this->generateDataTableData($this->comment);
        return response()->json($data);
    }
}
