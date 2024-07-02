<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Repositories\EventRepository;

class EventController extends Controller
{
    public $event;

    public function __construct(EventRepository $eventRepository)
    {
        $this->event = $eventRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.events.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'category' => 'required',
            'video' => 'mimes:mp4',
        ]);

        $data = [
            'title' => $request->input('title'),
            'category_id' => $request->input('category'),
        ];

        if ($request->hasFile('video')) {
            $filename = $this->uploadFile($request->file('video'), 'videos/events');
            $data['media'] = $filename;
        }
        $event = $this->event->store($data, $request->input('id'));

        return $this->jsonResponse((bool)$event, 'Event ' . ($request->input('id') ? 'updated' : 'created') . ' successfully');
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
    public function destroy(Request $request, Event $event)
    {
        $eventDeletion = $event->delete();
        return $this->jsonResponse((bool)$eventDeletion, 'Event deleted successfully');
    }

    public function dataTable()
    {
        $data = $this->generateDataTableData($this->event);
        return response()->json($data);
    }
}
