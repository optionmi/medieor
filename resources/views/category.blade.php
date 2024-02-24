@extends('layouts.app')

@section('content')
    @include('partials.header')
    <section class="mb-10">
        <div class="relative">
            <div class="relative main-bg">
                <img src="{{ asset($category->image) }}" alt="">
                <div class="flex flex-col items-center p-5 text-3xl text-white sm:text-6xl sm:absolute bottom-60 right-20">
                    <h1>The contribution of</h1>
                    <h1>({{ $category->title }})</h1>
                    <h1>
                        in <span class="font-bold">healing</span> the
                        <span class="font-bold"> earth</span>
                    </h1>
                </div>
            </div>
            <div class="absolute left-0 right-0 z-10 flex items-end justify-around h-24 bottom-10">
                <div class="w-20 h-20 bg-white rounded-full bg1"></div>
                <div class="self-start w-20 h-20 bg-white rounded-full bg2"></div>
                <div class="w-20 h-20 bg-white rounded-full bg3"></div>
            </div>
            <div class="bg-[#a48159cc] absolute bottom-0 left-0 right-0 h-24 p-2 ellipse-clip">
                {{-- {/* <div class="container relative flex justify-around mx-auto"></div> */} --}}
            </div>
        </div>
    </section>

    <main class="container mx-auto my-5">
        <section class="flex flex-col justify-between gap-5 sm:flex-row ">
            <div class="w-full p-5 sm:w-3/5">
                <h1 class="text-4xl leading-section-1 sm:text-5xl">
                    My Contribution in healing <br />
                    <span class="font-bold"> {{ $category->title }}</span>
                </h1>
                <p class="my-5 text-2xl">
                    {{ $category->description }}
                </p>
                <div class="flex justify-between gap-4 px-2 my-10">
                    <p>
                        <span class="text-3xl sm:text-5xl">54+</span>
                        <br />
                        <span class="text-xl sm:text-2xl"> Community Groups</span>
                    </p>
                    <p>
                        <span class="text-3xl sm:text-5xl">27+</span> <br />
                        <span class="text-xl sm:text-2xl"> Upcoming Events</span>
                    </p>
                    <p>
                        <span class="text-3xl sm:text-5xl">1000+</span> <br />
                        <span class="text-xl sm:text-2xl"> Registered Members</span>
                    </p>
                </div>
            </div>
            <div class="w-full p-2 sm:w-2/5">
                <div class="p-5 border border-black sm:p-10 bottom-1">
                    <h1 class="pb-5 text-3xl border-b-2 border-gray-600">
                        Last Active Groups
                    </h1>
                    <ul>
                        @foreach ($category->groups as $group)
                            <li key={i} class="flex justify-between py-5 border-b-2 border-gray-600">
                                <div>
                                    <h2 class="text-xl">{{ $group->title }}</h2>
                                    <span class="text-gray-500">Public Group</span>
                                </div>
                                <div class="text-gray-500 text-end">
                                    <span>Created {{ $group->created_at->diffForHumans() }}</span>
                                    <br />
                                    <span>800 members</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="flex justify-center my-5">
                        <a class="px-3 py-2 font-bold text-white bg-blue-600 rounded-sm shadow-sm"
                            href="{{ route('web.groups', $category->id) }}">Explore Groups</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <section class="my-5 bg-[#ecf0f1] py-10 px-2">
        <div class="container mx-auto">
            <h1 class="my-10 text-5xl">
                My Forward to the <span class="font-bold">Healing</span>
            </h1>
        </div>
        <div class="py-5 bg-white ">
            <div class="container flex flex-col items-center justify-center gap-5 mx-auto sm:flex-row">
                <div class="flex">
                    <input class="p-2 bg-[#f4f5f9]" type="text" placeholder="Search Topics" />
                    <div class="text-white bg-[#697684] p-3">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </div>
                <button data-modal-target="start-new-topic" data-modal-toggle="start-new-topic"
                    class="px-4 py-2 bg-[#1cbb9b] text-white rounded-sm">
                    Start New Topic
                </button>

                <div class="p-3">
                    <i class="fa-solid fa-envelope fa-xl text-[#ced2d3]"></i>
                </div>
                <div>
                    <img src="{{ asset('img/no-avatar.png') }}" width="48" height="48" alt="avatar" />
                </div>
            </div>
        </div>

        <div class="container flex flex-col mx-auto sm:flex-row">
            <div class="w-full sm:w-3/5 xl:w-2/3">
                <div class="flex flex-wrap items-center justify-center gap-5 p-5">
                    <i class="cursor-pointer fa-solid fa-angle-left" id="prevPage"></i>
                    <div id="pagination" class="flex flex-wrap items-center justify-center gap-5 p-5">
                        {{-- <a class="bg-[#d0d4d7] py-2 px-4 text-white font-bold rounded-sm" href="#">
                            1
                        </a>
                        <a class="bg-[#d0d4d7] py-2 px-4 text-white font-bold rounded-sm" href="#">
                            2
                        </a>
                        <a class="bg-[#d0d4d7] py-2 px-4 text-white font-bold rounded-sm" href="#">
                            3
                        </a>
                        <a class="bg-[#d0d4d7] py-2 px-4 text-white font-bold rounded-sm" href="#">
                            4
                        </a>
                        <a class="bg-[#d0d4d7] py-2 px-4 text-white font-bold rounded-sm" href="#">
                            5
                        </a> --}}
                    </div>
                    <i class="cursor-pointer fa-solid fa-angle-right" id="nextPage"></i>
                </div>

                {{-- {/* <div class="w-full sm:w-2/5 xl:w-1/3"></div> */} --}}
            </div>
        </div>

        <div class="container flex flex-col gap-5 mx-auto sm:flex-row">
            <div class="w-full px-5 sm:w-3/5 xl:w-2/3">
                <ul class="flex flex-col gap-5" id="cardContainer">

                    {{-- <li
                        class="flex flex-col items-center justify-center gap-8 p-5 bg-white rounded-sm shadow-sm sm:flex-row">
                        <div class="w-20 h-20 bg-white rounded-full sm:w-40 sm:h-40">
                            <img src="{{ asset('img/no-avatar.png') }}" alt="avatar" />
                        </div>

                        <div>
                            <h1 class="text-2xl font-semibold">
                                What Instagram ads will look like
                            </h1>
                            <p class="py-2">
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                Dolore eaque dolorum fuga est? Autem tempora facere sed
                                nisi! Ullam, asperiores laboriosam! Vitae modi beatae
                                voluptates autem vero commodi minima expedita.
                            </p>
                        </div>

                        <div class="flex flex-col items-center justify-between w-56">
                            <div class="bg-[#bdc4c8] px-4 pt-3 pb-4 text-white font-semibold rounded-sm posts-clip">
                                <span class="text-xl">89</span>
                            </div>
                            <div class="flex flex-col items-center w-full text-gray-500">
                                <div class="flex items-center justify-center w-full gap-2 text-sm">
                                    <i class="fa-solid fa-eye text-[#ced2d3]"></i>
                                    <span>1560</span>
                                </div>
                                <div class="flex items-center justify-center w-full gap-2 text-sm">
                                    <i class="fa-solid fa-clock text-[#ced2d3]"></i>
                                    <span>24 min</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li
                        class="flex flex-col items-center justify-center gap-8 p-5 bg-white rounded-sm shadow-sm sm:flex-row">
                        <div class="w-20 h-20 bg-white rounded-full sm:w-40 sm:h-40">
                            <img src="{{ asset('img/no-avatar.png') }}" alt="avatar" />
                        </div>

                        <div>
                            <h1 class="text-2xl font-semibold">
                                What Instagram ads will look like
                            </h1>
                            <p class="py-2">
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                Dolore eaque dolorum fuga est? Autem tempora facere sed
                                nisi! Ullam, asperiores laboriosam! Vitae modi beatae
                                voluptates autem vero commodi minima expedita.
                            </p>
                        </div>

                        <div class="flex flex-col items-center justify-between w-56">
                            <div class="bg-[#bdc4c8] px-4 pt-3 pb-4 text-white font-semibold rounded-sm posts-clip">
                                <span class="text-xl">89</span>
                            </div>
                            <div class="flex flex-col items-center w-full text-gray-500">
                                <div class="flex items-center justify-center w-full gap-2 text-sm">
                                    <i class="fa-solid fa-eye text-[#ced2d3]"></i>
                                    <span>1560</span>
                                </div>
                                <div class="flex items-center justify-center w-full gap-2 text-sm">
                                    <i class="fa-solid fa-clock text-[#ced2d3]"></i>
                                    <span>24 min</span>
                                </div>
                            </div>
                        </div>
                    </li> --}}

                </ul>
            </div>

            <div class="w-full sm:w-2/5 xl:w-1/3">
                <div class="p-5 bg-white rounded-md">
                    <h1 class="mb-10 text-xl ">Categories</h1>
                    <ul class="flex flex-col gap-2">
                        <li class="flex justify-between">
                            <a href="">Trading for Money</a>
                            <span class="bg-[#d0d4d7] px-2 py-1 font-bold text-white rounded-xl">
                                20
                            </span>
                        </li>
                        <li class="flex justify-between">
                            <a href="">Vault Keys Giveaway</a>
                            <span class="bg-[#d0d4d7] px-2 py-1 font-bold text-white rounded-xl">
                                20
                            </span>
                        </li>
                        <li class="flex justify-between">
                            <a href="">Looking for players</a>
                            <span class="bg-[#d0d4d7] px-2 py-1 font-bold text-white rounded-xl">
                                20
                            </span>
                        </li>
                        <li class="flex justify-between">
                            <a href="">Video and Audio Drivers</a>
                            <span class="bg-[#d0d4d7] px-2 py-1 font-bold text-white rounded-xl">
                                20
                            </span>
                        </li>
                        <li class="flex justify-between">
                            <a href="">2K Official Forums</a>
                            <span class="bg-[#d0d4d7] px-2 py-1 font-bold text-white rounded-xl">
                                20
                            </span>
                        </li>
                    </ul>
                </div>

                <div class="p-5 my-5 bg-white rounded-md">

                    <h1 class="mb-10 text-xl ">Poll of the week</h1>
                    <h2 class="text-lg">Which game you are playing this week?</h2>
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

                    </ul>
                    <small>Voting ends on 19th of October</small>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')

    <!-- start-new-topic modal -->
    <div id="start-new-topic" tabindex="-1" aria-hidden="true"
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
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const cardsPerPage = 4; // Adjust as per your requirement
            let currentPage = 1;
            let totalPages;

            fetch('https://jsonplaceholder.typicode.com/posts')
                .then((response) => response.json())
                .then((posts) => {
                    function displayCards(cards) {
                        const container = $("#cardContainer");
                        container.empty();

                        const startIndex = (currentPage - 1) * cardsPerPage;
                        const endIndex = startIndex + cardsPerPage;

                        for (let i = startIndex; i < endIndex && i < cards.length; i++) {
                            container.append(`<li
                        class="flex flex-col items-center justify-center gap-8 p-5 bg-white rounded-sm shadow-sm sm:flex-row">
                        <div class="w-20 h-20 bg-white rounded-full shrink-0">
                            <img src="{{ asset('img/no-avatar.png') }}" alt="avatar" />
                        </div>

                        <div>
                            <h1 class="text-2xl font-semibold">
                                ${posts[i].title}
                            </h1>
                            <p class="py-2">
                                ${posts[i].body}
                            </p>
                        </div>
                        <div class="flex flex-col items-center justify-between w-56">
                            <div class="bg-[#bdc4c8] px-4 pt-3 pb-4 text-white font-semibold rounded-sm posts-clip">
                                <span class="text-xl">89</span>
                            </div>
                            <div class="flex flex-col items-center w-full text-gray-500">
                                <div class="flex items-center justify-center w-full gap-2 text-sm">
                                    <i class="fa-solid fa-eye text-[#ced2d3]"></i>
                                    <span>1560</span>
                                </div>
                                <div class="flex items-center justify-center w-full gap-2 text-sm">
                                    <i class="fa-solid fa-clock text-[#ced2d3]"></i>
                                    <span>24 min</span>
                                </div>
                            </div>
                        </div>
                    </li>`);
                        }
                    }

                    function displayPagination(cards) {
                        totalPages = Math.ceil(cards.length / cardsPerPage);
                        const paginationContainer = $("#pagination");
                        paginationContainer.empty();

                        for (let i = 1; i <= totalPages; i++) {
                            if (i === currentPage) {
                                paginationContainer.append(
                                    `<span class="page bg-[#888888] py-2 px-4 text-white font-bold rounded-sm cursor-pointer" data-page="${i}">${i}</span>`
                                );
                                continue;
                            }
                            paginationContainer.append(
                                `<span class="page bg-[#d0d4d7] py-2 px-4 text-white font-bold rounded-sm cursor-pointer" data-page="${i}">${i}</span>`
                            );
                        }

                        $(".page").click(function() {
                            currentPage = parseInt($(this).attr("data-page"));
                            displayCards(posts);
                            displayPagination(posts);
                        });
                    }

                    $("#prevPage").click(function() {
                        if (currentPage > 1) {
                            currentPage--;
                            displayCards(posts);
                            displayPagination(posts);
                        }
                    });

                    $("#nextPage").click(function() {
                        if (currentPage < totalPages) {
                            currentPage++;
                            displayCards(posts);
                            displayPagination(posts);
                        }
                    });

                    // Initial display
                    displayCards(posts);
                    displayPagination(posts);
                });
        });
    </script>
@endsection
