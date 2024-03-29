@foreach ($comments as $comment)
<div id="comment{{ $comment->id }}" data-comment_id="{{ $comment->id }}">
    <div class="flex items-start gap-2">
        <img class="w-8 h-8 rounded-full" src="{{ asset('img/no-avatar.png') }}" alt="Profile Picture">
        <div class="flex flex-col w-full max-w-[320px] leading-1.5 px-4 py-2 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
            <div class="flex items-center space-x-2 rtl:space-x-reverse">
                <span class="text-sm font-semibold text-gray-900 dark:text-white">
                    {{ $comment->user->name }}
                </span>
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                    {{ $comment->created_at->diffForHumans() }}
                </span>
            </div>
            <p class="py-2 text-sm font-normal text-gray-900 dark:text-white comment-text">
                {{ $comment->content }}
            </p>
        </div>
        @if($comment->user_id == auth()->id())
        <button data-url="{{ route('web.comment.update', $comment->id) }}" class="inline-flex items-center self-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:ring-gray-600 edit-button" type="button"><i class="fa-solid fa-pencil"></i></button>
        @endif
    </div>
    <button class="ml-[4rem] text-sm text-blue-500 reply-button" type="button">Reply</button>
    <div class="flex flex-col gap-4 mt-5 replies">

        

        @php
            $visibleReplies = $comment->replies->take(2); // Take only the first two replies
            $remainingReplies = $comment->replies->count() - 2;
        @endphp

        @foreach ($visibleReplies as $reply)
        <div class="flex items-start justify-end gap-2 reply">
            <img class="w-8 h-8 rounded-full" src="{{ asset('img/no-avatar.png') }}" alt="Profile Picture">
            <div class="flex flex-col w-full leading-1.5 px-4 py-2 border-gray-200 bg-gray-100 max-w-[320px] rounded-e-xl rounded-es-xl dark:bg-gray-700">
                <div class="flex items-center space-x-2 rtl:space-x-reverse">
                    <span class="text-sm font-semibold text-gray-900 dark:text-white">
                        {{ $reply->user->name }}
                    </span>
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                        {{ $reply->created_at->diffForHumans() }}
                    </span>
                </div>
                <p class="py-2 text-sm font-normal text-gray-900 dark:text-white">
                    {{ $reply->content }}
                </p>
            </div>
            <button data-url="{{ route('web.comment.reply.update', $reply->id) }}" class="inline-flex items-center self-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:ring-gray-600 edit-button" type="button"><i class="fa-solid fa-pencil"></i></button>
        </div>
        @endforeach

        @if ($remainingReplies > 0)
            <a href="#" class="ml-[5rem] text-sm text-blue-500 view-all-replies" data-comment_id="{{ $comment->id }}">
                View all ({{ $comment->replies->count() }}) replies
            </a>
            <div class="hidden additional-replies">
                @foreach ($comment->replies->slice(2) as $reply)
                    <div class="flex items-start justify-end gap-2 reply">
                        <img class="w-8 h-8 rounded-full" src="{{ asset('img/no-avatar.png') }}"
                            alt="Profile Picture">
                        <div class="flex flex-col w-full leading-1.5 px-4 py-2 border-gray-200 bg-gray-100 max-w-[320px] rounded-e-xl rounded-es-xl dark:bg-gray-700">
                            <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $reply->user->name }}</span>
                                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ $reply->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <p class="py-2 text-sm font-normal text-gray-900 dark:text-white">
                                {{ $reply->content }}
                            </p>
                        </div>
                        <button data-url="{{ route('web.comment.reply.update', $reply->id) }}" class="inline-flex items-center self-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:ring-gray-600 edit-button" type="button"><i class="fa-solid fa-pencil"></i></button>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endforeach
