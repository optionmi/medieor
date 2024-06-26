    <nav
        class="sticky top-0 text-white  bg-gradient-to-b from-[#00000088] to-bg-[#00000044] h-16 flex items-center py-2">
        <div class="container flex items-center justify-between px-2 mx-auto">
            <a class="flex items-center flex-grow-0 flex-shrink-0 gap-4" href="{{ route('web.home') }}">
                <img class="w-auto h-12" id="logo" src="{{ asset('img/logo.jpg') }}" alt="logo" />
                <span class="text-2xl font-semibold text-shadow-sm shadow-black">Medieor</span>
            </a>
            <ul class="hidden gap-5 text-lg sm:flex">
                <li class="uppercase hover:underline text-shadow-sm shadow-black"><a
                        href="{{ route('web.home') }}">Home</a>
                </li>
                <li class="uppercase hover:underline text-shadow-sm shadow-black"><a
                        href="{{ route('web.about.us') }}">About
                        Us</a></li>
                <li class="uppercase hover:underline text-shadow-sm shadow-black"><a
                        href="{{ route('web.our.purpose') }}">Our
                        Purpose</a></li>
                <li class="uppercase hover:underline text-shadow-sm shadow-black"><a
                        href="{{ route('web.contact.us') }}">Contact Us</a></li>
            </ul>

            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-white sm:hidden"
                type="button"><i class="fa-solid fa-bars fa-2xl sm:hidden"></i>
            </button>

            <!-- Dropdown menu -->
            <div id="dropdown"
                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a href="{{ route('web.home') }}"
                            class="block px-4 py-2 hover:bg-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('web.about.us') }}"
                            class="block px-4 py-2 hover:bg-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">About
                            us</a>
                    </li>
                    <li>
                        <a href="{{ route('web.our.purpose') }}"
                            class="block px-4 py-2 hover:bg-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">Our
                            purpose</a>
                    </li>
                    <li>
                        <a href="{{ route('web.contact.us') }}"
                            class="block px-4 py-2 hover:bg-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">Contact
                            us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
