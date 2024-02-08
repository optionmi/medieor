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
                {{-- <div>
                    <button data-modal-target="create-new-group" data-modal-toggle="create-new-group" type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 font-bold">Create
                        Group</button>
                </div> --}}
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
                    <tbody>
                        @foreach ($groups as $group)
                            <tr
                                class="border-b odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="w-1/2 px-6 py-4 sm:w-3/4">
                                    <a href="{{ route('web.group.detail', $group->id) }}">
                                        <h1 class="text-2xl font-bold text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $group->title }}</h1>
                                    </a>
                                    <small>Public Group</small><br>
                                    <p class="my-4">{{ $group->description }}</p>
                                </th>
                                <td class="w-1/2 px-6 py-4 text-end sm:w-1/4">
                                    <p>Created 2 weeks ago</p>
                                    <p>900 members</p>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </main>
@endsection
