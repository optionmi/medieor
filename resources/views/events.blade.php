@extends('layouts.app')
@section('scripts')
    @vite(['resources/js/events.js'])
@endsection

@section('content')
    @include('partials.header')

    <main class="min-h-[calc(100vh-6rem)] py-10 bg-gray-100">
        <div class="container mx-auto">
            <div class="sm:w-1/3 px-5 py-2 mx-auto skew-x-[-20deg] bg-primary">
                <h1 class="text-2xl  skew-x-[20deg] font-semibold text-center text-white">Events</h1>
            </div>

            <div class="flex flex-col flex-wrap items-start justify-around gap-10 p-5 py-10 sm:flex-row">
                @if (count($events) == 0)
                    <p class="text-center">No events found in this category.</p>
                @else
                    @foreach ($events as $event)
                        <div class="relative flex flex-col w-full my-5 h-[25rem] max-h-[60rem] sm:w-1/4 group/event">
                            <div class="flex items-center justify-center rounded-md shadow-md">
                                @if ($event->media->first()->media_type === 'video')
                                    <button class="min-h-[200px] h-80 bg-white rounded-md" type="button"
                                        data-twe-toggle="modal" data-twe-target="#videoModal" data-twe-ripple-init
                                        data-twe-ripple-color="dark"
                                        data-video-url="{{ asset('/videos/events/' . $event->media->first()->media_file) }}">
                                        <video class="w-full h-auto rounded-md"
                                            src="{{ asset('/videos/events/' . $event->media->first()->media_file) }}"></video>
                                    </button>
                                @else
                                    <button class="min-h-[200px] h-80 bg-white rounded-md" type="button"
                                        data-twe-toggle="modal" data-twe-target="#imageModal" data-twe-ripple-init
                                        data-twe-ripple-color="dark"
                                        data-image-url="{{ asset('/images/events/' . $event->media->first()->media_file) }}">
                                        <img src="{{ asset('/images/events/' . $event->media->first()->media_file) }}"
                                            alt="" class="w-full h-auto">
                                    </button>
                                @endif
                            </div>
                            <div
                                class="group/content absolute left-0 right-0 top-[calc(84%-1.5rem)] w-11/12 px-4 py-2 mx-auto transition-transform duration-300 ease-in-out transform translate-y-[-1.5rem] bg-white border border-gray-200 rounded-md group-hover/event:translate-y-[1px] z-10">
                                <div
                                    class="overflow-hidden transition-[max-height] duration-300 ease-in-out max-h-14 group-hover/content:max-h-[500px]">
                                    <h1 class="text-xl text-center">
                                        {{ $event->title }}
                                    </h1>
                                </div>
                                <div class="absolute rounded-md bottom-0 left-0 right-0 w-full bg-[#ffffffaa]">
                                    <button
                                        class="w-full h-5 py-1 mt-4 font-semibold text-center text-blue-500 bg-white rounded-md read-more-button group-hover/content:hidden">Read
                                        More</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </main>


    <!--Vertically centered modal-->
    <div data-twe-modal-init
        class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none bg-[#000000dd]"
        id="videoModal" tabindex="-1" aria-labelledby="videoModalTitle" aria-modal="true" role="dialog">
        <div data-twe-modal-dialog-ref
            class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
            <div
                class="relative flex flex-col w-full text-current border-none rounded-md outline-none pointer-events-auto bg-clip-padding shadow-4">

                <video id="modalVideo" src="" controls></video>
            </div>
        </div>
    </div>

    <!--Vertically centered modal-->
    <div data-twe-modal-init
        class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none bg-[#000000dd]"
        id="imageModal" tabindex="-1" aria-labelledby="imageModalTitle" aria-modal="true" role="dialog">
        <div data-twe-modal-dialog-ref
            class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
            <div
                class="relative flex flex-col w-full text-current border-none rounded-md outline-none pointer-events-auto bg-clip-padding shadow-4">
                <img id="modalImage" src="" alt="">
            </div>
        </div>
    </div>
    @include('partials.misc.footer')
@endsection
