@foreach ($comments as $comment)
    <div id="comment{{ $comment->id }}" data-comment_id="{{ $comment->id }}"
        data-reply_route="{{ route('web.comment.reply.save') }}">
        <div class="flex items-start w-11/12 gap-2">
            <img class="w-8 h-8 rounded-full" src="{{ asset('images/user_avatar/' . $comment->author->img) }}"
                alt="{{ $comment->author->name }} image">
            <div
                class="flex flex-col w-full max-w-[320px] leading-1.5 px-4 py-2 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
                <div class="flex items-center gap-2">
                    <span class="text-sm font-semibold text-gray-900 dark:text-white">
                        {{ $comment->author->name }}
                    </span>
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                        {{ $comment->created_at->diffForHumans() }}
                    </span>

                    @if (auth()->user()->hasRole('admin') || $comment->author->id === auth()->user()->id)
                        <div class="relative ml-auto" data-twe-dropdown-ref data-twe-dropdown-alignment="end">
                            <button
                                class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5"
                                type="button" id="dropdownMenuButton1" data-twe-dropdown-toggle-ref
                                aria-expanded="false" data-twe-ripple-init data-twe-ripple-color="light">
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
                                        class="flex items-center w-full gap-2 px-4 py-2 text-sm font-normal bg-white whitespace-nowrap text-neutral-700 hover:bg-zinc-200/60 focus:bg-zinc-200/60 focus:outline-none active:bg-zinc-200/60 active:no-underline dark:bg-surface-dark dark:text-white dark:hover:bg-neutral-800/25 dark:focus:bg-neutral-800/25 dark:active:bg-neutral-800/25 deleteComment"
                                        data-route="{{ route('web.comment.delete', $comment->id) }}"
                                        data-comment_id="{{ $comment->id }}" data-twe-dropdown-item-ref>
                                        <i class="text-gray-400 fa-regular fa-trash-can"></i>
                                        <span>Delete Comment</span>
                                    </button>
                                </li>
                                @if (auth()->user()->hasRole('admin'))
                                    <li>
                                        <button
                                            class="flex items-center w-full gap-2 px-4 py-2 text-sm font-normal bg-white whitespace-nowrap text-neutral-700 hover:bg-zinc-200/60 focus:bg-zinc-200/60 focus:outline-none active:bg-zinc-200/60 active:no-underline dark:bg-surface-dark dark:text-white dark:hover:bg-neutral-800/25 dark:focus:bg-neutral-800/25 dark:active:bg-neutral-800/25 muteUser"
                                            data-route="{{ route('admin.user.mute', $comment->author->id) }}"
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
                <p class="py-2 text-sm font-normal text-gray-900 dark:text-white comment-text">
                    {{ $comment->content }}
                </p>
            </div>
            @if ($comment->author_id == auth()->id() && $comment->created_at->diffInMinutes() < 5)
                <button data-url="{{ route('web.comment.update', $comment->id) }}"
                    class="inline-flex items-center self-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:ring-gray-600 edit-button"
                    type="button"><i class="fa-solid fa-pencil"></i></button>
            @endif
        </div>
        @if (!auth()->user()->hasRestriction('can_reply'))
            <button class="ml-16 text-sm text-blue-500 reply-button" type="button">Reply</button>
        @endif
        <div class="flex flex-col gap-4 mt-5 replies">



            @php
                $visibleReplies = $comment->replies->take(2); // Take only the first two replies
                $remainingReplies = $comment->replies->count() - 2;
            @endphp

            @foreach ($visibleReplies as $reply)
                <div class="flex items-start w-11/12 gap-2 ml-auto reply">
                    <img class="w-8 h-8 rounded-full" src="{{ asset('images/user_avatar/' . $reply->author->img) }}"
                        alt="{{ $reply->author->name }} image">
                    <div
                        class="flex flex-col w-full leading-1.5 px-4 py-2 border-gray-200 bg-gray-100 max-w-[320px] rounded-e-xl rounded-es-xl dark:bg-gray-700">
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                {{ $reply->author->name }}
                            </span>
                            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                {{ $reply->created_at->diffForHumans() }}
                            </span>

                            @if (auth()->user()->hasRole('admin') || $reply->author->id === auth()->user()->id)
                                <div class="relative ml-auto" data-twe-dropdown-ref data-twe-dropdown-alignment="end">
                                    <button
                                        class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5"
                                        type="button" id="dropdownMenuButton1" data-twe-dropdown-toggle-ref
                                        aria-expanded="false" data-twe-ripple-init data-twe-ripple-color="light">
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
                                                class="flex items-center w-full gap-2 px-4 py-2 text-sm font-normal bg-white whitespace-nowrap text-neutral-700 hover:bg-zinc-200/60 focus:bg-zinc-200/60 focus:outline-none active:bg-zinc-200/60 active:no-underline dark:bg-surface-dark dark:text-white dark:hover:bg-neutral-800/25 dark:focus:bg-neutral-800/25 dark:active:bg-neutral-800/25 deleteReply"
                                                data-route="{{ route('web.reply.delete', $reply->id) }}"
                                                data-reply_id="{{ $reply->id }}" data-twe-dropdown-item-ref>
                                                <i class="text-gray-400 fa-regular fa-trash-can"></i>
                                                <span>Delete Reply</span>
                                            </button>
                                        </li>
                                        @if (auth()->user()->hasRole('admin'))
                                            <li>
                                                <button
                                                    class="flex items-center w-full gap-2 px-4 py-2 text-sm font-normal bg-white whitespace-nowrap text-neutral-700 hover:bg-zinc-200/60 focus:bg-zinc-200/60 focus:outline-none active:bg-zinc-200/60 active:no-underline dark:bg-surface-dark dark:text-white dark:hover:bg-neutral-800/25 dark:focus:bg-neutral-800/25 dark:active:bg-neutral-800/25 muteUser"
                                                    data-route="{{ route('admin.user.mute', $reply->author->id) }}"
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
                        <p class="py-2 text-sm font-normal text-gray-900 dark:text-white">
                            {{ $reply->content }}
                        </p>
                    </div>

                    @if ($reply->author_id == auth()->id() && $reply->created_at->diffInMinutes() < 5)
                        <button data-url="{{ route('web.comment.reply.update', $reply->id) }}"
                            class="inline-flex items-center self-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:ring-gray-600 edit-button"
                            type="button"><i class="fa-solid fa-pencil"></i></button>
                    @endif
                </div>
            @endforeach

            @if ($remainingReplies > 0)
                <a href="#" class="ml-[5rem] text-sm text-blue-500 view-all-replies"
                    data-comment_id="{{ $comment->id }}">
                    View all ({{ $comment->replies->count() }}) replies
                </a>
                <div class="flex-col hidden gap-4 additional-replies ">
                    @foreach ($comment->replies->slice(2) as $reply)
                        <div class="flex items-start w-11/12 gap-2 ml-auto reply">
                            <img class="w-8 h-8 rounded-full"
                                src="{{ asset('images/user_avatar/' . $reply->author->img) }}"
                                alt="{{ $reply->author->name }} image">
                            <div
                                class="flex flex-col w-full leading-1.5 px-4 py-2 border-gray-200 bg-gray-100 max-w-[320px] rounded-e-xl rounded-es-xl dark:bg-gray-700">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="text-sm font-semibold text-gray-900 dark:text-white">{{ $reply->author->name }}</span>
                                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                        {{ $reply->created_at->diffForHumans() }}
                                    </span>

                                    @if (auth()->user()->hasRole('admin') || $reply->author->id === auth()->user()->id)
                                        <div class="relative ml-auto" data-twe-dropdown-ref
                                            data-twe-dropdown-alignment="end">
                                            <button
                                                class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5"
                                                type="button" id="dropdownMenuButton1" data-twe-dropdown-toggle-ref
                                                aria-expanded="false" data-twe-ripple-init
                                                data-twe-ripple-color="light">
                                                <svg class="w-5 h-5" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 16 3">
                                                    <path
                                                        d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                                </svg>

                                            </button>
                                            <ul class="absolute z-[1000] float-left m-0 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-base shadow-lg data-[twe-dropdown-show]:block dark:bg-surface-dark"
                                                aria-labelledby="dropdownMenuButton1" data-twe-dropdown-menu-ref>
                                                <li>
                                                    <button
                                                        class="flex items-center w-full gap-2 px-4 py-2 text-sm font-normal bg-white whitespace-nowrap text-neutral-700 hover:bg-zinc-200/60 focus:bg-zinc-200/60 focus:outline-none active:bg-zinc-200/60 active:no-underline dark:bg-surface-dark dark:text-white dark:hover:bg-neutral-800/25 dark:focus:bg-neutral-800/25 dark:active:bg-neutral-800/25 deleteReply"
                                                        data-route="{{ route('web.reply.delete', $reply->id) }}"
                                                        data-reply_id="{{ $reply->id }}"
                                                        data-twe-dropdown-item-ref>
                                                        <i class="text-gray-400 fa-regular fa-trash-can"></i>
                                                        <span>Delete Reply</span>
                                                    </button>
                                                </li>
                                                @if (auth()->user()->hasRole('admin'))
                                                    <li>
                                                        <button
                                                            class="flex items-center w-full gap-2 px-4 py-2 text-sm font-normal bg-white whitespace-nowrap text-neutral-700 hover:bg-zinc-200/60 focus:bg-zinc-200/60 focus:outline-none active:bg-zinc-200/60 active:no-underline dark:bg-surface-dark dark:text-white dark:hover:bg-neutral-800/25 dark:focus:bg-neutral-800/25 dark:active:bg-neutral-800/25 muteUser"
                                                            data-route="{{ route('admin.user.mute', $reply->author->id) }}"
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
                                <p class="py-2 text-sm font-normal text-gray-900 dark:text-white">
                                    {{ $reply->content }}
                                </p>
                            </div>
                            @if ($reply->author_id == auth()->id() && $reply->created_at->diffInMinutes() < 5)
                                <button data-url="{{ route('web.comment.reply.update', $reply->id) }}"
                                    class="inline-flex items-center self-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:ring-gray-600 edit-button"
                                    type="button"><i class="fa-solid fa-pencil"></i></button>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endforeach
