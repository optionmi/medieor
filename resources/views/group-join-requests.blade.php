@extends('layouts.app')
@section('content')
    @include('partials.header')
    <div class="p-4 bg-gray-200">
        <div class="container mx-auto ">
            <div class="my-5">
                <h1 class="text-4xl font-bold">Group Join Requests</h1>
            </div>

            <div class="flex flex-col gap-8 mb-10">
                @foreach ([
            'Group 1' => [(object) ['userName' => 'User 1'], (object) ['userName' => 'User 2'], (object) ['userName' => 'User 3']],
            'Group 2' => [(object) ['userName' => 'User 4'], (object) ['userName' => 'User 5']],
            'Group 3' => [(object) ['userName' => 'User 6'], (object) ['userName' => 'User 7'], (object) ['userName' => 'User 8'], (object) ['userName' => 'User 9']],
        ] as $groupName => $requests)
                    <div class="pb-10 border-b border-gray-400">
                        <div class="w-11/12 mx-auto">
                            <div class="p-4 text-2xl font-bold">
                                {{ $groupName }}
                            </div>
                        </div>
                        <ul class="flex flex-wrap w-11/12 gap-5 mx-auto">
                            @foreach ($requests as $request)
                                <li class="flex flex-col justify-center gap-3 p-5 bg-white rounded-md shadow-md">
                                    <div class="flex p-2 ">
                                        <div class="w-16 h-16 bg-white rounded-full">
                                            <img src="{{ asset('img/no-avatar.png') }}" alt="">
                                        </div>
                                        <div class="mt-1 ms-5">
                                            <strong class="text-xl font-bold">
                                                {{ $request->userName }}
                                            </strong>
                                            <div>
                                                <p>wants to join this group.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-end gap-4">
                                        <button type="button"
                                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Decline</button>
                                        <button type="button"
                                            class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Approve</button>
                                    </div>

                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    @include('partials.footer')
@endsection
