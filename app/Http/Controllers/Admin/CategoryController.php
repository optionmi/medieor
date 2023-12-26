<?php

namespace App\Http\Controllers\Admin;

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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Display a group listing page with all categories.
     * 
     */
    public function groupsByCategory()
    {
        $categories = $this->category->findAll();
        return view('admin.categories.groups', compact('categories'));
    }

    public function groupsByCategoryId()
    {
        $category_id = request()->get('category');
        $category = $this->category->find($category_id);
        $groups = $category->groups;
        $groups = $this->group->collectionModifier($groups);

        $count = $groups->count();

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $groups
        );

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
