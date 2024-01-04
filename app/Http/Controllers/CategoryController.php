<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use App\Repositories\GroupRepository;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepository
     */
    public $category;
    /**
     * @var GroupRepository
     */
    public $group;
    /**
     * constructor for GroupController
     * 
     * @param GroupRepository $group
     *
     * @return void
     */
    public function __construct(CategoryRepository $category, GroupRepository $group)
    {
        $this->category = $category;
        $this->group = $group;
    }

    public function index()
    {
        $groups = $this->group->allActive();
        return view('groups', compact('groups'));
    }

    public function detail($id)
    {
        $category = $this->category->find($id);
        
        return view('category', compact('category'));
    }
}