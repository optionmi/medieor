@foreach ($posts as $post)
    <div class="p-5 bg-white rounded-md shadow-md sm:w-1/2">
        <div class="flex flex-col gap-4">
            <div class="flex items-center gap-5">
                <div class="w-12 h-12 bg-gray-400 rounded-full">
                    <img src="{{ asset('img/no-avatar.png') }}" alt="">
                </div>
                <div class="flex flex-col">
                    <div>
                        <strong>{{ $post->author->name }}</strong>
                    </div>
                    <div>
                        <small>{{ $post->created_at->diffForHumans() }}</small>
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
                    <small class="cursor-pointer hover:underline">{{ $post->likes_count }} likes</small>
                    <button data-modal-target="comments-modal" data-modal-toggle="comments-modal"><small
                            class="cursor-pointer hover:underline">{{ $post->comments_count }} comments</small></button>
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
                            data-modal-target="create-comment-modal" data-modal-toggle="create-comment-modal">
                            <i class="fa-regular fa-comment"></i>
                            <span class="font-bold">Comment</span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
