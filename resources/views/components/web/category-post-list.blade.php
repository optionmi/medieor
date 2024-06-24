@foreach ($category_posts as $post)
    <li class="flex flex-col items-center justify-center gap-8 p-5 bg-white rounded-sm shadow-sm sm:flex-row">
        <div class="w-20 h-20 bg-white rounded-full shrink-0">
            <img src="{{ asset('images/user_avatar/default.png') }}" alt="avatar" />
        </div>

        <a class="flex-grow" href="{{ route('category.post.detail', $post->id) }}">
            <h1 class="text-2xl font-semibold">
                {{ $post->title }}
            </h1>
            <p class="py-2">
                {!! $post->body !!}
            </p>
        </a>
        <div class="flex flex-col items-center justify-between w-40">
            <div class="bg-[#bdc4c8] px-4 pt-3 pb-4 text-white font-semibold rounded-sm posts-clip">
                <span class="text-xl">{{ $post->comment_count }}</span>
            </div>
            <div class="flex flex-col items-center w-full text-gray-500">
                <div class="flex items-center justify-center w-full gap-2 text-sm">
                    <i class="fa-solid fa-eye text-[#ced2d3]"></i>
                    <span>{{ $post->views }}</span>
                </div>
                <div class="flex items-center justify-center w-full gap-2 text-sm">
                    <i class="fa-solid fa-clock text-[#ced2d3]"></i>
                    <span>{{ $post->formated_created_at }}</span>
                </div>
            </div>
        </div>
    </li>
@endforeach
