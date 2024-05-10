@extends('layouts.misc')
@section('title')
    About Us
@endsection
@section('styles')
    <style>
        body {
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
        }

        .banner {
            height: 800px;
            background-image: url('{{ asset($data->img1) }}');
            background-size: cover;
            background-position: bottom;
            margin-top: -4rem;
        }

        .banner-2 {
            height: 500px;
            background-image: url('{{ asset($data->img2) }}');
            background-size: cover;
            background-position: bottom;
        }

        .banner-3 {

            height: 500px;
            background-image: url('{{ asset($data->img3) }}');
            background-size: cover;
            background-position: bottom;
        }

        nav>ul>li {
            text-shadow: 1px 2px 4px #000000d4;
        }

        .logo {}
    </style>
@endsection

@section('content')
    @include('partials.misc.header')

    <section>
        <div class="banner">
        </div>
    </section>

    <section class="container flex flex-col items-center mx-auto my-10">
        <div class="px-2 sm:w-1/2">
            <h1 class="text-5xl font-semibold text-green-800 uppercase">{{ $data->heading1 }}</h1>
            <p class="my-5 text-lg montserrat-regular">{!! $data->section1 !!}</p>

            {{-- <div class="my-10 text-lg">
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
            </div> --}}
        </div>
    </section>

    <section>
        {{-- <div class="banner-2"></div> --}}
        <div class="bg-yellow-100">
            <div class="container flex flex-col py-10 mx-auto sm:flex-row">
                <div class="p-5 sm:w-1/2">
                    <img src="{{ asset($data->img2) }}" alt="">
                </div>
                <div class="px-10 sm:w-1/2">
                    <h1 class="mb-10 text-5xl font-semibold text-green-800 uppercase">{{ $data->heading2 }}</h1>
                    <p class="text-lg">{!! $data->section2 !!}</p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container flex flex-col items-center py-10 mx-auto my-10 text-center">
            <div class="flex flex-col items-center w-2/3 py-10">
                <h1 class="my-5 text-4xl font-semibold text-green-800">{{ $data->heading3 }}</h1>
                {{-- <p class="sm:w-[640px] my-5">For three decades now, Sadhguru has been continuously bringing the
                    importance
                    of soil
                    and the alarming
                    threat of Soil Extinction into the spotlight. He has said repeatedly at several international
                    platforms:
                    "Soil is our life, our very body. And if we forsake soil, in many ways, we forsake the planet."</p> --}}

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
                {!! $data->section3 !!}
            </div>
        </div>
    </section>

    <section>
        <div class="flex flex-col items-center justify-center gap-5 banner-3">
            <div class="px-5">
                <h1 class="text-5xl font-bold text-white uppercase">{{ $data->img_text3 }}</h1>
            </div>
            <div>
                <button class="px-4 py-3 font-semibold text-white bg-green-400 rounded-sm">Action Now</button>
            </div>
        </div>
    </section>

    @include('partials.misc.footer')
@endsection
