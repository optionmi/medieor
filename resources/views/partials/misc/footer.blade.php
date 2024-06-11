<footer class="text-white bg-primary">
    <div class="container px-5 py-10 mx-auto">
        <div class="flex flex-col items-center gap-10 sm:items-end sm:flex-row">
            <div class="sm:w-1/2">
                <ul>
                    <li><a class="hover:underline" href="{{ route('web.home') }}">Home</a></li>
                    <li><a class="hover:underline" href="{{ route('web.about.us') }}">About Us</a></li>
                    <li><a class="hover:underline" href="{{ route('web.our.purpose') }}">Our Purpose</a></li>
                    <li><a class="hover:underline" href="{{ route('web.contact.us') }}">Contact Us</a></li>
                </ul>
            </div>
            <div class="sm:w-1/2">
                <div class="flex flex-col items-center gap-10 sm:items-end sm:justify-end">
                    <div class="flex gap-5">
                        <i class="fa-brands fa-instagram fa-2xl"></i>
                        <i class="fa-brands fa-facebook fa-2xl"></i>
                        <i class="fa-brands fa-youtube fa-2xl"></i>
                        <i class="fa-brands fa-x-twitter fa-2xl"></i>
                        <i class="fa-brands fa-linkedin fa-2xl"></i>
                    </div>
                    <p>Copyright © {{ date('Y') }} Medieor. All rights reserved</p>
                </div>
            </div>
        </div>
</footer>
