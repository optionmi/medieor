@extends('layouts.app')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.1/dist/quill.snow.css" rel="stylesheet" />
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.1/dist/quill.js"></script>
    @vite(['resources/js/dashboard.js'])
@endsection

@section('content')
    @include('partials.header')
    <main class="flex items-start justify-center min-h-[calc(100vh-6rem)] bg-gray-200 py-5 px-2 sm:py-10 sm:px-5">
        <div class="flex flex-col gap-5 mx-auto sm:container">

            <section class="flex p-10 bg-white rounded-md shadow-md ">
                <div class="w-full">
                    <h1 class="mb-5 text-2xl font-semibold text-gray-600">Group Management</h1>
                    <hr>
                    <ul class="sm:m-5">
                        @foreach ($groups as $group)
                            <li
                                class="flex flex-col items-center justify-between gap-5 px-5 py-4 transition-colors duration-300 sm:flex-row border-y hover:bg-gray-100">
                                <a class="flex flex-col items-center gap-5 sm:flex-row"
                                    href="{{ route('web.group.detail', $group->id) }}">
                                    <div class="w-20 h-20 p-1 border rounded-full border-primary shrink-0"><img
                                            class="object-cover w-full h-full rounded-full" src="{{ $group->image_path }}"
                                            alt="">
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xl ">{{ $group->title }}</span>
                                        <small>created {{ $group->created_at->diffForHumans() }}</small>
                                    </div>
                                </a>

                                <div class="flex gap-5 shrink-0">
                                    <button
                                        class="px-4 py-2 font-semibold text-white transition-colors duration-100 bg-green-600 rounded-md hover:bg-green-700"
                                        data-twe-toggle="modal" data-twe-target="#editGroupModal" data-twe-ripple-init
                                        data-twe-ripple-color="light"
                                        data-row-data="{{ json_encode([$group->id, $group->title, $group->description]) }}"
                                        data-update-route="{{ route('web.update.group', $group->id) }}"
                                        data-group-logo="{{ $group->image_path }}">Edit</button>
                                    <button
                                        class="px-4 py-2 font-semibold text-white transition-colors duration-100 bg-red-600 rounded-md hover:bg-red-700"
                                        data-delete-route="{{ route('web.group.delete', $group->id) }}"
                                        data-twe-toggle="modal" data-twe-target="#deleteModal" data-twe-ripple-init
                                        data-twe-ripple-color="light">Delete</button>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>

        </div>
    </main>

    <!-- Delete Modal -->
    @include('partials.deleteModal')

    <!-- Edit Modal -->
    <div data-twe-modal-init
        class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
        id="editGroupModal" tabindex="-1" aria-labelledby="editGroupModalLabel" aria-hidden="true">


        <div data-twe-modal-dialog-ref
            class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px] min-[992px]:max-w-[800px] min-[1200px]:max-w-[1140px]">
            <div
                class="relative flex flex-col w-full text-current bg-white border-none rounded-md outline-none pointer-events-auto bg-clip-padding shadow-4 dark:bg-surface-dark">
                <div
                    class="flex items-center justify-between flex-shrink-0 p-4 border-b-2 rounded-t-md border-neutral-100 dark:border-white/10">
                    <h5 class="text-xl font-medium leading-normal text-surface dark:text-white" id="editGroupModalLabel">
                        Edit Group
                    </h5>
                    <button type="button"
                        class="box-content border-none rounded-none text-neutral-500 hover:text-neutral-800 hover:no-underline focus:text-neutral-800 focus:opacity-100 focus:shadow-none focus:outline-none dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
                        data-twe-modal-dismiss aria-label="Close">
                        <span class="[&>svg]:h-6 [&>svg]:w-6">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </span>
                    </button>
                </div>

                <form action="" method="POST" id="updateDataForm">
                    @csrf
                    <!-- Modal body -->
                    <div class="relative flex-auto p-4" data-twe-modal-body-ref>
                        <div class="flex">
                            <div class="flex flex-col w-1/3 gap-5">
                                <div class="flex items-center justify-center">
                                    <img class="w-48 h-48 p-1 border rounded-full border-primary" id="groupLogoPreview"
                                        src="" alt="">
                                </div>
                                <div class="flex items-center justify-center">
                                    <input type="file" name="image" id="" accept="image/*">
                                </div>
                            </div>
                            <div class="flex flex-col w-2/3 gap-5">
                                <input type="hidden" name="id" id="id" class="updateDataField">
                                <div class="flex flex-col">
                                    <label class="text-sm text-gray-600 uppercase" for="title">Group Title</label>
                                    <input class="w-full rounded-md updateDataField" type="text" name="title"
                                        id="title">
                                </div>
                                <div class="flex flex-col">
                                    <label class="text-sm text-gray-600 uppercase" for="about">About</label>
                                    <div id="description">
                                    </div>
                                    <input class="updateDataField" id="hiddenDescription" type="hidden" name="description">
                                </div>
                                <div class="flex flex-col">
                                    <label class="text-sm text-gray-600 uppercase" for="desc_img">About Image</label>
                                    <input class="my-2" type="file" name="desc_img" id="desc_img">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div
                        class="flex flex-wrap items-center justify-end flex-shrink-0 p-4 border-t-2 rounded-b-md border-neutral-100 dark:border-white/10">
                        <button type="button"
                            class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-200 focus:bg-primary-accent-200 focus:outline-none focus:ring-0 active:bg-primary-accent-200 dark:bg-primary-300 dark:hover:bg-primary-400 dark:focus:bg-primary-400 dark:active:bg-primary-400"
                            data-twe-modal-dismiss data-twe-ripple-init data-twe-ripple-color="light">
                            Close
                        </button>
                        <button type="submit"
                            class="ms-1 inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong"
                            data-twe-ripple-init data-twe-ripple-color="light">
                            Save changes
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
