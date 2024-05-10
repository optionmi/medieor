    <nav
        class="sticky top-0 text-white  bg-gradient-to-b from-[#00000088] to-bg-[#00000044] h-16 flex items-center py-2">
        <div class="container flex items-center justify-between px-2 mx-auto">
            <div class="flex items-center sm:gap-5">
                <img class="w-auto h-12" id="logo" src="{{ asset('img/logo.jpg') }}" alt="logo" />
                <span class="hidden text-2xl font-semibold sm:block text-shadow-sm shadow-black">Medieor</span>
            </div>
            <ul class="flex gap-5">
                <li class="underline uppercase text-shadow-sm shadow-black"><a href="{{ route('web.home') }}">Home</a>
                </li>
                <li class="underline uppercase text-shadow-sm shadow-black"><a href="{{ route('web.about.us') }}">About
                        Us</a></li>
                <li class="underline uppercase text-shadow-sm shadow-black"><a href="{{ route('web.our.purpose') }}">Our
                        Purpose</a></li>
                <li class="underline uppercase text-shadow-sm shadow-black"><a
                        href="{{ route('web.about.us') }}">Contact Us</a></li>
            </ul>
        </div>
    </nav>
