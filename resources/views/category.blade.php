@extends('layouts.app')
@section('styles')
    @vite(['resources/css/community-home.css'])
@endsection

@section('content')
    @include('partials.header')
    <section class="mb-10">
        <div class="relative">
            <div class="relative main-bg w-full h-[35vh] sm:h-[95vh]">
                <img src="{{ asset($category->image) }}" alt="">
                <div
                    class="absolute flex-col items-center hidden p-5 text-3xl text-white sm:leading-[4.5rem] right-16 sm:flex sm:text-6xl bottom-60 banner-content backdrop-blur bg-black/10 rounded-lg">
                    {!! $category->img_text !!}
                </div>
            </div>
            <div class="absolute left-0 right-0 z-10 flex items-end justify-around h-24 sm:bottom-10 bottom-1">
                <div class="w-20 h-20 bg-white rounded-full bg1"></div>
                <div class="self-start w-20 h-20 bg-white rounded-full bg2"></div>
                <div class="w-20 h-20 bg-white rounded-full bg3"></div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 h-16 p-2 sm:h-24 bg-primary ellipse-clip">

            </div>
        </div>
    </section>

    <main class="container mx-auto my-5">
        <section class="flex flex-col justify-between gap-5 sm:flex-row ">
            <div class="w-full p-5 sm:w-3/5">
                <h1 class="text-2xl sm:text-5xl">
                    My Contribution in healing <br>
                    @php
                        $title = $category->title;
                        $words = explode(' ', $title);
                        $firstWord = array_shift($words);
                        $lastWord = array_pop($words);
                        $middleWords = implode(' ', $words);
                    @endphp
                    <span class="font-bold">{{ $firstWord }}</span>
                    {{ $middleWords }}
                    <span class="font-bold">{{ $lastWord }}</span>
                </h1>

                <div class="my-5 text-xl sm:text-2xl">
                    {!! $category->description !!}
                </div>
                <div class="flex justify-between gap-4 px-2 my-10">
                    <p>
                        <span class="text-3xl sm:text-5xl">{{ $category->active_groups->count() }}</span><br />
                        <span class="sm:text-2xl"> Community Groups</span>
                    </p>
                    <p>
                        <span class="text-3xl sm:text-5xl">{{ $category->users->count() }}</span> <br />
                        <span class="sm:text-2xl"> Registered Members</span>
                    </p>
                    <p>
                        <span class="text-3xl sm:text-5xl">{{ $category->events->count() }}</span> <br />
                        <span class="sm:text-2xl"> Upcoming Events</span>
                    </p>
                </div>
            </div>
            <div class="w-full p-2 sm:w-2/5">
                <div class="p-5 border border-black sm:p-10 bottom-1">
                    <h1 class="pb-5 text-3xl border-b-2 border-gray-600">
                        Latest Active Groups
                    </h1>
                    <ul class="max-h-[35rem] overflow-auto">
                        @foreach ($category->active_groups as $group)
                            <li class="py-5 border-b-2 border-gray-600 ">
                                <div>
                                    @if (auth()->user() && auth()->user()->hasRole('admin'))
                                        <h2 class="text-xl">
                                            <a href="{{ route('web.group.detail', $group->id) }}">{{ $group->title }}</a>
                                        </h2>
                                    @else
                                        <h2 class="text-xl">{{ $group->title }}</h2>
                                    @endif
                                    <div class="flex gap-1 text-xs text-gray-500 sm:text-sm">
                                        <span class="text-gray-500">Public Group</span>●
                                        <span>Created {{ $group->created_at->diffForHumans() }}</span>●
                                        <span>{{ $group->users->count() . Str::plural(' member', $group->users->count()) }}</span>
                                    </div>

                                    @if ($group->users->count() > 0)
                                        <div class="my-4">
                                            <x-web.members-image :users="$group->users" />
                                        </div>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="flex justify-center my-5">
                        <a class="px-3 py-2 font-bold text-white rounded-sm shadow-sm bg-primary"
                            href="{{ route('web.groups', $category->id) }}">Explore Groups</a>
                    </div>
                </div>

                <div class="flex items-center justify-center w-full gap-5 my-5 transition-all duration-300 h-60">
                    <a class="flex flex-col items-center w-1/2 h-full gap-4 py-10 border shadow-lg hover:shadow-xl hover:bg-primary"
                        href="{{ route('web.events', $category->id) }}">
                        <div class="w-24">
                            <img src="{{ asset('img/event_icon.png') }}" alt="">
                        </div>
                        <h1 class="text-xl text-center">Upcoming Events</h1>
                    </a>
                    <a class="flex flex-col items-center w-1/2 h-full gap-4 py-10 border shadow-lg hover:shadow-xl hover:bg-primary"
                        href="{{ route('web.articles', $category->id) }}">
                        <div class="w-24">
                            <img src="{{ asset('img/article_icon.png') }}" alt="">
                        </div>
                        <h1 class="text-xl text-center">Articles</h1>
                    </a>
                </div>
            </div>
        </section>
    </main>

    <section class="my-5 bg-[#f6f2ee] py-5 sm:py-10 px-2">
        <div class="container mx-auto">
            <h1 class="px-5 my-10 text-2xl sm:text-4xl">
                Topics for <span class="font-bold">Discussion</span>
            </h1>
        </div>
        <div class="py-5 bg-white ">
            <div class="container flex flex-col items-center justify-center gap-5 mx-auto sm:flex-row">
                <div class="flex">
                    <div class="relative"><input class="p-2 bg-[#f4f5f9] h-full pr-5" type="text" id="searchInput"
                            placeholder="Search Topics" />
                        <button id="cancelSearchBtn" class="absolute top-0 bottom-0 right-0 hidden my-auto mr-2">X</button>
                    </div>
                    <button type="button" id="searchPostBtn">
                        <div class="text-white bg-[#697684] p-3">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                    </button>
                </div>
                {{-- <button data-modal-target="start-new-topic" data-modal-toggle="start-new-topic" --}}
                {{-- <button class="px-4 py-2 bg-[#1cbb9b] text-white rounded-sm">
                    Start New Topic
                </button> --}}

                {{-- <div class="p-3">
                    <i class="fa-solid fa-envelope fa-xl text-[#ced2d3]"></i>
                </div> --}}
                {{-- <div>
                    <img src="{{ asset('images/user_avatar/' . auth()->user()->img) }}" width="48" height="48"
                        alt="avatar" />
                </div> --}}
            </div>
        </div>

        <div class="container flex flex-col mx-auto sm:flex-row">
            <div class="w-full sm:w-3/5 xl:w-2/3">
                <div class="flex flex-wrap items-center justify-center gap-5 p-5">
                    <i class="cursor-pointer fa-solid fa-angle-left" id="prevPage"></i>
                    <div id="pagination" class="flex flex-wrap items-center justify-center gap-5 p-5">

                    </div>
                    <i class="cursor-pointer fa-solid fa-angle-right" id="nextPage"></i>
                </div>

            </div>
        </div>

        <div class="container flex flex-col gap-5 mx-auto sm:flex-row">
            <div class="w-full px-5 sm:w-3/5 xl:w-2/3">
                <ul class="flex flex-col gap-5" id="cardContainer">

                </ul>
            </div>

            <div class="w-full sm:w-2/5 xl:w-1/3">
                <div class="p-5 bg-white rounded-md">
                    <h1 class="mb-10 text-xl ">Topics</h1>
                    <ul class="flex flex-col gap-2">
                        @if ($category->topics->count() > 0)
                            @foreach ($category->topics as $topic)
                                <li class="flex justify-between">
                                    <a href="">{{ $topic->name }}</a>
                                    <span class="bg-[#d0d4d7] px-2 py-1 font-bold text-white rounded-xl">
                                        {{ $topic->posts->count() }}
                                    </span>
                                </li>
                            @endforeach
                        @else
                            <li class="text-center text-gray-400">No topics found</li>
                        @endif
                    </ul>
                </div>

                <div class="p-5 my-5 bg-white rounded-md">

                    <h1 class="mb-10 text-xl ">Most Popular Topics</h1>
                    <ul class="flex flex-col gap-2">
                        @if ($category->mostPopularTopics->count() > 0)
                            @foreach ($category->mostPopularTopics as $topic)
                                <li class="flex justify-between">
                                    <a href="">{{ $topic->name }}</a>
                                    {{-- <span class="bg-[#d0d4d7] px-2 py-1 font-bold text-white rounded-xl">
                                        {{ $topic->posts->count() }}
                                    </span> --}}
                                </li>
                            @endforeach
                        @else
                            <li class="text-center text-gray-400">No topics found</li>
                        @endif
                    </ul>
                    {{-- <h2 class="text-lg">Which topic you are playing this week?</h2>
                    <ul class="flex flex-col gap-2 py-5">

                        <li class="flex justify-between">
                            <div class="bg-[#ecf0f1] py-2 w-5/6 relative">
                                <div style="width: 50%; background-color: #9a58b5;"
                                    class="absolute top-0 bottom-0 left-0 z-10 h-full"></div>
                                <span class="absolute top-0 bottom-0 left-0 z-20 p-2 font-semibold text-white ">
                                    Call of Duty Ghosts
                                </span>
                            </div>
                            <div class="bg-[#bac1c5] p-2 hover:bg-[#22b69a] ">
                                <i class="text-white fa-solid fa-check"></i>
                            </div>
                        </li>

                        <li class="flex justify-between">
                            <div class="bg-[#ecf0f1] py-2 w-5/6 relative">
                                <div style="width: 20%; background-color: #3497db;"
                                    class="absolute top-0 bottom-0 left-0 z-10 h-full"></div>
                                <span class="absolute top-0 bottom-0 left-0 z-20 p-2 font-semibold text-white ">
                                    Titanfall
                                </span>
                            </div>
                            <div class="bg-[#bac1c5] p-2 hover:bg-[#22b69a] ">
                                <i class="text-white fa-solid fa-check"></i>
                            </div>
                        </li>

                        <li class="flex justify-between">
                            <div class="bg-[#ecf0f1] py-2 w-5/6 relative">
                                <div style="width: 30%; background-color: #e77e23;"
                                    class="absolute top-0 bottom-0 left-0 z-10 h-full"></div>
                                <span class="absolute top-0 bottom-0 left-0 z-20 p-2 font-semibold text-white ">
                                    Battlefield 4
                                </span>
                            </div>
                            <div class="bg-[#bac1c5] p-2 hover:bg-[#22b69a] ">
                                <i class="text-white fa-solid fa-check"></i>
                            </div>
                        </li>

                    </ul> --}}
                    {{-- <small>Voting ends on 19th of October 2024</small> --}}
                </div>
            </div>
        </div>
    </section>

    <section class="my-5 bg-[#f6f2ee] py-10 px-2">
        <div class="container mx-auto">
            <h1 class="px-5 my-10 text-2xl sm:text-4xl">
                How can I <span class="font-bold">Heal My Earth</span>
            </h1>
        </div>

        <div class="container p-5 mx-auto bg-white rounded-md shadow-md">
            @auth
                <form action="{{ route('web.donation.submission', $category->id) }}" method="POST" class="smoothSubmit">
                    @csrf
                @endauth
                <label class="my-5 text-gray-600" for="action">Heal it by</label>
                <select class="w-full mt-5 mb-2" name="action" id="action" required>
                    <option value="">Select action</option>
                    <option value="Giving your time">Giving your time</option>
                    <option value="Joining the Group">Joining the Group</option>
                    <option value="Sharing useful clip & Information regarding your and other activities of healing">
                        Sharing
                        useful clip & Information regarding your and other activities of healing</option>
                    <option value="Creating Event (online & Offline)">Creating Event (online & Offline)</option>
                    <option value="Raising funds for various projects that excites you">Raising funds for various projects
                        that
                        excites you</option>
                </select>
                <p class="hidden text-xs text-red-500 error" id="error-action">Please select a action first, it is
                    required</p>
                <div class="my-5">
                    @if (auth()->check())
                        <button class="px-5 py-2 font-semibold text-white rounded-md bg-primary hover:shadow-md"
                            type="submit">Submit</button>
                    @else
                        <button class="px-5 py-2 font-semibold text-white rounded-md bg-primary hover:shadow-md"
                            type="button" id="showDonationSubmitModalBtn">Submit</button>
                    @endif
                </div>
                @auth
                </form>
            @endauth
        </div>
    </section>

    @include('partials.misc.footer')

    {{-- -modal --}}



    <!-- donationSubmitModal modal -->
    <div id="donationSubmitModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-3xl max-h-full p-4">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Please Fill the Following Details
                    </h3>
                    <button type="button"
                        class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="donationSubmitModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('web.donation.submission', $category->id) }}" method="POST"
                    class="p-4 md:p-5 smoothSubmit">
                    @csrf
                    <input type="hidden" name="action" id="actionHidden">
                    <div class="flex flex-col gap-4 mb-4">
                        <div class="flex flex-col gap-4 sm:flex-row">
                            <div class="w-full sm:w-1/2">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                <input type="text" name="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Your Name" required="true">
                                <p class="text-xs text-red-500 error" id="error-name"></p>
                            </div>
                            <div class="w-full sm:w-1/2">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" name="email" id="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Your Email" required="true">
                                <p class="text-xs text-red-500 error" id="error-email"></p>
                            </div>
                        </div>
                        <div class="flex flex-col gap-4 sm:flex-row">
                            <div class="w-full sm:w-1/2">
                                <label for="country"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
                                <select id="country" name="country"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="">Select your country</option>
                                    @foreach ($countries as $code => $name)
                                        <option value="{{ $code }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-xs text-blue-500">By sharing your location, you enable us to tailor our
                                    services to better match your local interests.</span>
                                <p class="text-xs text-red-500 error" id="error-country"></p>
                            </div>
                            <div class="w-full sm:w-1/2">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                                <input type="number" name="phone" id="phone"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Your Phone Number" required="true" min="1000000000" max="9999999999">
                                <p class="text-xs text-red-500 error" id="error-phone"></p>
                            </div>
                        </div>
                        <div class="flex flex-col gap-4 sm:flex-row">
                            <div class="w-full sm:w-1/2">
                                <label for="register"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Register your
                                    account?</label>
                                <select id="register" name="register"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required="true">
                                    <option value="">Select Yes/No</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                <p class="text-xs text-red-500 error" id="error-register"></p>
                            </div>
                        </div>
                        <div class="flex-col hidden gap-4 sm:flex-row" id="password">
                            <div class="w-full sm:w-1/2">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Passoword</label>
                                <input type="password" name="password" id="password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Your Password">
                                <p class="text-xs text-red-500 error" id="error-password"></p>
                            </div>
                            <div class="w-full sm:w-1/2">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm
                                    Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Confirm Your Password">
                                <p class="text-xs text-red-500 error" id="error-password_confirmation"></p>
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white bg-primary hover:shadow-md w-full font-semibold rounded-lg px-5 py-2.5">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>


    <!-- start-new-topic modal -->
    {{-- <div id="start-new-topic" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-screen max-h-full bg-[#00000088]">
        <div class="relative w-full max-w-2xl max-h-full p-4">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Terms of Service
                    </h3>
                    <button type="button"
                        class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="start-new-topic">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 space-y-4 md:p-5">
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        With less than a month to go before the European Union enacts new consumer privacy laws for its
                        citizens, companies around the world are updating their terms of service agreements to comply.
                    </p>
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25
                        and is meant to ensure a common set of data rights in the European Union. It requires
                        organizations to notify users as soon as possible of high-risk data breaches that could
                        personally affect them.
                    </p>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 border-t border-gray-200 rounded-b md:p-5 dark:border-gray-600">
                    <button data-modal-hide="start-new-topic" type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I
                        accept</button>
                    <button data-modal-hide="start-new-topic" type="button"
                        class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const cardsPerPage = 4; // Adjust as per your requirement
            let currentPage = 1;
            let totalPages;
            let start = 0;
            let search;

            const fetchCards = async (start, perPage, search) => {
                try {
                    const response = await fetch("{{ route('topic.all', $category->id) }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                        },
                        body: JSON.stringify({
                            cardsPerPage: perPage,
                            start: start,
                            search
                        }),
                    });
                    return await response.json();
                } catch (error) {
                    console.error("Error fetching cards:", error);
                    return null;
                }
            };

            const displayCards = (cards) => {
                const container = $("#cardContainer");
                container.empty();
                container.append(cards); // Append card elements
            };

            const createPagination = () => {
                const paginationContainer = $("#pagination");
                paginationContainer.empty();

                for (let i = 1; i <= totalPages; i++) {
                    const pageClass = i === currentPage ? "bg-[#888888]" : "bg-[#d0d4d7]";
                    paginationContainer.append(
                        `<span class="page ${pageClass} py-2 px-4 text-white font-bold rounded-sm cursor-pointer" data-page="${i}">${i}</span>`
                    );
                }

                $(".page").click(function() {
                    currentPage = parseInt($(this).attr("data-page"));
                    start = (currentPage - 1) * cardsPerPage;
                    updateDisplay();
                });
            };

            const updateDisplay = async () => {
                const data = await fetchCards(start, cardsPerPage, search);
                if (data && data.data) {
                    totalPages = Math.ceil(data.data.count / cardsPerPage);
                    displayCards(data.data.posts);
                    createPagination();
                }
            };

            $("#prevPage").click(function() {
                if (currentPage > 1) {
                    currentPage--;
                    start = (currentPage - 1) * cardsPerPage;
                    updateDisplay();
                }
            });

            $("#nextPage").click(function() {
                if (currentPage < totalPages) {
                    currentPage++;
                    start = (currentPage - 1) * cardsPerPage;
                    updateDisplay();
                }
            });

            // Initial display
            updateDisplay();

            $('#searchPostBtn').click(searchPosts);

            const cancelSearchBtn = $('#cancelSearchBtn');
            cancelSearchBtn.click(function() {
                $("#searchInput").val('');
                search = '';
                start = 0;
                currentPage = 1;
                $('#cancelSearchBtn').addClass('hidden');
                updateDisplay();
            });

            $('#searchInput').on('change', function(e) {
                const searchInputElement = $("#searchInput");
                const searchInputValue = searchInputElement.val();

                if (searchInputValue) {
                    $('#cancelSearchBtn').removeClass('hidden');
                } else {
                    $('#cancelSearchBtn').addClass('hidden');
                }
            });

            function searchPosts() {
                const searchInput = $("#searchInput").val();
                search = searchInput;
                start = 0;
                currentPage = 1;
                updateDisplay();
            }
        });
    </script>
@endsection
