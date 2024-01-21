@extends('layouts.app')
@section('content')
    @include('partials.header')
    <div class="p-4 bg-gray-200">
        <div class="container mx-auto ">
            <div class="my-5">
                <h1 class="text-4xl font-bold">{{ $group->title }}</h1>
                <p class="my-5">{{ $group->description }}</p>
            </div>

            <div class="flex flex-col items-center gap-8 mb-10">
                <div class="p-5 bg-white rounded-md shadow-md sm:w-1/2">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14"><img src="{{ asset('img/no-avatar.png') }}" alt=""></div>
                        <button data-modal-target="create-post-modal" data-modal-toggle="create-post-modal"
                            class="flex-1 py-4 pl-4 text-left text-gray-600 transition-colors bg-gray-100 rounded-full hover:bg-gray-200">Write
                            something...</button>
                    </div>
                </div>
                @foreach (array_map(function ($i) {
            return (object) ['id' => $i, 'title' => "Post Title $i", 'content' => "This is the content for post $i", 'author' => "Author $i", 'date' => date('Y-m-d H:i:s')];
        }, range(1, 10)) as $post)
                    <div class="p-5 bg-white rounded-md shadow-md sm:w-1/2">
                        <div class="flex flex-col gap-4">
                            <div class="flex items-center gap-5">
                                <div class="w-12 h-12 bg-gray-400 rounded-full">
                                    <img src="{{ asset('img/no-avatar.png') }}" alt="">
                                </div>
                                <div class="flex flex-col">
                                    <div>
                                        <strong>{{ $post->author }}</strong>
                                    </div>
                                    <div>
                                        <small>2 days ago</small>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p class="my-5">{{ $post->content }}</p>
                                <div class="">
                                    <img src="{{ asset('img/space.jpg') }}" alt="">
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between w-11/12 mx-auto">
                                    <small class="cursor-pointer hover:underline">100 likes</small>
                                    <button data-modal-target="comments-modal" data-modal-toggle="comments-modal"><small
                                            class="cursor-pointer hover:underline">100 comments</small></button>
                                </div>
                            </div>
                            <div>
                                <div class="flex items-center gap-5 py-1 border-t border-b">
                                    <div class="w-1/2 text-center">
                                        <button class="hover:bg-[#00000033] w-full py-3 rounded-md transition-colors">
                                            <i class="fa-regular fa-thumbs-up"></i>
                                            <span class="font-bold">Like</span></button>
                                    </div>
                                    <div class="w-1/2 text-center">
                                        <button class="hover:bg-[#00000033] w-full py-3 rounded-md transition-colors"
                                            data-modal-target="create-comment-modal"
                                            data-modal-toggle="create-comment-modal">
                                            <i class="fa-regular fa-comment"></i>
                                            <span class="font-bold">Comment</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
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
                <form class="p-4 md:p-5">
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="col-span-2">
                            {{-- <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                                Description</label> --}}
                            <textarea id="description" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Write something..."></textarea>
                        </div>
                        <div class="col-span-2 sm:col-span-1">

                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="post_media">Upload Photo/Video</label>
                            <input
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
                <form class="p-4 md:p-5">
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="col-span-2">
                            <textarea id="description" rows="4"
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
        <div class="relative w-full max-w-md max-h-full p-4">
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

                            <div class="flex items-start gap-2.5">
                                <img class="w-8 h-8 rounded-full" src="{{ asset('img/no-avatar.png') }}"
                                    alt="Jese image">
                                <div
                                    class="flex flex-col w-full max-w-[320px] leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
                                    <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                        <span class="text-sm font-semibold text-gray-900 dark:text-white">Bonnie
                                            Green</span>
                                        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">11:46</span>
                                    </div>
                                    <p class="text-sm font-normal py-2.5 text-gray-900 dark:text-white">That's awesome. I
                                        think our users will really appreciate the improvements.</p>
                                    {{-- <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Delivered</span> --}}
                                </div>
                                {{-- <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots"
                                    data-dropdown-placement="bottom-start"
                                    class="inline-flex items-center self-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:ring-gray-600"
                                    type="button">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                        <path
                                            d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                    </svg>
                                </button> --}}
                                <div id="dropdownDots"
                                    class="z-10 hidden w-40 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                        aria-labelledby="dropdownMenuIconButton">
                                        <li>
                                            <a href="#"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Reply</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Forward</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Copy</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete</a>
                                        </li>
                                    </ul>
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
@endsection
