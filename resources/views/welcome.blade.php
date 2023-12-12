<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Medieor</title>

    <!-- Fonts -->

    <!-- Styles -->
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/home.css') }}">
</head>

<body>

    <header class="py-2 text-white bg-[#a48159]">
        <div class="container flex flex-col items-center justify-between mx-auto sm:flex-row">
            <div class="flex items-center gap-2 px-4 py-2 sm:w-3/5">
                <img src={{ asset('img/logo.jpg') }} alt="Medieor Logo" width="55" />
                <img src={{ asset('img/space.png') }} alt="Space" width="55" />
                <img src={{ asset('img/fire.png') }} alt="Fire" width="55" />
                <img src={{ asset('img/water.png') }} alt="Water" width="55" />
                <img src={{ asset('img/soil.png') }} alt="Soil" width="55" />
                <img src={{ asset('img/air.png') }} alt="Air" width="55" />
            </div>
            <ul class="flex justify-end w-full gap-6 px-4 py-2 sm:w-2/5">
                <li class="flex flex-col items-center gap-2">
                    <div>
                        <i class="fa-regular fa-user fa-2xl"></i>
                    </div>
                    <span>Account</span>
                </li>
                <li class="flex flex-col items-center gap-2">
                    <div>
                        <i class="fa-solid fa-cart-shopping fa-2xl"></i>
                    </div>
                    <span>Cart</span>
                </li>
                <li class="flex flex-col items-center gap-2">
                    <div>
                        <i class="fa-solid fa-bars fa-2xl"></i>
                    </div>
                    <span>Menu</span>
                </li>
            </ul>
        </div>
    </header>


    <section class="mb-10">
        <div class="relative">
            <div class="relative soil-bg">
                <div
                    class="flex flex-col items-center p-5 text-4xl leading-snug text-white sm:text-6xl sm:absolute bottom-60 right-20">
                    <h1>The contribution of</h1>
                    <h1>(Soil - Mitti)</h1>
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
                <h1 class="text-4xl leading-normal sm:text-5xl">
                    My Contribution in healing <br />
                    <span class="font-bold"> Mitti</span> of the
                    <span class="font-bold"> earth</span>
                </h1>
                <p class="my-5 text-2xl">
                    Bring to the table win-win survival strategies to ensure proactive
                    domination. At the end of the day, going forward, a new normal
                    that has evolved from generation X is on the runway heading
                    towards a streamlined cloud solution.
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
                        <li key={i} class="flex justify-between py-5 border-b-2 border-gray-600">
                            <div>
                                <h2 class="text-xl">Mitti for all</h2>
                                <span class="text-gray-500">Public Group</span>
                            </div>
                            <div class="text-gray-500 text-end">
                                <span>Created 2 months ago</span>
                                <br />
                                <span>800 members</span>
                            </div>
                        </li>
                        <li key={i} class="flex justify-between py-5 border-b-2 border-gray-600">
                            <div>
                                <h2 class="text-xl">Mitti for all</h2>
                                <span class="text-gray-500">Public Group</span>
                            </div>
                            <div class="text-gray-500 text-end">
                                <span>Created 2 months ago</span>
                                <br />
                                <span>800 members</span>
                            </div>
                        </li>
                    </ul>
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
                <button class="px-4 py-2 bg-[#1cbb9b] text-white rounded-sm">
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
                    <i class="fa-solid fa-angle-left"></i>
                    <a class="bg-[#d0d4d7] py-2 px-4 text-white font-bold rounded-sm" href="#">
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
                    </a>
                    <i class="fa-solid fa-angle-right"></i>
                </div>

                {{-- {/* <div class="w-full sm:w-2/5 xl:w-1/3"></div> */} --}}
            </div>
        </div>

        <div class="container flex flex-col gap-5 mx-auto sm:flex-row">
            <div class="w-full px-5 sm:w-3/5 xl:w-2/3">
                <ul class="flex flex-col gap-5">

                    <li
                        class="flex flex-col items-center justify-center gap-8 p-5 bg-white rounded-sm shadow-sm sm:flex-row">
                        <div>
                            <img src="{{ asset('img/no-avatar.png') }}" width={100} height={100} alt="avatar" />
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

                        <div class="flex flex-col items-center justify-between w-52">
                            <div class="bg-[#bdc4c8] px-4 pt-3 pb-4 text-white font-semibold rounded-sm posts-clip">
                                <span class="text-xl">89</span>
                            </div>
                            <div class="flex flex-col items-center w-full text-gray-500">
                                <div class="flex items-center justify-center w-full gap-2 text-sm">
                                    <FaEye size={15} color="#ced2d3" />
                                    <span>1560</span>
                                </div>
                                <div class="flex items-center justify-center w-full gap-2 text-sm">
                                    <FaClock size={13} color="#ced2d3" />
                                    <span>24 min</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li
                        class="flex flex-col items-center justify-center gap-8 p-5 bg-white rounded-sm shadow-sm sm:flex-row">
                        <div>
                            <img src="{{ asset('img/no-avatar.png') }}" width={100} height={100} alt="avatar" />
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

                        <div class="flex flex-col items-center justify-between w-52">
                            <div class="bg-[#bdc4c8] px-4 pt-3 pb-4 text-white font-semibold rounded-sm posts-clip">
                                <span class="text-xl">89</span>
                            </div>
                            <div class="flex flex-col items-center w-full text-gray-500">
                                <div class="flex items-center justify-center w-full gap-2 text-sm">
                                    <FaEye size={15} color="#ced2d3" />
                                    <span>1560</span>
                                </div>
                                <div class="flex items-center justify-center w-full gap-2 text-sm">
                                    <FaClock size={13} color="#ced2d3" />
                                    <span>24 min</span>
                                </div>
                            </div>
                        </div>
                    </li>

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
    <footer class="p-10 bg-[#a48159]"></footer>

</body>

</html>
