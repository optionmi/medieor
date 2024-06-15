@extends('layouts.app')
@section('content')
    @include('partials.header')
    <div class="p-4 bg-gray-200 min-h-[calc(100vh-6rem)]">
        <div class="container mx-auto ">
            <div class="my-5">
                <h1 class="text-4xl font-bold">{{ $group->title }}</h1>
                <p class="my-5">{{ $group->description }}</p>
            </div>

            <div class="flex flex-col items-center gap-8 mb-10">
                <div class="w-full p-5 bg-white rounded-md shadow-md sm:w-1/2">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14"><img src="{{ asset('images/user_avatar/' . auth()->user()->img) }}"
                                alt="{{ auth()->user()->name }} image"></div>
                        <button data-modal-target="create-post-modal" data-modal-toggle="create-post-modal"
                            class="flex-1 py-4 pl-4 text-left text-gray-600 transition-colors bg-gray-100 rounded-full hover:bg-gray-200">Write
                            something...</button>
                    </div>
                </div>

                <div id="post-list" class="flex flex-col items-center w-full gap-5">
                    @foreach ($group->posts as $post)
                        <div class="w-full p-5 bg-white rounded-md shadow-md sm:w-1/2">
                            <div class="flex flex-col gap-4">
                                <div class="flex justify-between">
                                    <div class="flex items-center gap-5">
                                        <div class="w-12 h-12 bg-gray-400 rounded-full">
                                            <img src="{{ asset('images/user_avatar/' . $post->author->img) }}"
                                                alt="{{ $post->author->name }} image">
                                        </div>
                                        <div class="flex flex-col">
                                            <div>
                                                @if ($post->author)
                                                    <strong>{{ $post->author->name }}</strong>
                                                @else
                                                    <strong>Deleted User</strong>
                                                @endif
                                            </div>
                                            <div>
                                                <small>{{ $post->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-start">
                                        <button id="dropdownButton" data-dropdown-toggle="postDropdown{{ $post->id }}"
                                            class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5"
                                            type="button">
                                            <span class="sr-only">Open dropdown</span>
                                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="currentColor" viewBox="0 0 16 3">
                                                <path
                                                    d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                            </svg>
                                        </button>
                                        <!-- Dropdown menu -->
                                        <div id="postDropdown{{ $post->id }}"
                                            class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                            <ul class="py-2" aria-labelledby="dropdownButton">
                                                <li>
                                                    <button
                                                        class="block w-full px-4 py-2 text-sm text-gray-700 text-start hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                                        onclick="editDetailsForm()">
                                                        Edit Details
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                <div>
                                    <p class="my-5">{{ $post->content }}</p>
                                    @foreach ($post->media as $media)
                                        <div class="">
                                            <img src="{{ asset($media->path) }}" alt="">
                                        </div>
                                    @endforeach
                                </div>
                                <div>
                                    <div class="flex justify-between w-11/12 mx-auto">
                                        <small class="cursor-pointer hover:underline"><span
                                                id="like_count_{{ $post->id }}">{{ $post->likes->count() }}</span>
                                            likes</small>

                                        <button data-modal-target="comments-modal" data-post_id="{{ $post->id }}"
                                            data-comments-route="{{ route('web.post.comments') }}"
                                            data-modal-toggle="comments-modal" class="comment-list">
                                            <small class="cursor-pointer hover:underline"><span
                                                    id="comment_count_{{ $post->id }}">
                                                    {{ $post->comments_count }}</span> comments</small>
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center gap-5 py-1 border-t border-b">
                                        <div class="w-1/2 text-center">
                                            <button
                                                class="like-post hover:bg-[#00000033] w-full py-3 rounded-md transition-colors"
                                                data-post_id="{{ $post->id }}"
                                                data-route="{{ route('web.like.toggle') }}">
                                                @if ($post->user_has_liked)
                                                    <i class="fa-solid fa-thumbs-up"></i>
                                                    <span class="font-bold">Unlike</span>
                                                @else
                                                    <i class="fa-regular fa-thumbs-up"></i>
                                                    <span class="font-bold">Like</span>
                                                @endif
                                            </button>
                                        </div>
                                        <div class="w-1/2 text-center">
                                            <button
                                                class="create-comment-btn hover:bg-[#00000033] w-full py-3 rounded-md transition-colors"
                                                data-post_id="{{ $post->id }}" data-modal-target="create-comment-modal"
                                                data-modal-toggle="create-comment-modal">
                                                <i class="fa-regular fa-comment"></i>
                                                <span class="font-bold">Comment</span></button>
                                        </div>
                                    </div>
                                </div>

                                @if ($post->comments()->latest()->first())
                                    <div class="flex items-start gap-2">
                                        <img class="w-8 h-8 rounded-full"
                                            src="{{ asset('images/user_avatar/' . $post->comments()->latest()->first()->user->img) }}"
                                            alt="{{ $post->comments()->latest()->first()->user->name }} image">
                                        <div
                                            class="flex flex-col w-full leading-1.5 px-4 py-2 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
                                            <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                                @if ($post->comments()->latest()->first()->user)
                                                    <span
                                                        class="text-sm font-semibold text-gray-900 dark:text-white">{{ $post->comments()->latest()->first()->user->name }}</span>
                                                @else
                                                    <span
                                                        class="text-sm font-semibold text-gray-900 dark:text-white">Deleted
                                                        User</span>
                                                @endif
                                                <span
                                                    class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ $post->comments()->latest()->first()->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="py-2 text-sm font-normal text-gray-900 dark:text-white">
                                                {{ $post->comments()->latest()->first()->content }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
    <!-- Create Post modal -->
    <div id="create-post-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-screen bg-[#00000088]">
        <div class="relative w-full max-w-md max-h-full p-4">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Create Post
                    </h3>
                    <button type="button"
                        class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="create-post-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" method="POST" enctype="multipart/form-data"
                    action="{{ route('web.save.post', $group->id) }}">
                    @csrf
                    <input type="hidden" name="group_id" value="{{ $group->id }}">
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="col-span-2">
                            {{-- <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                                Description</label> --}}
                            <textarea id="description" rows="4" name="content"
                                class="block p-2.5 w-full text-sm  text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Write something..."></textarea>
                        </div>
                        <div class="col-span-2 sm:col-span-1">

                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="post_media">Upload Photo/Video</label>
                            <input name="post_media"
                                class="text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="user_avatar_help" id="post_media" type="file">

                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Post
                    </button>
                </form>
            </div>
        </div>
    </div>


    <!-- Create Comment modal -->
    <div id="create-comment-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-screen bg-[#00000088]">
        <div class="relative w-full max-w-md max-h-full p-4">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Comment
                    </h3>
                    <button type="button"
                        class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="create-comment-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" method="POST" action="{{ route('web.comment.save') }}"
                    enctype="multipart/form-data" id="comment-form">
                    @csrf
                    <input type="hidden" name="post_id" id="hidden_post_id">
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="col-span-2">
                            <textarea id="description" rows="4" name="content"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Write a comment..."></textarea>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Post
                    </button>
                </form>
            </div>
        </div>
    </div>


    <!-- Comments modal -->
    <div id="comments-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-screen bg-[#00000088]">
        <div class="relative w-full max-w-lg max-h-full p-4">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Comments
                    </h3>
                    <button type="button"
                        class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="comments-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5">
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="col-span-2">
                            <div id="popup-comment-list" class="flex flex-col gap-5">
                                <div class="flex items-start gap-2.5">
                                    <img class="w-8 h-8 rounded-full" src="{{ asset('img/no-avatar.png') }}"
                                        alt="Jese image">
                                    <div
                                        class="flex flex-col w-full max-w-[320px] leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
                                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                            <span class="text-sm font-semibold text-gray-900 dark:text-white">Bonni
                                                Green</span>
                                            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">11:46</span>
                                        </div>
                                        <p class="text-sm font-normal py-2.5 text-gray-900 dark:text-white">That's awesome.
                                            I
                                            think our users will really appreciate the improvements.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Post
                    </button> --}}
                </form>
            </div>
        </div>
    </div>
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/js/groupDetail.js'])
@endsection
