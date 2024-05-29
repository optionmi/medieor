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
                    <div class="flex items-center border rounded-md shadow-md">
                        <div class="w-1/2 px-6 py-4 sm:w-3/4">
                            <a href="{{ route('web.group.detail', $group->id) }}">
                                <h1 class="text-2xl font-bold text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $group->title }}</h1>
                            </a>
                            <small>Public Group</small><br>
                            <p class="my-4">{{ $group->description }}</p>

                            @if ($group->users->count() > 0)
                                <div class="my-4">
                                    <h2 class="font-bold text-gray-800">Members</h2>
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
                        <div class="w-1/2 px-6 py-4 text-sm text-end sm:w-1/4">
                            <p>Created {{ $group->created_at->diffForHumans() }}</p>
                            <p>{{ $group->users->count() }} member{{ $group->users->count() > 1 ? 's' : '' }}</p>

                        </div>
                    </div>
                @endforeach
            </div>

        </div>

    </main>
@endsection
