<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Medieor</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}" />
    <!-- Alpine js -->
    {{-- <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
    <script defer src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</head>

<body>
    <div x-data="{ activeTab: 1, }" class="root">
        <header class="container py-2 d-flex justify-content-end">
            {{-- <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-bars fa-2xl"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('web.about.us') }}">About Us</a></li>
                    <li><a class="dropdown-item" href="#">Our Propose, Our Goal</a></li>
                    <li><a class="dropdown-item" href="#">Contact us</a></li>
                </ul>
            </div> --}}

            <nav class="navbar bg-body-tertiary fixed-top">
                <div class="container-fluid">
                    <div></div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"
                        aria-label="Toggle navigation">
                        {{-- <span class="navbar-toggler-icon"></span> --}}
                        <i class="fa-solid fa-bars fa-2xl"></i>
                    </button>
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                        aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            {{-- <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5> --}}
                            <div></div>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web.about.us') }}">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web.our.purpose') }}">Our purpose</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Contact Us</a>
                                </li>
                        </div>
                    </div>
                </div>
            </nav>

        </header>
        <div id="container" class="container mx-auto row">
            <div class="mb-4 col-lg-5 d-flex flex-column justify-content-between">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="mt-5 flex-column justify-content-between">
                                <div class="p-3 shadow card">
                                    {{-- <h1 class="text-center l_height1 f_size1 fw-bold">SAVE</h1>
                                    <h1 class="text-center l_height1 f_size2 fw-bold">MY</h1>
                                    <h1 class="text-center l_height1 f_size3 fw-bold">EARTH</h1> --}}
                                    <h4 class="mt-5 text-center f_size3 fw-bold">
                                        Will pollution win or you will win in wiping it out
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="mt-5 flex-column justify-content-between">
                                <div class="p-3 shadow card">
                                    {{-- <h1 class="text-center l_height1 f_size1 fw-bold">SAVE</h1>
                                    <h1 class="text-center l_height1 f_size2 fw-bold">MY</h1>
                                    <h1 class="text-center l_height1 f_size3 fw-bold">EARTH</h1> --}}
                                    <h4 class="mt-5 text-center f_size3 fw-bold">
                                        Let us make a waters blue, not brown
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="mt-5 flex-column justify-content-between">
                                <div class="p-3 shadow card">
                                    {{-- <h1 class="text-center l_height1 f_size1 fw-bold">SAVE</h1>
                                    <h1 class="text-center l_height1 f_size2 fw-bold">MY</h1>
                                    <h1 class="text-center l_height1 f_size3 fw-bold">EARTH</h1> --}}
                                    <h4 class="mt-5 text-center f_size3 fw-bold">
                                        Love yourself, Say No to Pollution
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="mt-5 flex-column justify-content-between">
                                <div class="p-3 shadow card">
                                    {{-- <h1 class="text-center l_height1 f_size1 fw-bold">SAVE</h1>
                                    <h1 class="text-center l_height1 f_size2 fw-bold">MY</h1>
                                    <h1 class="text-center l_height1 f_size3 fw-bold">EARTH</h1> --}}
                                    <h4 class="mt-5 text-center f_size3 fw-bold">
                                        Consume responsibly to get your health back
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="mt-5 flex-column justify-content-between">
                                <div class="p-3 shadow card">
                                    {{-- <h1 class="text-center l_height1 f_size1 fw-bold">SAVE</h1>
                                    <h1 class="text-center l_height1 f_size2 fw-bold">MY</h1>
                                    <h1 class="text-center l_height1 f_size3 fw-bold">EARTH</h1> --}}
                                    <h4 class="mt-5 text-center f_size3 fw-bold">
                                        Environment is for enjoying, not for destroying
                                    </h4>
                                </div>
                            </div>
                        </div>

                    </div>
                    <p id="tagline" class="mt-5 text-center">
                        WE WILL 'HEAL IT TOGETHER'
                    </p>
                </div>
                <!-- Default Tab -->
                {{-- <div class="mt-5 flex-column justify-content-between" :class="activeTab == 0 ? 'd-flex' : 'd-none'"
                    x-clock>
                    <div class="p-3 bg-transparent shadow card">
                        <h1 class="text-center l_height1 f_size1 fw-bold">SAVE</h1>
                        <h1 class="text-center l_height1 f_size2 fw-bold">MY</h1>
                        <h1 class="text-center l_height1 f_size3 fw-bold">EARTH</h1>
                    </div>
                    <p id="tagline" class="mt-5 text-center text-nowrap">
                        WE WILL 'HEAL IT TOGETHER'
                    </p>
                </div> --}}
                <!-- Space Tab -->
                {{-- <div x-show="activeTab == 1 " class="p-3 mt-5 shadow card el_card bg-space" x-cloak>
                    <span class="mt-0 mb-2 text-end">
                        <img @click="activeTab = 0" id="close" src="{{ asset('img/close.svg') }}" alt="close" />
                    </span>
                    <h4>The contribution of (Space - Akasha ) in healing the earth</h4>
                    <hr />
                    <p>
                        The catalyst in which all existence happens. The time is
                        considered as space; It is empty and has no existence. But
                        contains the four great elements. Its ethereal presence gives us
                        the humbleness we need. It gives us the ability to act. In time,
                        all things happen, trees grow, water moves and air travels.
                    </p>
                </div> --}}
                <!-- Fire Tab -->
                {{-- <div x-show="activeTab == 2" class="p-3 mt-5 shadow card el_card bg-fire" x-cloak>
                    <span class="mt-0 mb-2 text-end">
                        <img @click="activeTab = 0" id="close" src="{{ asset('img/close.svg') }}" alt="close" />
                    </span>
                    <h4>The contribution of ( Fire - Agni ) in healing the earth</h4>
                    <hr />
                    <p>
                        The heat, warmth and energy within all of us. How Agni contributes
                        to the healing. Agni is the fire, the fuel that powers. Sun gives
                        the trees power to grow. It provides the earth with warmth. It
                        destroys and burns the bacteria.Without it our earth will be no
                        better than Neptune. Without it life may not be possible.
                    </p>
                </div> --}}
                <!-- Water Tab -->
                {{-- <div x-show="activeTab == 3" class="p-3 mt-5 shadow card el_card bg-water" x-cloak>
                    <span class="mt-0 mb-2 text-end">
                        <img @click="activeTab = 0" id="close" src="{{ asset('img/close.svg') }}" alt="close" />
                    </span>
                    <h4>The contribution of ( Water - Jal) in healing the earth</h4>
                    <hr />
                    <p>
                        The nurturer, nourisher and healer. How Jal contributes to the
                        healing ?. The Jal washes away the sins. It cleanses the tired
                        face of the wanderer. Jal has the power to renew. They say 60%
                        percent of our body is water. It nurtures the plants and turns
                        them into blossoming trees.
                    </p>
                </div> --}}
                <!-- Soil Tab -->
                {{-- <div x-show="activeTab == 4" class="p-3 mt-5 shadow card el_card bg-soil" x-cloak>
                    <span class="mt-0 mb-2 text-end">
                        <img @click="activeTab = 0" id="close" src="{{ asset('img/close.svg') }}" alt="close" />
                    </span>
                    <h4>The contribution of ( Soil - Mitti ) in healing the earth</h4>
                    <hr />
                    <p>
                        The vast land where the growth happens. How Mitti contributes to
                        the healing ?. It is the mother who cradles the trees; It is the
                        ground beneath your feet. The Mitti is the place where seedlings
                        mature into tough oaks. It fulfills our hunger. It grounds our
                        home.
                    </p>
                </div> --}}
                <!-- Air Tab -->
                {{-- <div x-show="activeTab == 5" class="p-3 mt-5 shadow card el_card bg-air" x-cloak>
                    <span class="mt-0 mb-2 text-end">
                        <img @click="activeTab = 0" id="close" src="{{ asset('img/close.svg') }}" alt="close" />
                    </span>
                    <h4>The contribution of ( Air - Vaayu ) in healing the earth</h4>
                    <hr />
                    <p>
                        The ultimate Cleanser, the traveler and the one responsible for
                        our breath . How Vaayu contributes to the healing ? It travels the
                        earth, its movement created the desserts and shaped the Grand
                        canyon. It makes the pollination possible. The trees of the Sahara
                        call out its name hoping it will bring the rains with it.
                    </p>
                </div> --}}


                <div class="btn-container">
                    <p class="font-bold text-center fs-4 fw-bold">
                        A Movement called MEDIEOR
                    </p>
                    <div class="gap-2 elementBtnContainer d-flex justify-content-center align-items-center">
                        {{-- <button @click="activeTab = 1" class="m-2 elementBtn" title="Space">
                            <img src="./img/space.png" alt="" />
                        </button>
                        <button @click="activeTab = 2" class="m-2 elementBtn" title="Fire">
                            <img src="./img/fire.png" alt="" />
                        </button>
                        <button @click="activeTab = 3" class="m-2 elementBtn" title="Water">
                            <img src="./img/water.png" alt="" />
                        </button>
                        <button @click="activeTab = 4" class="m-2 elementBtn" title="Soil">
                            <img src="./img/soil.png" alt="" />
                        </button>
                        <button @click="activeTab = 5" class="m-2 elementBtn" title="Air">
                            <img src="./img/air.png" alt="" />
                        </button> --}}

                        {{-- <a href="{{ route('web.space') }}" class="m-2 elementBtn" title="Space"><img
                                src="./img/space.png" alt="Space" /></a>
                        <a href="{{ route('web.fire') }}" class="m-2 elementBtn" title="Fire"><img
                                src="./img/fire.png" alt="Fire" /></a>
                        <a href="{{ route('web.water') }}" class="m-2 elementBtn" title="Water"><img
                                src="./img/water.png" alt="Water" /></a>
                        <a href="{{ route('web.soil') }}" class="m-2 elementBtn" title="Soil"><img
                                src="./img/soil.png" alt="Soil" /></a>
                        <a href="{{ route('web.air') }}" class="m-2 elementBtn" title="Air"><img src="./img/air.png"
                                alt="Air" /></a> --}}

                        @foreach (\App\Models\Category::all() as $category)
                            <a href="{{ route('category.detail', $category->id) }}" title="{{ $category->title }}"
                                class="elementBtn"><img src={{ asset($category->logo_image) }}
                                    alt="{{ $category->title }}" /></a>
                        @endforeach
                        <img id="logo" src="{{ asset('img/logo.jpg') }}" alt="logo" />
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <img id="imgRight" src="{{ asset('img/right.png') }}" alt="" />
            </div>
        </div>
    </div>
</body>

</html>
