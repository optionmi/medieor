<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CPCommentRepository;

class CPCommentController extends Controller
{
    public $cpcomment;

    public function __construct(CPCommentRepository $cpcomment)
    {
        $this->cpcomment = $cpcomment;
    }

    public function index()
    {
        return view('admin.cpcomments.index');
    }

    public function dataTable()
    {
        $data = $this->generateDataTableData($this->cpcomment);
        return response()->json($data);
    }
}
