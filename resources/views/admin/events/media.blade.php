@if ($event->media->first()->media_type === 'image')
    <img src="{{ asset('images/events/' . $event->media->first()->media_file) }}" alt="" width="100%">
@else
    <video src="{{ asset('videos/events/' . $event->media->first()->media_file) }}" controls width="100%">
        Your browser does not support the video tag.
    </video>
@endif
