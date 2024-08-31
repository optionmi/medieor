@extends('layouts.app')
@section('scripts')
    @vite(['resources/js/events.js'])
@endsection

@section('content')
    @include('partials.header')

    <main class="min-h-[calc(100vh-6rem)] py-10 bg-gray-100">
        <div class="container mx-auto">
            <div class="sm:w-1/3 px-5 py-2 mx-auto skew-x-[-20deg] bg-primary">
                <h1 class="text-2xl  skew-x-[20deg] font-semibold text-center text-white">Articles</h1>
            </div>

            <div class="flex flex-col flex-wrap items-start justify-around gap-10 p-5 py-10 sm:flex-row">
                @if (count($articles) == 0)
                    <p class="text-center">No articles found in this category.</p>
                @else
                    @foreach ($articles as $article)
                        <div class="relative flex flex-col w-full my-5 sm:w-1/4 group">
                            <div class="flex items-center justify-center rounded-md shadow-md">
                                <button class="min-h-[200px]" type="button" data-twe-toggle="modal"
                                    data-twe-target="#imageModal" data-twe-ripple-init data-twe-ripple-color="dark"
                                    data-image-url="{{ asset('/images/articles/' . $article->media) }}">
                                    <img src="{{ asset('/images/articles/' . $article->media) }}" alt="">
                                </button>
                            </div>
                            <div
                                class="absolute bottom-[-1.5rem] mx-auto left-0 right-0 w-11/12 px-4 py-2 bg-white border-2 border-gray-500 rounded-md transition-all duration-300 ease-in-out group-hover:bottom-[-3.5rem]">
                                <h1 class="text-xl text-center">
                                    {{ $article->title }}
                                </h1>
                                <div class="py-2">
                                    {!! $article->content !!}
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
            class="pointer-articles-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
            <div
                class="relative flex flex-col w-full text-current border-none rounded-md outline-none pointer-articles-auto bg-clip-padding shadow-4">
                <img id="modalImage" src="" alt="">
            </div>
        </div>
    </div>
    @include('partials.misc.footer')
@endsection
