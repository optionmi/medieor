<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\GroupRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Storage;

class GroupController extends Controller
{
    /**
     * @var GroupRepository
     */
    public $group;
     /**
     * @var CategoryRepository
     */
    public $category;
    /**
     * constructor for GroupController
     * 
     * @param GroupRepository $group
     *
     * @return void
     */
    public function __construct(GroupRepository $group, CategoryRepository $category)
    {
        $this->group = $group;
        $this->category = $category;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->category->findAll();
        return view('admin.groups.index', compact('categories'));
    }

    public function paginatedGroups()
    {
        $start = request()->get('start');
        $length = request()->get('length');
        $sortColumn = request()->get('order')[0]['column'];
        $sortDirection = request()->get('order')[0]['dir'];
        $searchValue = request()->get('search')['value'];

        $count = $this->group->paginated($start, $length, $sortColumn, $sortDirection, $searchValue, true);
        $groups = $this->group->paginated($start, $length, $sortColumn, $sortDirection, $searchValue);

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
        $id = request()->get('id');
        
        $mode = $id ? 'update' : 'save';

        $validator = validator()->make(request()->all(), [
            'title' => 'required|max:100',
            'description' => 'required|max:500',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20480',
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
            'status' => request()->get('status'),
        ];

        if ($request->hasFile('image_path')) {
            $randomString = \Illuminate\Support\Str::random(40);
            $extension = $request->file('image_path')->getClientOriginalExtension();
            $filename = $randomString . '.' . $extension;
            
            $path = $request->file('image_path')->storeAs('images', $filename, 'group_image');
            $data['image_path'] = 'group_image/'. $path;
        }
        

        $group = $this->group->store($data, $id);

        return response()->json(['error' => 0, 'message' => 'Group '.$mode.'d successfully']);
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
