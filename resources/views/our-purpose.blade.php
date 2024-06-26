@extends('layouts.misc')

@section('title')
    Our Purpose
@endsection

@section('content')
    @include('partials.misc.header')

    <section class="bg-primary mt-[-4rem] h-72 flex justify-center items-center">
        <h1 class="text-4xl font-semibold text-center text-white uppercase text-shadow-sm shadow-black">
            {{ $data->img_text1 }}</h1>
    </section>

    <section>
        <div class="container py-10 mx-auto">
            <h1 class="text-2xl font-semibold text-green-800 uppercase sm:text-4xl">{{ $data->heading1 }}</h1>
            <p class="my-10">{!! $data->section1 !!}</p>
        </div>
    </section>

    @include('partials.misc.footer')
@endsection
