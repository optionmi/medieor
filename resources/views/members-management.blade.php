@extends('layouts.app')

@section('content')
    @include('partials.header')
    <main class="flex items-start justify-center min-h-[calc(100vh-6rem)] bg-gray-200 py-5 px-2 sm:py-10 sm:px-5">
        <div class="flex flex-col gap-5 mx-auto sm:container">

            <section class="flex p-10 bg-white rounded-md shadow-md ">
                <div class="w-full">
                    <div class="mb-5">
                        <h1 class="text-2xl font-semibold text-gray-600">{{ $group->title }}</h1>
                        <small class="text-gray-500">Members Management</small>
                    </div>
                    <hr>
                    <ul class="sm:m-5">
                        @foreach ($members as $member)
                            <li
                                class="flex flex-col items-center justify-between gap-5 px-5 py-4 transition-colors duration-300 sm:flex-row border-y hover:bg-gray-100">
                                <a class="flex flex-col items-center gap-5 sm:flex-row" href="#">
                                    <div class="w-20 h-20 p-1 border rounded-full border-primary shrink-0"><img
                                            class="object-cover w-full h-full rounded-full" src="{{ $member->image_path }}"
                                            alt="">
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xl ">{{ $member->name }}</span>
                                        {{-- <small>joined {{ $member->created_at->diffForHumans() }}</small> --}}
                                    </div>
                                </a>

                                <div class="flex gap-5 shrink-0">
                                    <button
                                        class="px-4 py-2 font-semibold text-white transition-colors duration-100 bg-red-600 rounded-md hover:bg-red-700"
                                        data-delete-route="{{ route('web.member.delete', [$group->id, $member->id]) }}"
                                        data-twe-toggle="modal" data-twe-target="#deleteModal" data-twe-ripple-init
                                        data-twe-ripple-color="light">Remove</button>
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
@endsection
