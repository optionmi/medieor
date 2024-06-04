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

    <section class="bg-primary mt-[-4rem] h-72 flex justify-center items-center">
        <h1 class="text-4xl font-semibold text-center text-white uppercase text-shadow-sm shadow-black">
            {{ $data->img_text1 }}</h1>
    </section>

    <section class="container flex flex-col items-center mx-auto my-10">
        <div class="px-2 sm:w-1/2">
            <h1 class="text-5xl font-semibold text-green-800 uppercase">{{ $data->heading1 }}</h1>
            <p class="my-5 text-lg montserrat-regular">{!! $data->section1 !!}</p>
        </div>
    </section>

    <section>
        <div class="bg-yellow-100">
            <div class="container flex flex-col py-10 mx-auto sm:flex-row">
                <div class="p-5 sm:w-1/2">
                    <img src="{{ asset($data->img2) }}" alt="">
                </div>
                <div class="px-10 sm:w-1/2">
                    <h1 class="mb-10 text-4xl font-semibold text-green-800 uppercase">{{ $data->heading2 }}</h1>
                    <p class="text-lg">{!! $data->section2 !!}</p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container flex flex-col items-center py-10 mx-auto text-center">
            <div class="flex flex-col items-center w-2/3">
                <h1 class="my-5 text-4xl font-semibold text-green-800">{{ $data->heading3 }}</h1>
            </div>
        </div>
    </section>

    <section>
        <div class="container flex justify-center pb-10 mx-auto">
            <div class="px-5 sm:w-2/3">
                {!! $data->section3 !!}
            </div>
        </div>
    </section>

    @include('partials.misc.footer')
@endsection
