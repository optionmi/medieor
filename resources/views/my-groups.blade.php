@extends('layouts.app')

@section('content')
    @include('partials.header')

    <main>
        <div class="container mx-auto my-5">
            <div class="flex items-center justify-between px-5 py-10 border-b">
                <div>
                    <h1 class="text-5xl ">
                        My Groups
                    </h1>
                </div>
            </div>

            <div class="flex flex-col gap-4 py-2">
                @foreach ($groups as $group)
                    <div class="px-6 py-4 border rounded-md shadow-md">
                        <div class="w-full">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-4">
                                    <div class="flex-shrink-0 w-20 h-20">
                                        <a href="{{ route('web.group.detail', $group->id) }}" class="object-cover">
                                            <img class="object-cover h-full rounded-full"
                                                src="{{ asset($group->image_path) }}" alt="" />
                                        </a>
                                    </div>
                                    <div>
                                        <a href="{{ route('web.group.detail', $group->id) }}">
                                            <h1 class="text-2xl font-bold text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $group->title }}</h1>
                                        </a>
                                        <small>Public Group</small><br>
                                    </div>
                                </div>
                                <div class="hidden sm:block">
                                    <a class="px-3 py-2 font-semibold text-center text-white bg-blue-600 rounded-md hover:bg-blue-700"
                                        href="{{ route('web.group.detail', $group->id) }}">View</a>
                                </div>
                            </div>
                            <small><i class="w-6 fa-solid fa-eye"></i>Created
                                {{ $group->created_at->diffForHumans() }}</small><br>
                            <small><i
                                    class="w-6 fa-solid fa-users"></i>{{ $group->users->count() . Str::plural(' member', $group->users->count()) }}</small>
                            <div class="my-4">
                                <strong>About</strong>
                                <p>{{ $group->description }}</p>
                            </div>

                            @if ($group->users->count() > 0)
                                <div class="my-4">
                                    <strong>Members</strong>
                                    <div class="flex my-2 -space-x-4 rtl:space-x-reverse">
                                        <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800"
                                            src="{{ asset('img/no-avatar.png') }}" alt="">
                                        <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800"
                                            src="{{ asset('img/no-avatar.png') }}" alt="">
                                        <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800"
                                            src="{{ asset('img/no-avatar.png') }}" alt="">
                                        <a class="flex items-center justify-center w-10 h-10 text-xs font-medium text-white bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600 dark:border-gray-800"
                                            href="#">...</a>
                                    </div>
                                </div>
                            @endif

                        </div>

                        <div class="sm:hidden">
                            <a class="block w-full px-3 py-2 font-semibold text-center text-white bg-blue-600 rounded-md hover:bg-blue-700"
                                href="{{ route('web.group.detail', $group->id) }}">View</a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

    </main>
@endsection
