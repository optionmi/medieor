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
        $categories = $this->category->findAll();
        return view('admin.categories.index', compact('categories'));
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
        $validator = validator()->make(request()->all(), [
            'title' => 'required',
            'description' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'img_text' => 'required',
        ], [
            'title.required' => 'Title is required',
            'description.required' => 'Description is required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 1, 'message' => $validator->errors()->first()]);
        }

        $data = [
            'title' => request()->get('title'),
            'description' => request()->get('description'),
            'img_text' => request()->get('img_text'),
        ];

        if ($request->hasFile('logo')) {
            $randomString = \Illuminate\Support\Str::random(40);
            $extension = $request->file('logo')->getClientOriginalExtension();
            $filename = $randomString . '.' . $extension;

            $path = $request->file('logo')->storeAs('logo', $filename, 'category_images');
            $data['logo_image'] = 'category_images/' . $path;
        }

        if ($request->hasFile('image')) {
            $randomString = \Illuminate\Support\Str::random(40);
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = $randomString . '.' . $extension;

            $path = $request->file('image')->storeAs('banner', $filename, 'category_images');
            $data['image'] = 'category_images/' . $path;
        }


        $category = $this->category->store($data, $id);

        return response()->json(['error' => 0, 'message' => 'Category updated successfully']);
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

    public function datatable()
    {
        $start = request()->get('start');
        $length = request()->get('length');
        $sortColumn = request()->get('order')[0]['name'] ?? 'id';
        $sortDirection = request()->get('order')[0]['dir'] ?? 'asc';
        $searchValue = request()->get('search')['value'];

        $count = $this->category->paginated($start, $length, $sortColumn, $sortDirection, $searchValue, true);
        $categories = $this->category->paginated($start, $length, $sortColumn, $sortDirection, $searchValue);

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $categories
        );

        return response()->json($data);
    }
}
