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
                        </div>
                        <div class="w-1/2 px-6 py-4 text-sm text-end sm:w-1/4">
                            <p>Created {{ $group->created_at->diffForHumans() }}</p>
                            <p>900 members</p>

                        </div>
                    </div>
                @endforeach
            </div>

        </div>

    </main>
@endsection
