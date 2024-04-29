<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Medieor | About us</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('/font-awesome/css/all.min.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
        }

        .banner {
            height: 800px;
            background-image: url('{{ asset('group_image/images/1uWpKYtXtBneUAh0G6juElX4kGQG004OlRhE0lM3.jpg') }}');
            background-size: cover;
            background-position: bottom;
            margin-top: -4rem;
        }

        .banner-2 {
            height: 500px;
            background-image: url('{{ asset('group_image/images/1uWpKYtXtBneUAh0G6juElX4kGQG004OlRhE0lM3.jpg') }}');
            background-size: cover;
            background-position: bottom;
        }

        .banner-3 {

            height: 500px;
            background-image: url('https://images.consciousplanet.org/save-soil/_next/static/media/let-us-make-it-happen-50.8afe6d6f.jpg?auto=format&fit=max&w=2048');
            background-size: cover;
            background-position: bottom;
        }

        nav>ul>li {
            text-shadow: 1px 2px 4px #000000d4;
        }

        .logo {}
    </style>
</head>

<body>
    <nav
        class="sticky top-0 text-white  bg-gradient-to-b from-[#00000088] to-bg-[#00000044] h-16 flex items-center py-2">
        <div class="container flex items-center justify-between px-2 mx-auto">
            <div class="flex items-center sm:gap-5">
                <img class="w-auto h-12" id="logo" src="{{ asset('img/logo.jpg') }}" alt="logo" />
                <span class="hidden text-2xl font-semibold sm:block">Medieor</span>
            </div>
            <ul class="flex gap-5">
                <li class="underline uppercase"><a href="{{ route('web.home') }}">Home</a></li>
                <li class="underline uppercase"><a href="{{ route('web.about.us') }}">About us</a></li>
                <li class="underline uppercase"><a href="{{ route('web.about.us') }}">Contact</a></li>
            </ul>
        </div>
    </nav>
    <section>
        <div class="banner">
        </div>
    </section>

    <section class="container flex flex-col items-center mx-auto my-10">
        <div class="px-2 sm:w-1/2">
            <h1 class="text-5xl font-semibold text-green-800 uppercase">CONSCIOUS PLANET</h1>
            <p class="my-5 text-lg montserrat-regular">Conscious Planet is an effort to raise human consciousness and
                bring a sense of
                inclusiveness such that
                multifarious activities of our societies move into a conscious mode. An effort to align human activity
                to be supportive of nature and all life on our planet.
                <br>
                <br>

                Our work is towards creating a planet where a large number of Human Beings act consciously, governments
                are elected consciously, where ecological issues become election issues in the world.
                <br>
                <br>

                In this inclusive undertaking of Save Soil Movement, governments, UN agencies, global leaders,
                organizations, eminent members of the environmental and scientific community, corporate and individual
                citizens are uniting behind a common purpose to address the alarming crisis of Soil Extinction. For our
                children and future generations, it is critical to leave behind a planet capable of producing nutritious
                food and sustaining all life.
            </p>

            <div class="my-10 text-lg">
                <h2 class="">The Save Soil Movement will work toward this by:</h2>
                <ol class="flex flex-col gap-5 my-5 ml-5">
                    <li class="flex py-2 border-b border-gray-600"><span
                            class="pr-4 text-4xl font-semibold">1</span><span>Turning
                            the world
                            attention
                            to our
                            dying soil.</span>
                    </li>
                    <li class="flex py-2 border-b border-gray-600"><span class="pr-4 text-4xl font-semibold">2</span>
                        <span>Inspiring about 4
                            billion people (60%
                            of the
                            world’s
                            electorate of 5.26 billion)
                            to support
                            policy
                            redirections to safeguard, nurture and sustain soils.</span>
                    </li>
                    <li class="flex py-2"><span class="pr-4 text-4xl font-semibold">3</span><span>Driving national
                            policy changes
                            in
                            193 nations
                            toward
                            raising and maintaining the
                            organic
                            content of
                            soils to a minimum of 3-6%.</span></li>
                </ol>
            </div>
        </div>
    </section>

    <section>
        <div class="banner-2"></div>
        <div class="bg-yellow-100">
            <div class="container flex flex-col py-10 mx-auto sm:flex-row">
                <div class="p-5 sm:w-1/2">
                    <img src="https://images.consciousplanet.org/save-soil/_next/static/media/sadhguru.535a938a.jpg?auto=format&fit=max&w=1080"
                        alt="">
                </div>
                <div class="px-10 sm:w-1/2">
                    <h1 class="mb-10 text-5xl font-semibold text-green-800 uppercase">Sadhguru</h1>
                    <p class="text-lg">Yogi, Mystic and Visionary, Sadhguru is one of the most influential people of our
                        times. An
                        Enlightened Master of enormous capability, he has undertaken some gargantuan challenges, work
                        that has been as sweeping as it has been varied.
                        <br>
                        <br>
                        All his efforts, however, have always been towards just one goal: Raising Human Consciousness.
                        Over the past four decades, Sadhguru has offered the technologies of well-being to millions of
                        people across the world through his foundations, which are supported by over 16 million
                        volunteers worldwide. Sadhguru has been conferred with three presidential awards among which are
                        the Padma Vibhushan for distinguished service to the Nation and India’s highest environmental
                        award, the Indira Gandhi Paryavaran Puraskar, in 2010.
                        <br>
                        <br>

                        Over the years, Sadhguru has launched mega ecological initiatives. Project GreenHands, Rally for
                        Rivers and Cauvery Calling address the urgent need to increase green cover, revitalize Indian
                        rivers and restore soil health.
                        <br>
                        <br>

                        These initiatives have been recognized globally as game-changers for establishing a blueprint
                        for economic development that is ecologically sustainable. Sadhguru has been invited by various
                        UN and international agencies including the UN, UNE, UNEP, IUCN, UNCCD and WEF to discuss global
                        solutions to the world’s ecological issues.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container flex flex-col items-center py-10 mx-auto my-10 text-center">
            <div class="flex flex-col items-center w-2/3 py-10">
                <h1 class="text-4xl font-semibold text-green-800">SAVE SOIL: A MOVEMENT THAT BEGAN 24 YEARS AGO</h1>
                <p class="sm:w-[640px] my-5">For three decades now, Sadhguru has been continuously bringing the
                    importance
                    of soil
                    and the alarming
                    threat of Soil Extinction into the spotlight. He has said repeatedly at several international
                    platforms:
                    "Soil is our life, our very body. And if we forsake soil, in many ways, we forsake the planet."</p>

                <iframe class="sm:w-[580px] sm:h-[335px]"
                    src="https://www.youtube.com/embed/kalp_iT6Zs4?si=SFylkoAUZldeID6e" title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </div>
    </section>

    <section>
        {{-- <div class="p-5 bg-yellow-100">
            <div class="container mx-auto">

                <h1 class="py-5 text-5xl font-semibold text-center">WHO WILL SAVE SOIL?</h1>
                <img src="https://images.consciousplanet.org/save-soil/_next/static/media/tree-banner.1ef702ed.jpg?auto=format&fit=max&w=2048&q=10"
                    alt="">
            </div>
        </div> --}}
        <div class="container flex justify-center py-10 mx-auto">
            <div class="px-5 sm:w-2/3">
                <p>1990s. Rural Tamil Nadu. A group of people sat under the shade of a generous leafy tree, with eyes
                    closed. A while ago, they had been sitting in the open, parched and sweating, feeling all the torrid
                    effects of the southern Indian sun. Now, in protective green shade, with a cool breeze blowing, they
                    realized the essence, and the benediction of the big tree.
                    <br>
                    <br>
                    Sadhguru led them through an inner process, where they actually experienced the exchange of breath
                    with
                    the tree, breathing out carbon dioxide, which the tree inhaled, and breathing in oxygen that the
                    tree
                    exhaled. An experiential process where they clearly saw that one half of their breathing apparatus
                    was
                    hanging out there. These were the early days when Sadhguru had just begun planting trees in what he
                    called “the most difficult terrain – the minds of people.” This first-hand experience of oneness
                    with
                    all life galvanized the first set of ardent volunteers who pioneered this movement to restore our
                    planet.
                    <br>
                    <br>

                    What began with a few thousand volunteers in the 1990s in the form of Vanashree, an eco-drive aimed
                    at
                    greening the Velliangiri Hills, soon grew into Project GreenHands, a large state-wide campaign with
                    millions of volunteers across Tamil Nadu in the first decade of 2000s. In 2017, when Sadhguru led
                    the
                    incredible Rally for Rivers, it snowballed into the largest environmental movement on the planet
                    supported by 162 million Indians, further leading to intense on-ground activity with the extremely
                    hands-on, proof-of-concept project Cauvery Calling. Now, it will include billions of global citizens
                    in
                    an unprecedented movement to create a Conscious Planet and Save Soil. Sadhguru’s mission to reach 4
                    billion people on Earth has been the product of three decades of work and evolution.
                    <br>
                    <br>

                    One of the crucial aspects in the evolution of this movement has no doubt been the sheer number of
                    people it has inspired. However, equally important has been its growing levels of influence. From
                    local
                    communities, organizations, farmers, schools and state governments, to helping shape the National
                    River
                    Policy in India and now to working with some of the most environmentally-relevant international
                    agencies, world leaders and governments – the movement has been making quantum leaps in the past
                    three
                    decades.
                    <br>
                    <br>

                    The phenomenal endeavor of the Save Soil movement is to bring citizens of the entire democratic
                    world
                    together to speak in one voice and affirm our commitment to the health and future of Earth. When
                    issues
                    of ecology become electoral issues, when the people’s support empowers governments to adopt
                    long-term
                    policy changes to safeguard soil, when businesses, organizations, individuals and governments make
                    soil
                    health a primary priority – that is when this sustained effort will find fruition.
                    <br>
                    <br>

                    This has been a journey from GreenHeads to GreenHands to GreenHearts. So who will save soil? Each
                    and
                    every one of us.
                    <br>
                    <br>

                    Let us make it happen!
                </p>
            </div>
        </div>
    </section>

    <section>
        <div class="flex flex-col items-center justify-center gap-5 banner-3">
            <div class="px-5">
                <h1 class="text-5xl font-bold text-white uppercase">LET US MAKE IT HAPPEN!</h1>
            </div>
            <div>
                <button class="px-4 py-3 font-semibold text-white bg-green-400 rounded-sm">Action Now</button>
            </div>
        </div>
    </section>

    <footer>
        <div class="container px-5 py-10 mx-auto">
            <div class="flex flex-col items-center gap-10 sm:items-start sm:flex-row">
                <div class="sm:w-1/2">
                    <ul>
                        <li class="underline"><a href="#">Media</a></li>
                        <li class="underline"><a href="#">Contact</a></li>
                        <li class="underline"><a href="#">About</a></li>
                        <li class="underline"><a href="#">Daily Activity</a></li>
                    </ul>
                </div>
                <div class="sm:w-1/2">
                    <div class="flex flex-col items-center gap-5 sm:items-end sm:justify-end">
                        <div class="flex gap-5">
                            <i class="fa-brands fa-instagram fa-2xl"></i>
                            <i class="fa-brands fa-facebook fa-2xl"></i>
                            <i class="fa-brands fa-youtube fa-2xl"></i>
                            <i class="fa-brands fa-x-twitter fa-2xl"></i>
                            <i class="fa-brands fa-linkedin fa-2xl"></i>
                        </div>
                        <p>© 2024 Medieor. All rights reserved</p>
                    </div>
                </div>
            </div>
    </footer>

</body>

</html>
