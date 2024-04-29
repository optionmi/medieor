<header class="py-2 text-white bg-[#a48159] sticky top-0 z-20">
    <div class="container flex flex-col items-center justify-between mx-auto sm:flex-row">
        <div class="flex items-center gap-2 px-4 py-2 sm:w-3/5">
            <a href="{{ route('web.home') }}">
                <img src={{ asset('img/logo.jpg') }} alt="Medieor Logo" width="55" /></a>
            @foreach (\App\Models\Category::all() as $category)
                <a href="{{ route('category.detail', $category->id) }}" title="{{ $category->title }}"><img
                        src={{ asset($category->logo_image) }} alt="{{ $category->title }}" width="55" /></a>
            @endforeach
        </div>
        <ul class="flex justify-end w-full gap-6 px-4 py-2 mt-2 sm:w-2/5">
            <li>
                <button class="flex flex-col items-center gap-2" data-dropdown-toggle="account-dropdown">
                    <div>
                        <i class="fa-regular fa-user fa-2xl"></i>
                    </div>
                    <span>Account</span>
                </button>
                <div id="account-dropdown"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        <li>
                            <a href="/login"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Login</a>
                        </li>
                        <li>
                            <a href="/register"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Register</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="flex flex-col items-center gap-2">
                <div>
                    <i class="fa-solid fa-cart-shopping fa-2xl"></i>
                </div>
                <span>Cart</span>
            </li>
            <li>
                <button class="flex flex-col items-center gap-2" data-dropdown-toggle="menu-dropdown">
                    <div>
                        <i class="fa-solid fa-bars fa-2xl"></i>
                    </div>
                    <span>Menu</span>
                </button>
                <div id="menu-dropdown"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                        </li>
                        <li>
                            <a href="{{ route('web.my.groups') }}"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">My
                                Groups</a>
                        </li>
                        <li>
                            <a href="{{ route('web.group.join.requests') }}"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Group
                                Join Requests</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</header>
