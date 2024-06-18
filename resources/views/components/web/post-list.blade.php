@props(['group'])

@foreach ($group->posts as $post)
    <div class="w-full p-5 bg-white rounded-md shadow-md sm:w-1/2" id="post{{ $post->id }}">
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

                @if (auth()->user()->hasRole('admin') || $post->author->id === auth()->user()->id || $group->owner->is(auth()->user()))
                    <div class="relative" data-twe-dropdown-ref data-twe-dropdown-alignment="end">
                        <button
                            class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5"
                            type="button" id="dropdownMenuButton1" data-twe-dropdown-toggle-ref aria-expanded="false"
                            data-twe-ripple-init data-twe-ripple-color="light">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 16 3">
                                <path
                                    d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                            </svg>

                        </button>
                        <ul class="absolute z-[1000] float-left m-0 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-base shadow-lg data-[twe-dropdown-show]:block dark:bg-surface-dark"
                            aria-labelledby="dropdownMenuButton1" data-twe-dropdown-menu-ref>
                            <li>
                                <button
                                    class="flex items-center w-full gap-2 px-4 py-2 text-sm font-normal bg-white whitespace-nowrap text-neutral-700 hover:bg-zinc-200/60 focus:bg-zinc-200/60 focus:outline-none active:bg-zinc-200/60 active:no-underline dark:bg-surface-dark dark:text-white dark:hover:bg-neutral-800/25 dark:focus:bg-neutral-800/25 dark:active:bg-neutral-800/25 deletePost"
                                    data-route="{{ route('web.post.delete', $post->id) }}"
                                    data-post_id="{{ $post->id }}" data-twe-dropdown-item-ref>
                                    <i class="text-gray-400 fa-regular fa-trash-can"></i>
                                    <span>Delete Post</span>
                                </button>
                            </li>
                            @if (auth()->user()->hasRole('admin'))
                                <li>
                                    <button
                                        class="flex items-center w-full gap-2 px-4 py-2 text-sm font-normal bg-white whitespace-nowrap text-neutral-700 hover:bg-zinc-200/60 focus:bg-zinc-200/60 focus:outline-none active:bg-zinc-200/60 active:no-underline dark:bg-surface-dark dark:text-white dark:hover:bg-neutral-800/25 dark:focus:bg-neutral-800/25 dark:active:bg-neutral-800/25 muteUser"
                                        data-route="{{ route('admin.user.mute', $post->author->id) }}"
                                        data-twe-dropdown-item-ref>
                                        <i class="text-gray-400 fa-solid fa-volume-xmark"></i>
                                        <span>Mute User</span>
                                    </button>
                                </li>
                            @endif
                        </ul>
                    </div>
                @endif

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
                        data-comments-route="{{ route('web.post.comments') }}" data-modal-toggle="comments-modal"
                        class="comment-list">
                        <small class="cursor-pointer hover:underline"><span id="comment_count_{{ $post->id }}">
                                {{ $post->comments_count }}</span> comments</small>
                    </button>
                </div>
            </div>
            <div>
                <div class="flex items-center gap-5 py-1 border-t border-b">
                    <div class="flex-1 text-center">
                        <button class="like-post hover:bg-[#00000033] w-full py-3 rounded-md transition-colors"
                            data-post_id="{{ $post->id }}" data-route="{{ route('web.like.toggle') }}">
                            @if ($post->user_has_liked)
                                <i class="fa-solid fa-thumbs-up"></i>
                                <span class="font-bold">Unlike</span>
                            @else
                                <i class="fa-regular fa-thumbs-up"></i>
                                <span class="font-bold">Like</span>
                            @endif
                        </button>
                    </div>
                    @if (!auth()->user()->isRestrictedFrom('can_comment'))
                        <div class="flex-1 text-center">
                            <button
                                class="create-comment-btn hover:bg-[#00000033] w-full py-3 rounded-md transition-colors"
                                data-post_id="{{ $post->id }}" data-modal-target="create-comment-modal"
                                data-modal-toggle="create-comment-modal">
                                <i class="fa-regular fa-comment"></i>
                                <span class="font-bold">Comment</span></button>
                        </div>
                    @endif
                </div>
            </div>

            @if ($post->comments()->latest()->first())
                <div class="flex items-start gap-2">
                    <img class="w-8 h-8 rounded-full"
                        src="{{ asset('images/user_avatar/' . $post->comments()->latest()->first()->author->img) }}"
                        alt="{{ $post->comments()->latest()->first()->author->name }} image">
                    <div
                        class="flex flex-col w-full leading-1.5 px-4 py-2 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                            @if ($post->comments()->latest()->first()->author)
                                <span
                                    class="text-sm font-semibold text-gray-900 dark:text-white">{{ $post->comments()->latest()->first()->author->name }}</span>
                            @else
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">Deleted
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
