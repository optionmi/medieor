@extends('layouts.misc')

@section('title')
    Our Purpose
@endsection

@section('styles')
    <style>
        body {
            font-family: "Poppins", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
        }

        .banner {
            height: 278px;
            background-image: url('{{ asset($data->img1) }}');
            background-size: cover;
            background-position: center;
            margin-top: -4rem;
        }

        .banner h1 {
            text-shadow: 2px 2px black;
        }
    </style>
@endsection

@section('content')
    @include('partials.misc.header')

    <div class="flex items-center justify-center banner">
        <h1 class="text-4xl font-semibold text-center text-white uppercase">{{ $data->img_text1 }}</h1>
    </div>

    <section>
        <div class="container py-10 mx-auto">
            <h1 class="text-4xl font-semibold text-blue-800 uppercase">{{ $data->heading1 }}</h1>
            <p class="my-10">{!! $data->section1 !!}</p>
        </div>
    </section>

    @include('partials.misc.footer')
@endsection
