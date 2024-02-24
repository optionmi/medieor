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

                <div id="post-list" class="flex flex-col items-center w-full gap-5">
                    @foreach ($group->posts as $post)
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
                                        <small class="cursor-pointer hover:underline"><span
                                                id="like_count_{{ $post->id }}">{{ $post->likes_count }}</span>
                                            likes</small>

                                        <button data-modal-target="comments-modal" data-post_id="{{ $post->id }}"
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
                                                data-post_id="{{ $post->id }}">
                                                <i class="fa-regular fa-thumbs-up"></i>
                                                <span class="font-bold">Like</span></button>
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
                                        <img class="w-8 h-8 rounded-full" src="{{ asset('img/no-avatar.png') }}"
                                            alt="Profile Picture">
                                        <div
                                            class="flex flex-col w-full leading-1.5 px-4 py-2 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
                                            <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                                <span
                                                    class="text-sm font-semibold text-gray-900 dark:text-white">{{ $post->comments()->latest()->first()->user->name }}</span>
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

    <script>
        var $j = jQuery.noConflict();
        $j(document).ready(function() {

            const options = {
                placement: 'bottom-right',
                backdrop: 'dynamic',
                backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
                closable: true,
                onHide: () => {
                    console.log('modal is hidden');
                },
                onShow: () => {
                    console.log('modal is shown');
                },
                onToggle: () => {
                    console.log('modal has been toggled');
                },
            };

            const instanceOptions = {
                id: 'modalEl',
                override: true
            };

            $j(document).on('submit', '#create-post-modal form', function(e) {
                e.preventDefault();

                var form = $j(this);
                var submitUrl = form.attr('action');
                var method = form.attr('method');

                var submitButton = form.find('button[type="submit"]');
                submitButton.html('<i class="fas fa-2x fa-sync-alt fa-spin"></i>');

                var formData = new FormData(this);


                // Make an AJAX request
                $j.ajax({
                    url: submitUrl,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {

                        submitButton.html('Save changes');
                        $j('#create-post-modal form')[0].reset();

                        if (response.error == true) {

                            Swal.fire({
                                title: 'Error!',
                                text: response.data.message,
                                icon: 'error',
                                showConfirmButton: true,
                            }).then((value) => {

                            });
                            console.error('Error saving post:', error.responseText);
                            return false;
                        } else {
                            $j('#post-list').html(response.data.posts);
                            console.log('slksssssssssssss', response)
                            Swal.fire({
                                title: 'Success!',
                                text: response.data.message,
                                icon: 'success',
                                showConfirmButton: true,
                            }).then((value) => {

                            });
                        }
                        // $('#create-post-modal').addClass('hidden');
                        // new Modal('#comments-modal', options, instanceOptions).toggle;
                        // Flowbite.Modal.show('#comments-modal');
                        // const commentModal = new Modal(document.getElementById('#comments-modal'));
                        // commentModal.hide()
                    },
                    error: function(error) {
                        submitButton.html('Save changes');
                        const errorMessage = error.responseJSON.message;
                        console.error('Error:', errorMessage);
                        if (errorMessage == 'Unauthenticated.') {
                            $j('#create-new-group').hide();

                            Swal.fire({
                                title: 'Error!',
                                text: 'Please login to create group',
                                icon: 'error',
                                showConfirmButton: true,
                            }).then((value) => {

                            });
                            return false;
                        }
                    }
                });
            });

            $j(document).on('click', '.create-comment-btn', function(e) {
                var post_id = $j(this).data('post_id');
                $j('#hidden_post_id').val(post_id);
            });

            $j(document).on('submit', '#comment-form', function(e) {
                e.preventDefault(); // Prevent the form from submitting traditionally

                var form = $j(this);
                var submitUrl = form.attr('action');
                var method = form.attr('method');

                var submitButton = form.find('button[type="submit"]');
                submitButton.html('<i class="fas fa-2x fa-sync-alt fa-spin"></i>');

                var formData = new FormData(this);

                // Make an AJAX request
                $j.ajax({
                    url: submitUrl,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {

                        submitButton.html('Save changes');
                        $j('#comment-form')[0].reset();

                        if (response.error == true) {

                            Swal.fire({
                                title: 'Error!',
                                text: response.data.message,
                                icon: 'error',
                                showConfirmButton: true,
                            }).then((value) => {

                            });
                            console.error('Error saving post:', error.responseText);
                            return false;
                        } else {
                            var post_id = formData.get('post_id');
                            $j('#comment_count_' + post_id).html(response.data.comment_count)
                            Swal.fire({
                                title: 'Success!',
                                text: response.data.message,
                                icon: 'success',
                                showConfirmButton: true,
                            }).then((value) => {

                            });
                        }
                        $j('#create-post-modal').addClass('hidden');
                    },
                    error: function(error) {
                        submitButton.html('Save changes');
                        const errorMessage = error.responseJSON.message;
                        console.error('Error:', errorMessage);
                        if (errorMessage == 'Unauthenticated.') {
                            $j('#create-new-group').hide();

                            Swal.fire({
                                title: 'Error!',
                                text: 'Please login to create group',
                                icon: 'error',
                                showConfirmButton: true,
                            }).then((value) => {

                            });
                            return false;
                        }
                    }
                });
            });

            $j(document).on('click', '.comment-list', function(e) {
                $j('#popup-comment-list').html('<span class="text-center">Loading...</span>');
                $j.ajax({
                    url: "{{ route('web.post.comments') }}",
                    type: 'POST',
                    data: {
                        post_id: $j(this).data('post_id'),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.error == true) {
                            Swal.fire({
                                title: 'Error!',
                                text: response.data.message,
                                icon: 'error',
                                showConfirmButton: true,
                            }).then((value) => {

                            });
                            console.error('Error saving post:', error.responseText);
                            return false;
                        } else {
                            $j('#popup-comment-list').html(response.data.comments)
                        }
                    },
                    error: function(error) {
                        console.error('Error:', errorMessage);
                    }
                });
            });

            $j(document).on('click', '.like-post', function(e) {

                $j.ajax({
                    url: "{{ route('web.like.toggle') }}",
                    type: 'POST',
                    data: {
                        post_id: $(this).data('post_id'),
                        _token: '{{ csrf_token() }}'
                    },
                    // dataType: 'html',
                    success: function(response) {
                        if (response.error == true) {
                            Swal.fire({
                                title: 'Error!',
                                text: response.data.message,
                                icon: 'error',
                                showConfirmButton: true,
                            }).then((value) => {

                            });
                            console.error('Error saving post:', error.responseText);
                            return false;
                        } else {
                            var post_id = response.data.post_id;
                            $j('#like_count_' + post_id).html(response.data.like_count)
                            Swal.fire({
                                title: 'Success!',
                                text: response.data.message,
                                icon: 'success',
                                showConfirmButton: true,
                            }).then((value) => {

                            });
                        }
                    },
                    error: function(error) {
                        console.error('Error:', errorMessage);
                    }
                });
            });

            $j(document).on('click', ".reply-button", function(e) {
                var commentId = $j(this).parent().attr('id');
                var commentPrimaryId = $j(this).parent().data('comment_id');
                // Check if replyBox already exists
                if ($j('#replyBox' + commentId).length === 0) {
                    var replyBox =
                        '<div class="flex justify-end gap-4 py-2" id="replyBox' + commentId +
                        '"><input class="rounded-md" type="text" id="reply' +
                        commentId + '" placeholder="Write a reply..."><button onclick="postReply(\'' +
                        commentId + '\', \'' + commentPrimaryId +
                        '\')" class="px-3 py-2 text-white bg-blue-500 rounded-md" type="button">Post</button></div>';
                    $j(this).siblings('.replies').append(replyBox);
                    // Use setTimeout to ensure the element is rendered in the DOM before we try to focus
                    setTimeout(function() {
                        $j('#reply' + commentId).focus();
                    }, 0);
                }
            });

            $j(document).on('click', ".view-all-replies", function(e) {
                e.preventDefault();
                var commentId = $j(this).data('comment_id');
                $j('#comment' + commentId + ' .additional-replies').show();
                $j(this).hide();
            });


            // Edit Comment
            // When the edit button is clicked
            $j(document).on('click', '.edit-button', function(e) {
                // Get the current comment content
                var currentContent = $(this).siblings('div').find('p').text();

                // Replace the comment content with an input field, pre-filled with the current content
                $(this).siblings('div').find('p').replaceWith(
                    '<input type="text" class="edit-field" value="' + currentContent + '">');

                // focus on the input field
                $(this).siblings('div').find('input').focus();

                // make cursor at the end of the input field
                $(this).siblings('div').find('input').get(0).setSelectionRange(
                    currentContent.length, currentContent.length);

                // Change the edit button to a save button
                $(this).html('<i class="fa-solid fa-save"></i>').addClass('save-button').removeClass(
                    'edit-button');

            });

            // When the save button is clicked
            $j(document).on('click', '.save-button', function() {
                // Get the new comment content
                var newContent = $(this).siblings('div').find('input').val();

                // Replace the input field with a p tag containing the new content
                $(this).siblings('div').find('input').replaceWith(
                    '<p class="py-2 text-sm font-normal text-gray-900 dark:text-white">' + newContent +
                    '</p>');

                // Change the save button back to an edit button
                $(this).html('<i class="fa-solid fa-pencil"></i>').addClass('edit-button').removeClass(
                    'save-button');
            });
            // End edit comment
        });

        function postReply(commentId, id) {
            var replyText = $j('#reply' + commentId).val();
            $j('#replyBox' + commentId).remove();

            $j.ajax({
                type: 'POST',
                url: "{{ route('web.comment.reply.save') }}", // Adjust the URL as per your routes
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    content: replyText,
                    commentId: id
                },
                success: function(response) {

                    $j('#replyBox' + commentId).remove();

                    var replyDiv =
                        '<div class="flex items-start justify-end gap-2 reply"><img class="w-8 h-8 rounded-full" src="{{ asset('img/no-avatar.png') }}" alt="Profile Picture"><div class="flex flex-col w-full leading-1.5 px-4 py-2 border-gray-200 bg-gray-100 max-w-[320px] rounded-e-xl rounded-es-xl dark:bg-gray-700"><div class="flex items-center space-x-2 rtl:space-x-reverse"><span class="text-sm font-semibold text-gray-900 dark:text-white">{{ auth()->user()->name }}</span><span class="text-sm font-normal text-gray-500 dark:text-gray-400">Now</span></div><p class="py-2 text-sm font-normal text-gray-900 dark:text-white">' +
                        replyText +
                        '</p></div><button class="inline-flex items-center self-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:ring-gray-600 edit-button" type="button"><i class="fa-solid fa-pencil"></i></button></div>';
                    $j('#' + commentId + ' .replies').append(replyDiv);
                },
                error: function(error) {
                    // Handle the error response
                    console.error(error);

                    // Optionally, you can show an error message to the user
                    alert('Error posting reply. Please try again.');
                }
            });
        }
    </script>


@endsection
