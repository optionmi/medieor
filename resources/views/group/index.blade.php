@extends('layouts.app')

@section('content')
    @include('partials.header')

    <main>
        <div class="container mx-auto my-5">
            <div class="flex items-center justify-between px-5 py-10 border-b">
                <div>
                    <h1 class="text-5xl ">
                        Groups
                    </h1>
                </div>
                <div>
                    <button data-modal-target="create-new-group" data-modal-toggle="create-new-group" type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 font-bold">Create
                        Group</button>
                </div>
            </div>

            <div class="flex flex-col gap-5 shadow-md sm:rounded-lg">
                @foreach ($groups as $group)
                    <div class="flex justify-center px-5 py-2 border shadow-md">
                        <div class="w-full px-6 py-4 sm:w-3/4">
                            <div class="flex justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="flex-grow-0 flex-shrink-0 w-20 h-20">
                                        <a href="#" class="object-cover">
                                            <img class="object-cover h-full rounded-full"
                                                src="{{ asset($group->image_path) }}" alt="" />
                                        </a>
                                    </div>
                                    <div>
                                        <h1 class="text-xl font-bold text-gray-900 sm:text-2xl dark:text-white">
                                            {{ $group->title }}</h1>
                                        <small>Public Group</small> ●
                                        <small>{{ $group->users->count() . Str::plural(' member', $group->users->count()) }}</small>
                                    </div>
                                </div>
                                <div class="hidden sm:block">
                                    @if (auth()->user() && in_array($group->id, auth()->user()->groups->pluck('id')->toArray()))
                                        <a href="#" data-id="{{ $group->id }}"
                                            class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-white bg-gray-700 rounded-lg pointer-events-none hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800 join-group">
                                            Joined
                                        </a>
                                    @else
                                        <a href="#" data-id="{{ $group->id }}"
                                            class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 join-group">
                                            Join Group
                                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="my-4">
                                <h2 class="font-bold text-gray-800">About</h2>
                                <p class="my-2">{{ $group->description }}</p>
                            </div>
                            <div class="my-4">
                                <x-web.members-image :users="$group->users" />
                                <p>{{ $group->users_joined_message }}</p>
                            </div>
                            <div class="my-4">
                                <h2 class="font-bold text-gray-800">Group Activity</h2>
                                <ul class="flex flex-col gap-1 my-2">
                                    <li><i class="w-6 fa-solid fa-rss"></i> {{ $group->today_post_count }} new
                                        {{ Str::plural('post', $group->today_post_count) }} today
                                    </li>
                                    <li><i class="w-6 fa-solid fa-users"></i>
                                        {{ $group->users->count() . Str::plural(' member', $group->users->count()) }}
                                    </li>
                                    <li><i class="w-6 fa-solid fa-eye"></i> Created about
                                        {{ $group->created_at->diffForHumans() }}
                                    </li>
                                </ul>
                            </div>

                            <div class="sm:hidden">
                                @if (auth()->user() && in_array($group->id, auth()->user()->groups->pluck('id')->toArray()))
                                    <a href="#" data-id="{{ $group->id }}"
                                        class="inline-flex items-center justify-center w-full px-3 py-2 text-sm font-medium text-white bg-gray-700 rounded-lg pointer-events-none hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800 join-group">
                                        Joined
                                    </a>
                                @else
                                    <a href="#" data-id="{{ $group->id }}"
                                        class="inline-flex items-center justify-center w-full px-3 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 join-group">
                                        Join Group
                                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

    </main>



    <!-- Create New Group modal -->
    <div id="create-new-group" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-screen max-h-full  bg-[#00000088]">
        <div class="relative w-full max-w-md max-h-full p-4">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Create New Group
                    </h3>
                    <button id="closeCreateGroupModalBtn" type="button"
                        class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="create-new-group">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" action="{{ route('web.create.group') }}" method="POST" id="save-group-form">
                    @csrf
                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="col-span-2">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type group name" required="">
                        </div>
                        <div class="col-span-2">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Group
                                Description</label>
                            <textarea id="description" rows="4" name="description"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Write group description here"></textarea>
                        </div>
                        <div class="col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="image">Group Logo</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="image" name="image" type="file">
                        </div>


                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 justify-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-5 h-5 me-1 -ms-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Add new Group
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#save-group-form').submit(function(e) {
                e.preventDefault();

                var form = $(this);
                var submitUrl = form.attr('action');
                var method = form.attr('method');

                var submitButton = form.find('button[type="submit"]');
                submitButton.html('<i class="fas fa-2x fa-sync-alt fa-spin"></i>');

                var formData = new FormData(this);

                $.ajax({
                    url: submitUrl,
                    type: method,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {

                        submitButton.html('Save changes');
                        $('#save-group-form')[0].reset();
                        $('#closeCreateGroupModalBtn').click();

                        if (data.error == true) {
                            Swal.fire({
                                title: 'Error!',
                                text: data.message,
                                icon: 'error',
                                showConfirmButton: true,
                            }).then((value) => {

                            });
                            return false;
                        } else {
                            Swal.fire({
                                title: 'Success!',
                                text: data.message,
                                icon: 'success',
                                showConfirmButton: true,
                            }).then((value) => {

                            });
                        }
                    },
                    error: function(error) {
                        submitButton.html('Save changes');
                        const errorMessage = error.responseJSON.message;
                        console.error('Error:', errorMessage);
                        if (errorMessage == 'Unauthenticated.') {
                            $('#create-new-group').hide();
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

            $('.join-group').click(function(event) {
                event.preventDefault();

                const groupId = $(this).data('id');
                const $button = $(this);

                $.ajax({
                    url: "{{ route('web.join.group') }}",
                    method: 'POST',
                    data: {
                        id: groupId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        console.log(data);
                        Swal.fire({
                            title: 'Success!',
                            text: data.message,
                            icon: 'success',
                            showConfirmButton: true,
                        }).then((value) => {
                            $button.text('Join Request Sent');
                            $button.removeClass(
                                    'bg-green-700 hover:bg-green-800 join-group')
                                .addClass(
                                    'bg-gray-400 hover:bg-gray-500 pointer-events-none'
                                );
                        });
                    },
                    error: function(error) {
                        console.error(error);
                        const errorMessage = error.responseJSON.message;
                        if (errorMessage == 'Unauthenticated.') {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Please login to join group',
                                icon: 'error',
                                showConfirmButton: true,
                            }).then((value) => {

                            });
                            return false;
                        }
                    }
                });
            });
        });
    </script>
@endsection
