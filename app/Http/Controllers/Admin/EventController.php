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
            'media_file' => 'file|mimes:jpeg,png,jpg,gif,mp4,mov,ogg',
        ]);



        $data = [
            'title' => $request->input('title'),
            'category_id' => $request->input('category'),
        ];

        if ($request->hasFile('media_file')) {
            // Determine the media type
            $mediaType = $request->file('media_file')->getMimeType();
            $isImage = str_starts_with($mediaType, 'image/');
            $isVideo = str_starts_with($mediaType, 'video/');

            // Set media type accordingly
            if ($isImage) {
                $mediaType = 'image';
            } elseif ($isVideo) {
                $mediaType = 'video';
            } else {
                return back()->withErrors(['media_file' => 'The uploaded file must be an image or video.']);
            }

            if ($mediaType === 'video') $filename = $this->uploadFile($request->file('media_file'), 'videos/events');
            if ($mediaType === 'image') $filename = $this->uploadFile($request->file('media_file'), 'images/events');

            $event = $this->event->store($data, $request->input('id'));
            $event->media()->create(['media_file' => $filename, 'media_type' => $mediaType]);
        } else {
            $event = $this->event->store($data, $request->input('id'));
        }

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
